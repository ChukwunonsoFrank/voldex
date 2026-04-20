<?php

use App\Livewire\Dashboard\ChangePassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('updates password when old password is correct', function () {
    $user = User::factory()->create([
        'password' => Hash::make('oldpassword'),
    ]);

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('old_password', 'oldpassword')
        ->set('new_password', 'newpassword')
        ->set('confirm_password', 'newpassword')
        ->call('changePassword')
        ->assertDispatched('change-success', message: 'Password updated successfully.');

    $user->refresh();
    expect(Hash::check('newpassword', $user->password))->toBeTrue();
});

it('dispatches error when old password is incorrect', function () {
    $user = User::factory()->create([
        'password' => Hash::make('oldpassword'),
    ]);

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('old_password', 'wrongpassword')
        ->set('new_password', 'newpassword')
        ->set('confirm_password', 'newpassword')
        ->call('changePassword')
        ->assertDispatched('change-error', message: 'Old password is incorrect.');
});

it('dispatches error when confirm password does not match', function () {
    $user = User::factory()->create([
        'password' => Hash::make('oldpassword'),
    ]);

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('old_password', 'oldpassword')
        ->set('new_password', 'newpassword')
        ->set('confirm_password', 'differentpassword')
        ->call('changePassword')
        ->assertDispatched('change-error');
});

it('dispatches error when password fields are empty', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('old_password', '')
        ->set('new_password', '')
        ->set('confirm_password', '')
        ->call('changePassword')
        ->assertDispatched('change-error');
});

it('updates withdrawal password', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('withdrawal_password', 'newsecret123')
        ->call('updateWithdrawalPassword')
        ->assertDispatched('change-success', message: 'Withdrawal password updated successfully.');

    $user->refresh();
    expect(Hash::check('newsecret123', $user->withdrawal_password))->toBeTrue();
});

it('dispatches error when withdrawal password is too short', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('withdrawal_password', 'ab')
        ->call('updateWithdrawalPassword')
        ->assertDispatched('change-error');
});

it('dispatches error when withdrawal password is empty', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ChangePassword::class)
        ->set('withdrawal_password', '')
        ->call('updateWithdrawalPassword')
        ->assertDispatched('change-error');
});
