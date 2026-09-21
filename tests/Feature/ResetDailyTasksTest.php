<?php

use App\Jobs\ResetDailyTasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

uses(RefreshDatabase::class);

afterEach(function () {
    Carbon::setTestNow();
});

test('it catches up a reset after the users local date has advanced', function () {
    Carbon::setTestNow('2026-01-02 15:45:00 UTC');

    $user = User::factory()->create([
        'tasks_completed' => 5,
        'task_batch' => 2,
        'daily_commission' => 250,
        'timezone' => 'Africa/Lagos',
        'last_reset_at' => '2026-01-01 00:05:00',
    ]);

    $resetCount = (new ResetDailyTasks)->handle('test');

    $user->refresh();

    expect($resetCount)->toBe(1)
        ->and($user->tasks_completed)->toBe(0)
        ->and($user->task_batch)->toBe(0)
        ->and($user->daily_commission)->toBe(0)
        ->and($user->last_reset_at->toDateTimeString())->toBe('2026-01-02 15:45:00');
});

test('it does not reset a user more than once on their local date', function () {
    Carbon::setTestNow('2026-01-02 23:30:00 UTC');

    $user = User::factory()->create([
        'tasks_completed' => 7,
        'task_batch' => 2,
        'daily_commission' => 450,
        'timezone' => 'UTC',
        'last_reset_at' => '2026-01-02 00:10:00',
    ]);

    $resetCount = (new ResetDailyTasks)->handle('test');

    $user->refresh();

    expect($resetCount)->toBe(0)
        ->and($user->tasks_completed)->toBe(7)
        ->and($user->task_batch)->toBe(2)
        ->and($user->daily_commission)->toBe(450);
});

test('it evaluates the reset date in each users timezone', function () {
    Carbon::setTestNow('2026-01-02 00:30:00 UTC');

    $dueUser = User::factory()->create([
        'tasks_completed' => 8,
        'timezone' => 'Asia/Tokyo',
        'last_reset_at' => '2026-01-01 14:00:00',
    ]);
    $notDueUser = User::factory()->create([
        'tasks_completed' => 9,
        'timezone' => 'America/Los_Angeles',
        'last_reset_at' => '2026-01-01 08:30:00',
    ]);

    $resetCount = (new ResetDailyTasks)->handle('test');

    expect($resetCount)->toBe(1)
        ->and($dueUser->fresh()->tasks_completed)->toBe(0)
        ->and($notDueUser->fresh()->tasks_completed)->toBe(9);
});

test('it skips invalid timezones without preventing other users from resetting', function () {
    Carbon::setTestNow('2026-01-02 12:00:00 UTC');

    $invalidUser = User::factory()->create([
        'tasks_completed' => 4,
        'timezone' => 'Invalid/Timezone',
        'last_reset_at' => '2026-01-01 00:00:00',
    ]);
    $validUser = User::factory()->create([
        'tasks_completed' => 6,
        'timezone' => 'UTC',
        'last_reset_at' => '2026-01-01 00:00:00',
    ]);

    $resetCount = (new ResetDailyTasks)->handle('test');

    expect($resetCount)->toBe(1)
        ->and($invalidUser->fresh()->tasks_completed)->toBe(4)
        ->and($validUser->fresh()->tasks_completed)->toBe(0);
});

test('it does not run while another reset holds the execution lock', function () {
    Carbon::setTestNow('2026-01-02 12:00:00 UTC');

    $user = User::factory()->create([
        'tasks_completed' => 3,
        'timezone' => 'UTC',
        'last_reset_at' => '2026-01-01 00:00:00',
    ]);
    $lock = Cache::lock('daily-task-reset', 900);
    $lock->get();

    try {
        $resetCount = (new ResetDailyTasks)->handle('test');
    } finally {
        $lock->release();
    }

    expect($resetCount)->toBe(0)
        ->and($user->fresh()->tasks_completed)->toBe(3);
});

test('the manual command only resets users whose local date has advanced', function () {
    Carbon::setTestNow('2026-01-02 12:00:00 UTC');

    $dueUser = User::factory()->create([
        'tasks_completed' => 3,
        'timezone' => 'UTC',
        'last_reset_at' => '2026-01-01 00:00:00',
    ]);
    $notDueUser = User::factory()->create([
        'tasks_completed' => 5,
        'timezone' => 'UTC',
        'last_reset_at' => '2026-01-02 01:00:00',
    ]);

    $this->artisan('app:reset-daily-tasks')
        ->expectsOutput('Reset daily task limits for 1 users.')
        ->assertSuccessful();

    expect($dueUser->fresh()->tasks_completed)->toBe(0)
        ->and($notDueUser->fresh()->tasks_completed)->toBe(5);
});
