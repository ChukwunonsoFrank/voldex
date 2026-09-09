<?php

use App\Livewire\Dashboard\BindWallet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('defaults the wallet network to Bitcoin', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(BindWallet::class)
        ->assertSet('network', 'Bitcoin');
});

it('binds wallet when withdrawal password is correct', function () {
    $user = User::factory()->create([
        'withdrawal_password' => Hash::make('secret123'),
    ]);

    Livewire::actingAs($user)
        ->test(BindWallet::class)
        ->set('network', 'TRC 20')
        ->set('wallet_address', 'TAddr123abc')
        ->set('withdrawal_password', 'secret123')
        ->call('bind')
        ->assertDispatched('bind-wallet', message: 'Wallet bound successfully.');

    $user->refresh();
    expect($user->withdrawal_address)->toBe('TAddr123abc');
    expect($user->withdrawal_address_type)->toBe('TRC 20');
});

it('binds a Bitcoin wallet when withdrawal password is correct', function () {
    $user = User::factory()->create([
        'withdrawal_password' => Hash::make('secret123'),
    ]);

    Livewire::actingAs($user)
        ->test(BindWallet::class)
        ->assertSee('Bitcoin')
        ->set('network', 'Bitcoin')
        ->set('wallet_address', 'bc1qexamplewalletaddress')
        ->set('withdrawal_password', 'secret123')
        ->call('bind')
        ->assertDispatched('bind-wallet', message: 'Wallet bound successfully.');

    $user->refresh();
    expect($user->withdrawal_address)->toBe('bc1qexamplewalletaddress');
    expect($user->withdrawal_address_type)->toBe('Bitcoin');
});

it('dispatches bind-error when withdrawal password is incorrect', function () {
    $user = User::factory()->create([
        'withdrawal_password' => Hash::make('secret123'),
    ]);

    Livewire::actingAs($user)
        ->test(BindWallet::class)
        ->set('network', 'ERC 20')
        ->set('wallet_address', 'EAddr456def')
        ->set('withdrawal_password', 'wrongpassword')
        ->call('bind')
        ->assertDispatched('bind-error', message: 'Incorrect withdrawal password.');

    $user->refresh();
    expect($user->withdrawal_address)->toBeNull();
});

it('dispatches bind-error when validation fails', function () {
    $user = User::factory()->create([
        'withdrawal_password' => Hash::make('secret123'),
    ]);

    Livewire::actingAs($user)
        ->test(BindWallet::class)
        ->set('wallet_address', '')
        ->set('withdrawal_password', '')
        ->call('bind')
        ->assertDispatched('bind-error');
});
