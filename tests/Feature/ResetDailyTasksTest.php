<?php

use App\Jobs\ResetDailyTasks;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it resets tasks_completed to 0 for all users', function () {
    $users = User::factory()->count(3)->create([
        'tasks_completed' => 5,
    ]);

    (new ResetDailyTasks)->handle();

    foreach ($users as $user) {
        expect($user->fresh()->tasks_completed)->toBe(0);
    }
});

test('it processes users in chunks using transactions', function () {
    User::factory()->count(150)->create([
        'tasks_completed' => 10,
    ]);

    (new ResetDailyTasks)->handle();

    expect(User::where('tasks_completed', '!=', 0)->count())->toBe(0);
});
