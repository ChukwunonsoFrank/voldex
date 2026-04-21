<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true]),
    ]);

    $response = Livewire::test(Register::class)
        ->set('username', 'testuser')
        ->set('email', 'testuser@example.com')
        ->set('country_code', '+234')
        ->set('mobile_number', '1234567890')
        ->set('password', 'Password1!')
        ->set('password_confirmation', 'Password1!')
        ->set('withdrawal_password', '123456')
        ->set('termsAndPrivacyPolicyAccepted', true)
        ->set('gRecaptchaResponse', 'fake-token')
        ->call('register');

    $response->assertRedirect(route('dashboard.robot', absolute: false));

    $this->assertAuthenticated();
});
