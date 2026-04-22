<?php

use App\Livewire\Dashboard\Optimize;
use App\Livewire\Dashboard\Start;
use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Models\Task;
use App\Models\User;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->membershipLevel = MembershipLevel::create([
        'name' => 'VIP0',
        'percentage' => 0.5,
    ]);

    $this->task = Task::create([
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'task_level' => 'VIP0',
    ]);

    $this->user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);
});

test('start page displays user balance data', function () {
    Livewire::actingAs($this->user)
        ->test(Start::class)
        ->assertSee('500.00 USDT')
        ->assertSee('0.00 USDT')
        ->assertSee('Start Now (0/35)');
});

test('optimize page displays commission in USDT', function () {
    $completedTask = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($this->user)
        ->test(Optimize::class)
        ->assertSee('0.50 USDT');
});

test('clicking start now creates a pending completed task and redirects', function () {
    Livewire::actingAs($this->user)
        ->test(Start::class)
        ->call('startTask')
        ->assertRedirect(route('dashboard.optimize'));

    $completedTask = CompletedTask::where('user_id', $this->user->id)->first();

    expect($completedTask)->not->toBeNull()
        ->and($completedTask->status)->toBe('pending')
        ->and($completedTask->title)->toBe('Test Product')
        ->and($completedTask->cost)->toBe('100');
});

test('optimize page displays pending task data', function () {
    $completedTask = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($this->user)
        ->test(Optimize::class)
        ->assertSee('Test Product')
        ->assertSee('100.00 USDT')
        ->assertSee('0.50 USDT');
});

test('submitting task sets status to approved and increments user data', function () {
    $completedTask = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($this->user)
        ->test(Optimize::class)
        ->call('submitTask')
        ->assertRedirect(route('dashboard.start'));

    $completedTask->refresh();
    $this->user->refresh();

    expect($completedTask->status)->toBe('approved')
        ->and($this->user->tasks_completed)->toBe(1)
        ->and($this->user->total_commission)->toBe(50)
        ->and($this->user->balance)->toBe(50050);
});

test('todays commission shows only tasks completed today', function () {
    $yesterday = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Yesterday Task',
        'cost' => 200,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'approved',
    ]);
    $yesterday->query()->where('id', $yesterday->id)->update(['updated_at' => now()->subDay()]);

    CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Today Task',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'approved',
    ]);

    Livewire::actingAs($this->user)
        ->test(Start::class)
        ->assertSee('0.50 USDT');
});

test('start page dispatches task-completed toast after task submission', function () {
    $completedTask = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($this->user)
        ->test(Optimize::class)
        ->call('submitTask')
        ->assertRedirect(route('dashboard.start'))
        ->assertSessionHas('task_completed', 'Task completed successfully');

    Livewire::actingAs($this->user)
        ->test(Start::class)
        ->assertDispatched('task-completed', message: 'Task completed successfully');
});

test('optimize page redirects if no pending task', function () {
    Livewire::actingAs($this->user)
        ->test(Optimize::class)
        ->assertRedirect(route('dashboard.start'));
});

test('starting a task with no tasks for membership level dispatches message', function () {
    $user = User::factory()->create([
        'membership_level' => 'Platinum',
        'balance' => 50000,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    Livewire::actingAs($user)
        ->test(Start::class)
        ->call('startTask')
        ->assertDispatched('task-limit-reached', message: 'No tasks available for your membership level at this time.');

    expect(CompletedTask::where('user_id', $user->id)->exists())->toBeFalse();
});

test('on hold user at task limit gets extra deposit message', function () {
    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 35,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
        'lien_status' => 'on_hold',
        'lien_amount' => '750000',
    ]);

    Livewire::actingAs($user)
        ->test(Start::class)
        ->call('startTask')
        ->assertDispatched('task-limit-reached', message: 'You need to make an extra deposit to proceed with completion of tasks.');
});

test('start page shows negative lien amount instead of balance when account is on hold', function () {
    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
        'lien_status' => 'on_hold',
        'lien_amount' => '750000',
    ]);

    Livewire::actingAs($user)
        ->test(Start::class)
        ->assertSee('-7,500.00 USDT');
});

test('starting a new task with a pending task redirects to record page', function () {
    CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Existing Pending Task',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '',
        'rating_id' => '',
        'status' => 'pending',
    ]);

    Livewire::actingAs($this->user)
        ->test(Start::class)
        ->call('startTask')
        ->assertRedirect(route('dashboard.record'))
        ->assertSessionHas('pending_task_warning', 'You have one or more tasks pending completion. Complete it to continue.');
});

test('user with balance below membership minimum balance gets toast', function () {
    $this->membershipLevel->update(['minimum_balance' => '100000']);

    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    Livewire::actingAs($user)
        ->test(Start::class)
        ->call('startTask')
        ->assertDispatched('minimum-balance-required', message: 'The minimum balance for this level is 1,000.00 USDT');
});

test('star rating saves to completed task on submit', function () {
    $completedTask = CompletedTask::create([
        'user_id' => $this->user->id,
        'title' => 'Test Product',
        'cost' => 100,
        'task_image_path' => 'tasks/test.jpg',
        'rating' => '0',
        'rating_id' => 'abc12345678901',
        'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    Livewire::actingAs($this->user)
        ->test(Optimize::class)
        ->assertSee('abc12345678901')
        ->assertSet('rating', 0)
        ->call('setRating', 4)
        ->assertSet('rating', 4)
        ->call('setRating', 2)
        ->assertSet('rating', 2)
        ->call('setRating', 2)
        ->assertSet('rating', 0)
        ->call('setRating', 5)
        ->assertSet('rating', 5)
        ->call('submitTask')
        ->assertRedirect(route('dashboard.start'));

    $completedTask->refresh();
    expect($completedTask->rating)->toBe('5');
});

test('user with insufficient balance gets insufficient balance toast', function () {
    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 500,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    Livewire::actingAs($user)
        ->test(Start::class)
        ->call('startTask')
        ->assertDispatched('insufficient-balance', message: 'Insufficient balance to complete task. Top up to continue.');
});
