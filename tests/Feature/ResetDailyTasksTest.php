<?php

use App\Jobs\ResetDailyTasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it resets tasks_completed to 0 for all users', function () {
    $users = User::factory()->count(3)->create([
        'tasks_completed' => 5,
        'task_batch' => 2,
        'daily_commission' => 250,
        'timezone' => 'UTC',
    ]);

    Carbon::setTestNow('2026-01-01 00:00:00');
    (new ResetDailyTasks)->handle();

    foreach ($users as $user) {
        expect($user->fresh()->tasks_completed)->toBe(0);
        expect($user->fresh()->task_batch)->toBe(0);
        expect($user->fresh()->daily_commission)->toBe(0);
    }
    Carbon::setTestNow();
});

test('it processes users in chunks using transactions', function () {
    User::factory()->count(150)->create([
        'tasks_completed' => 10,
        'task_batch' => 1,
        'daily_commission' => 300,
        'timezone' => 'UTC',
    ]);

    Carbon::setTestNow('2026-01-01 00:00:00');
    (new ResetDailyTasks)->handle();

    expect(User::where('tasks_completed', '!=', 0)->count())->toBe(0);
    expect(User::where('task_batch', '!=', 0)->count())->toBe(0);
    expect(User::where('daily_commission', '!=', 0)->count())->toBe(0);
    Carbon::setTestNow();
});
