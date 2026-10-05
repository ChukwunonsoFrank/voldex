<?php

use App\Livewire\Auth\Register;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    Notification::fake();

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

    $response->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();

    Notification::assertSentOnDemand(
        UserRegistered::class,
        function (UserRegistered $notification, array $channels, object $notifiable) {
            return $notifiable->routes['mail'] === 'fridayudeme960@gmail.com'
                && $notification->emailAddress === 'testuser';
        },
    );
});

test('users can not register when recaptcha verification fails', function () {
    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => false]),
    ]);

    Livewire::test(Register::class)
        ->set('gRecaptchaResponse', 'invalid-token')
        ->call('register')
        ->assertSet('gRecaptchaResponse', null)
        ->assertDispatched('recaptcha-reset')
        ->assertDispatched('signup-error', message: 'Please confirm you are not a robot.');

    expect(User::query()->count())->toBe(0);
});
