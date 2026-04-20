<?php

use App\Livewire\Dashboard\Record;
use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Models\User;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->membershipLevel = MembershipLevel::create([
        'name' => 'VIP0',
        'percentage' => 0.5,
    ]);

    $this->user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);
});

test('record page displays completed tasks', function () {
    CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'approved',
    ]);

    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->assertSee('Test Product')
        ->assertSee('100.00 USDT')
        ->assertSee('0.50 USDT')
        ->assertSee('Approved');
});

test('record page shows empty state when no tasks exist', function () {
    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->assertSee('No records found.');
});

test('record page paginates completed tasks', function () {
    foreach (range(1, 15) as $i) {
        $task = CompletedTask::create([
            'user_id' => $this->user->id,
            'title' => "Item-{$i}",
            'cost' => 100,
            'task_image_path' => 'tasks/test.jpg',
            'rating' => '',
            'rating_id' => '',
            'status' => 'approved',
        ]);
        $task->forceFill(['created_at' => now()->addMinutes($i)])->save();
    }

    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->assertSee('Item-15')
        ->assertDontSee('Item-5')
        ->call('nextPage')
        ->assertSee('Item-5')
        ->assertDontSee('Item-15');
});

test('record page only shows tasks for the authenticated user', function () {
    $otherUser = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    CompletedTask::create([
        'user_id' => $otherUser->id,
        'title' => 'Other User Task',
        'cost' => 200,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'approved',
    ]);

    CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'My Task',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'approved',
    ]);

    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->assertSee('My Task')
        ->assertDontSee('Other User Task');
});

test('record page shows submit button for pending tasks', function () {
    CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Pending Task',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->assertSee('Pending Task')
        ->assertSee('Pending')
        ->assertSeeHtml('Submit');
});

test('record page does not show submit button for approved tasks', function () {
    CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Approved Task',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'approved',
    ]);

    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->assertSee('Approved Task')
        ->assertDontSeeHtml('wire:click="submitTask');
});

test('submitting task from record page approves it and redirects to start', function () {
    $completedTask = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Pending Task',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    Livewire::actingAs($this->user)
        ->test(Record::class)
        ->call('submitTask', $completedTask->id)
        ->assertRedirect(route('dashboard.start'))
        ->assertSessionHas('task_completed', 'Task completed successfully');

    $completedTask->refresh();
    $this->user->refresh();

    expect($completedTask->status)->toBe('approved')
        ->and($this->user->tasks_completed)->toBe(1)
        ->and($this->user->total_commission)->toBe(50)
        ->and($this->user->balance)->toBe(50050);
});
