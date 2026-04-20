<?php

use App\Livewire\Dashboard\Withdraw;
use App\Livewire\Dashboard\WithdrawPasswordStep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('redirects to password step when accessing withdraw without verification', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->assertRedirect(route('dashboard.withdraw-password-step'));
});

it('allows access to withdraw when password is verified', function () {
    $user = User::factory()->create();

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->assertSuccessful();
});

it('redirects to withdraw after correct password', function () {
    $user = User::factory()->create([
        'withdrawal_password' => Hash::make('secret123'),
    ]);

    Livewire::actingAs($user)
        ->test(WithdrawPasswordStep::class)
        ->set('withdrawal_password', 'secret123')
        ->call('verifyWithdrawalPassword')
        ->assertRedirect(route('dashboard.withdraw'));
});

it('dispatches error when withdrawal password is incorrect', function () {
    $user = User::factory()->create([
        'withdrawal_password' => Hash::make('secret123'),
    ]);

    Livewire::actingAs($user)
        ->test(WithdrawPasswordStep::class)
        ->set('withdrawal_password', 'wrongpassword')
        ->call('verifyWithdrawalPassword')
        ->assertDispatched('change-error', message: 'Invalid withdrawal password.');
});

it('validates withdrawal password is required', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(WithdrawPasswordStep::class)
        ->set('withdrawal_password', '')
        ->call('verifyWithdrawalPassword')
        ->assertHasErrors(['withdrawal_password' => 'required']);
});
