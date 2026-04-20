<?php

use App\Livewire\Dashboard\Withdraw;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a withdrawal entry when all checks pass', function () {
    $user = User::factory()->create([
        'balance' => 50000, // $500 in cents
        'withdrawal_address' => 'TAddr123abc',
        'withdrawal_address_type' => 'TRC 20',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 100) // $100
        ->call('submitWithdrawal')
        ->assertDispatched('change-success', message: 'Withdrawal initiated successfully');

    $withdrawal = Withdrawal::where('user_id', $user->id)->where('status', 'pending')->first();
    expect($withdrawal)->not->toBeNull();
    expect($withdrawal->amount)->toBe(10000); // stored in cents
});

it('dispatches error for insufficient balance', function () {
    $user = User::factory()->create([
        'balance' => 5000, // $50 in cents
        'withdrawal_address' => 'TAddr123abc',
        'withdrawal_address_type' => 'TRC 20',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 100) // $100
        ->call('submitWithdrawal')
        ->assertDispatched('change-error', message: 'Insufficient balance');

    expect(Withdrawal::count())->toBe(0);
});

it('dispatches error when withdrawal address is not set', function () {
    $user = User::factory()->create([
        'balance' => 50000,
        'withdrawal_address' => null,
        'withdrawal_address_type' => null,
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 100)
        ->call('submitWithdrawal')
        ->assertDispatched('change-error', message: 'You need to bind a wallet address to your account to process withdrawals');

    expect(Withdrawal::count())->toBe(0);
});

it('dispatches error for negative amount', function () {
    $user = User::factory()->create([
        'balance' => 50000,
        'withdrawal_address' => 'TAddr123abc',
        'withdrawal_address_type' => 'TRC 20',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', -50)
        ->call('submitWithdrawal')
        ->assertDispatched('change-error', message: 'Invalid withdrawal amount');

    expect(Withdrawal::count())->toBe(0);
});

it('dispatches error for zero amount', function () {
    $user = User::factory()->create([
        'balance' => 50000,
        'withdrawal_address' => 'TAddr123abc',
        'withdrawal_address_type' => 'TRC 20',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 0)
        ->call('submitWithdrawal')
        ->assertDispatched('change-error', message: 'Invalid withdrawal amount');

    expect(Withdrawal::count())->toBe(0);
});

it('dispatches error when a pending withdrawal already exists', function () {
    $user = User::factory()->create([
        'balance' => 50000,
        'withdrawal_address' => 'TAddr123abc',
        'withdrawal_address_type' => 'TRC 20',
    ]);

    Withdrawal::create([
        'user_id' => $user->id,
        'amount' => 50,
        'payment_method' => 'TRC 20',
        'address' => 'TAddr123abc',
        'status' => 'pending',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 100)
        ->call('submitWithdrawal')
        ->assertDispatched('change-error', message: 'You have 1 or more processing transactions. Please wait until processing is complete');

    expect(Withdrawal::where('user_id', $user->id)->count())->toBe(1);
});
