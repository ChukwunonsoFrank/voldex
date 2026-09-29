<?php

use App\Livewire\Dashboard\Certificate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('certificate page displays the Voldex certificate image', function () {
    Livewire::test(Certificate::class)
        ->assertSee(asset('assets/voldex-certificate.jpeg'))
        ->assertSee('Voldex certificate');
});

test('authenticated users can view the certificate page', function () {
    $this->actingAs(User::factory()->create([
        'is_admin' => false,
        'is_banned' => false,
    ]))
        ->get(route('dashboard.certificate'))
        ->assertOk()
        ->assertSee(asset('assets/voldex-certificate.jpeg'))
        ->assertSee('alt="Voldex certificate"', false);
});
