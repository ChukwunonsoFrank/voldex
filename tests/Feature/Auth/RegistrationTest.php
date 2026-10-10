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
        ->set('username', 'testuser')
        ->set('email', 'testuser@example.com')
        ->set('country_code', '+234')
        ->set('mobile_number', '1234567890')
        ->set('password', 'Password1!')
        ->set('password_confirmation', 'Password1!')
        ->set('withdrawal_password', '123456')
        ->set('termsAndPrivacyPolicyAccepted', true)
        ->set('gRecaptchaResponse', 'invalid-token')
        ->call('register')
        ->assertSet('gRecaptchaResponse', null)
        ->assertDispatched('recaptcha-reset')
        ->assertDispatched('signup-error', message: 'Please confirm you are not a robot.');

    expect(User::query()->count())->toBe(0);
});

test('validation failures are reported to the user without consuming the captcha token', function () {
    Http::fake();

    Livewire::test(Register::class)
        ->set('username', 'testuser')
        ->set('email', 'testuser@example.com')
        ->set('country_code', '+234')
        ->set('mobile_number', '1234567890')
        ->set('password', 'Password1!')
        ->set('password_confirmation', 'Password1!')
        ->set('withdrawal_password', '123456')
        ->set('termsAndPrivacyPolicyAccepted', false)
        ->set('gRecaptchaResponse', 'one-time-token')
        ->call('register')
        ->assertHasErrors('termsAndPrivacyPolicyAccepted')
        ->assertDispatched('signup-error', message: 'Please accept the Register agreement to proceed.')
        ->assertSet('gRecaptchaResponse', 'one-time-token');

    Http::assertNothingSent();

    expect(User::query()->count())->toBe(0);
});

test('a user can register on retry after fixing a validation error without re-solving recaptcha', function () {
    Notification::fake();

    Http::fakeSequence()
        ->push(['success' => true])
        ->push(['success' => false, 'error-codes' => ['timeout-or-duplicate']]);

    $component = Livewire::test(Register::class)
        ->set('username', 'retryuser')
        ->set('email', 'retryuser@example.com')
        ->set('country_code', '+234')
        ->set('mobile_number', '1234567890')
        ->set('password', 'Password1!')
        ->set('password_confirmation', 'Password1!')
        ->set('withdrawal_password', '123456')
        ->set('termsAndPrivacyPolicyAccepted', false)
        ->set('gRecaptchaResponse', 'one-time-token')
        ->call('register')
        ->assertHasErrors('termsAndPrivacyPolicyAccepted')
        ->assertNotDispatched('recaptcha-reset')
        ->assertSet('gRecaptchaResponse', 'one-time-token');

    $component
        ->set('termsAndPrivacyPolicyAccepted', true)
        ->call('register')
        ->assertRedirect(route('dashboard', absolute: false));

    expect(User::query()->where('username', 'retryuser')->exists())->toBeTrue();
});

test('an unexpected registration failure resets the captcha widget so the user can retry', function () {
    Notification::fake();

    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify*' => Http::response(['success' => true]),
    ]);

    User::creating(function () {
        throw new \RuntimeException('database unavailable');
    });

    try {
        Livewire::test(Register::class)
            ->set('username', 'testuser')
            ->set('email', 'testuser@example.com')
            ->set('country_code', '+234')
            ->set('mobile_number', '1234567890')
            ->set('password', 'Password1!')
            ->set('password_confirmation', 'Password1!')
            ->set('withdrawal_password', '123456')
            ->set('termsAndPrivacyPolicyAccepted', true)
            ->set('gRecaptchaResponse', 'one-time-token')
            ->call('register')
            ->assertSet('gRecaptchaResponse', null)
            ->assertDispatched('recaptcha-reset')
            ->assertDispatched('signup-error', message: 'Something went wrong while creating your account. Please try again.');
    } finally {
        User::flushEventListeners();
    }

    expect(User::query()->count())->toBe(0);
});
