<?php

use App\Livewire\Dashboard\Optimize;
use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Models\User;
use App\Notifications\TaskThresholdReached;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    MembershipLevel::create([
        'name' => 'VIP0',
        'percentage' => 0.5,
    ]);
});

test('admin is notified when user completes their 10th task', function () {
    Notification::fake();

    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 9,
        'task_pole' => 35,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    $completedTask = CompletedTask::create([
        'user_id' => $user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($user)
        ->test(Optimize::class)
        ->call('submitTask')
        ->assertRedirect(route('dashboard.start'));

    Notification::assertSentOnDemand(
        TaskThresholdReached::class,
        function (TaskThresholdReached $notification, array $channels, object $notifiable) use ($user) {
            return $notifiable->routes['mail'] === 'voldexcustomersservice@gmail.com'
                && $notification->username === $user->username;
        }
    );
});

test('admin is not notified when user has not reached 10 tasks', function () {
    Notification::fake();

    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 5,
        'task_pole' => 35,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    $completedTask = CompletedTask::create([
        'user_id' => $user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($user)
        ->test(Optimize::class)
        ->call('submitTask')
        ->assertRedirect(route('dashboard.start'));

    Notification::assertNothingSentTo(
        Notification::route('mail', 'voldexcustomersservice@gmail.com')
    );
});
