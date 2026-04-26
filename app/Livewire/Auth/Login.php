<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth.layout')]
#[Title('Login')]
class Login extends Component
{
  #[Validate('required|string')]
  public string $username = '';

  #[Validate('required|string')]
  public string $password = '';

  public bool $remember = false;

  public string $timezone = 'UTC';

  /**
   * Handle an incoming authentication request.
   */
  public function login()
  {
    try {
      $this->validate();

      $this->ensureIsNotRateLimited();

      if (
        ! Auth::attempt(
          [
            'username' => $this->username,
            'password' => $this->password,
          ],
          $this->remember,
        )
      ) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
          'username' => __('auth.failed'),
        ]);
      }

      RateLimiter::clear($this->throttleKey());
      Session::regenerate();

      // Update user's timezone
      Auth::user()->update(['timezone' => $this->timezone]);

      session()->flash('just_logged_in', true);

      if (Auth::user()->is_admin) {
        return redirect('/admin/dashboard/users');
      }

      $this->redirectIntended(
        default: '/dashboard',
      );
    } catch (\Exception $e) {
      $this->dispatch('login-error', message: $e->getMessage())->self();
    }
  }

  /**
   * Ensure the authentication request is not rate limited.
   */
  protected function ensureIsNotRateLimited(): void
  {
    if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
      return;
    }

    event(new Lockout(request()));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw ValidationException::withMessages([
      'username' => __('auth.throttle', [
        'seconds' => $seconds,
        'minutes' => ceil($seconds / 60),
      ]),
    ]);
  }

  /**
   * Get the authentication rate limiting throttle key.
   */
  protected function throttleKey(): string
  {
    return Str::transliterate(
      Str::lower($this->username) . '|' . request()->ip(),
    );
  }
}
