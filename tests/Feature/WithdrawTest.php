<?php

use App\Livewire\Dashboard\Withdraw;
use App\Models\User;
use App\Models\Withdrawal;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('successful withdrawal increments user processing_amount by the amount in cents', function () {
    $user = User::factory()->create([
        'balance' => 1_000_00,
        'processing_amount' => 0,
        'withdrawal_address' => 'TXyzAddressForTesting',
        'withdrawal_address_type' => 'TRC20',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 50)
        ->call('submitWithdrawal');

    expect($user->fresh()->processing_amount)->toBe(50_00);
    expect(Withdrawal::where('user_id', $user->id)->where('status', 'pending')->count())->toBe(1);
});

test('failed withdrawal does not change processing_amount', function () {
    $user = User::factory()->create([
        'balance' => 1_000_00,
        'processing_amount' => 250_00,
        'withdrawal_address' => 'TXyzAddressForTesting',
        'withdrawal_address_type' => 'TRC20',
    ]);

    session(['withdrawal_password_verified' => true]);

    Livewire::actingAs($user)
        ->test(Withdraw::class)
        ->set('amount', 0)
        ->call('submitWithdrawal');

    expect($user->fresh()->processing_amount)->toBe(250_00);
});
