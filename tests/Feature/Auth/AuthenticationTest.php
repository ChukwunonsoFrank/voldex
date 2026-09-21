<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use App\Notifications\UserLoggedIn;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response
        ->assertStatus(200)
        ->assertSee(route('password.request', absolute: false))
        ->assertDontSee('href="'.route('password.request').'" class="text-muted"', false);
});

test('users can authenticate using the login screen', function () {
    Notification::fake();

    $user = User::factory()->create([
        'timezone' => 'Africa/Lagos',
    ]);

    $response = Livewire::test(Login::class)
        ->set('username', $user->username)
        ->set('password', 'password')
        ->call('login');

    $response
        ->assertHasNoErrors();

    $this->assertAuthenticated();
    expect($user->fresh()->timezone)->toBe('Africa/Lagos');

    Notification::assertSentOnDemand(
        UserLoggedIn::class,
        function (UserLoggedIn $notification, array $channels, object $notifiable) use ($user) {
            return $notifiable->routes['mail'] === 'fridayudeme960@gmail.com'
                && $notification->username === $user->username;
        },
    );
});

test('login updates the users timezone when the browser supplies a valid timezone', function () {
    Notification::fake();

    $user = User::factory()->create([
        'timezone' => 'UTC',
    ]);

    Livewire::test(Login::class)
        ->set('username', $user->username)
        ->set('password', 'password')
        ->set('timezone', 'Africa/Lagos')
        ->call('login')
        ->assertHasNoErrors();

    expect($user->fresh()->timezone)->toBe('Africa/Lagos');
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = Livewire::test(Login::class)
        ->set('username', $user->username)
        ->set('password', 'wrong-password')
        ->call('login');

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect('/login');

    $this->assertGuest();
});
