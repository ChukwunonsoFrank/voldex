<?php

use App\Livewire\Admin\UsersDetails;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('shows toggle as off when lien_status is off_hold', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create([
        'lien_status' => 'off_hold',
        'lien_amount' => null,
    ]);

    Livewire::actingAs($admin)
        ->test(UsersDetails::class, ['id' => $user->id])
        ->assertSee('Off Hold');
});

it('shows toggle as on when lien_status is on_hold and lien_amount is set', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create([
        'lien_status' => 'on_hold',
        'lien_amount' => '-5000',
    ]);

    Livewire::actingAs($admin)
        ->test(UsersDetails::class, ['id' => $user->id])
        ->assertSee('On Hold');
});

it('releases lien when toggle is switched off', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create([
        'lien_status' => 'on_hold',
        'lien_amount' => '-5000',
    ]);

    Livewire::actingAs($admin)
        ->test(UsersDetails::class, ['id' => $user->id])
        ->call('releaseLien')
        ->assertSee('Off Hold');

    $user->refresh();
    expect($user->lien_status)->toBe('off_hold');
    expect($user->lien_amount)->toBeNull();
});

it('shows toggle as off when lien_status is on_hold but lien_amount is null', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create([
        'lien_status' => 'on_hold',
        'lien_amount' => null,
    ]);

    Livewire::actingAs($admin)
        ->test(UsersDetails::class, ['id' => $user->id])
        ->assertSee('Off Hold');
});
