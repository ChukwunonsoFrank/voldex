<?php

use App\Livewire\Admin\AdminWithdrawals;
use App\Models\User;
use App\Models\Withdrawal;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => 1]);
});

test('approving a withdrawal subtracts the amount from user processing_amount', function () {
    $user = User::factory()->create([
        'balance' => 1_000_00,
        'processing_amount' => 300_00,
    ]);

    $withdrawal = Withdrawal::create([
        'user_id' => $user->id,
        'amount' => 100_00,
        'payment_method' => 'TRC20',
        'address' => 'TXyzAddressForTesting',
        'status' => 'pending',
    ]);

    Livewire::actingAs($this->admin)
        ->test(AdminWithdrawals::class)
        ->call('approveWithdrawal', $withdrawal->id, $user->id, $withdrawal->amount);

    expect($user->fresh()->processing_amount)->toBe(200_00);
});

test('declining a withdrawal subtracts the amount from user processing_amount', function () {
    $user = User::factory()->create([
        'balance' => 1_000_00,
        'processing_amount' => 300_00,
    ]);

    $withdrawal = Withdrawal::create([
        'user_id' => $user->id,
        'amount' => 100_00,
        'payment_method' => 'TRC20',
        'address' => 'TXyzAddressForTesting',
        'status' => 'pending',
    ]);

    Livewire::actingAs($this->admin)
        ->test(AdminWithdrawals::class)
        ->call('declineWithdrawal', $withdrawal->id, $user->id, $withdrawal->amount);

    expect($user->fresh()->processing_amount)->toBe(200_00);
});

test('processing_amount cannot drop below zero when subtracted', function () {
    $user = User::factory()->create([
        'balance' => 1_000_00,
        'processing_amount' => 50_00,
    ]);

    $withdrawal = Withdrawal::create([
        'user_id' => $user->id,
        'amount' => 100_00,
        'payment_method' => 'TRC20',
        'address' => 'TXyzAddressForTesting',
        'status' => 'pending',
    ]);

    Livewire::actingAs($this->admin)
        ->test(AdminWithdrawals::class)
        ->call('declineWithdrawal', $withdrawal->id, $user->id, $withdrawal->amount);

    expect($user->fresh()->processing_amount)->toBe(0);
});
