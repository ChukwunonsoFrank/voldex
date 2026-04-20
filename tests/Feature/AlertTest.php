<?php

use App\Livewire\Dashboard\Alert;
use App\Models\Alert as AlertModel;
use App\Models\User;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('authenticated user can see their alerts', function () {
    $user = User::factory()->create();

    $alerts = AlertModel::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    Livewire::actingAs($user)
        ->test(Alert::class)
        ->assertStatus(200)
        ->assertSee($alerts[0]->title)
        ->assertSee($alerts[1]->title)
        ->assertSee($alerts[2]->title);
});

test('user does not see alerts belonging to other users', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $otherAlert = AlertModel::factory()->create([
        'user_id' => $otherUser->id,
        'title' => 'Other User Alert',
    ]);

    Livewire::actingAs($user)
        ->test(Alert::class)
        ->assertStatus(200)
        ->assertDontSee('Other User Alert')
        ->assertSee('No alerts yet.');
});

test('alerts are displayed latest first', function () {
    $user = User::factory()->create();

    $oldest = AlertModel::factory()->create([
        'user_id' => $user->id,
        'title' => 'Oldest Alert',
        'created_at' => now()->subDays(2),
    ]);

    $newest = AlertModel::factory()->create([
        'user_id' => $user->id,
        'title' => 'Newest Alert',
        'created_at' => now(),
    ]);

    Livewire::actingAs($user)
        ->test(Alert::class)
        ->assertStatus(200)
        ->assertSeeInOrder(['Newest Alert', 'Oldest Alert']);
});
