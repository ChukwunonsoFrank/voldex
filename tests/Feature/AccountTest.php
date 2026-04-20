<?php

use App\Livewire\Dashboard\Account;
use App\Models\MembershipLevel;
use App\Models\User;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    MembershipLevel::create([
        'name' => 'VIP0',
        'percentage' => 0.5,
    ]);
});

test('account page shows lien amount instead of balance when on hold', function () {
    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
        'lien_status' => 'on_hold',
        'lien_amount' => '750000',
    ]);

    Livewire::actingAs($user)
        ->test(Account::class)
        ->assertSee('-7,500.00');
});

test('account page shows balance when not on hold', function () {
    $user = User::factory()->create([
        'membership_level' => 'VIP0',
        'balance' => 50000,
        'tasks_completed' => 0,
        'task_pole' => 35,
        'daily_commission' => 0,
        'total_commission' => 0,
        'processing_amount' => 0,
    ]);

    Livewire::actingAs($user)
        ->test(Account::class)
        ->assertSee('500.00');
});
