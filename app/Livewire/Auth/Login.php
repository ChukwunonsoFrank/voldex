<?php

namespace App\Livewire\Auth;

use App\Notifications\UserLoggedIn;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
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

    #[Validate('nullable|string|timezone')]
    public ?string $timezone = null;

    public ?string $gRecaptchaResponse = null;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        try {
            $this->validate();

            $this->ensureIsNotRateLimited();

            if (! $this->hasValidRecaptchaResponse()) {
                return;
            }

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

                $this->resetRecaptchaChallenge();

                throw ValidationException::withMessages([
                    'username' => __('auth.failed'),
                ]);
            }

            RateLimiter::clear($this->throttleKey());
            Session::regenerate();

            if ($this->timezone !== null) {
                Auth::user()->update(['timezone' => $this->timezone]);
            }

            Notification::route('mail', config('mail.support_address'))->notify(
                new UserLoggedIn(Auth::user()->username),
            );

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

    protected function hasValidRecaptchaResponse(): bool
    {
        if (blank($this->gRecaptchaResponse)) {
            $this->resetRecaptchaChallenge();
            $this->dispatch('login-error', message: 'Please confirm you are not a robot.')->self();

            return false;
        }

        $recaptchaResponse = Http::asForm()
            ->timeout(10)
            ->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret'),
                'response' => $this->gRecaptchaResponse,
            ]);

        if (! $recaptchaResponse->successful() || $recaptchaResponse->json('success') !== true) {
            $this->resetRecaptchaChallenge();
            $this->dispatch('login-error', message: 'Please confirm you are not a robot.')->self();

            return false;
        }

        return true;
    }

    /**
     * Clear the one-time Google token and reset the widget, so the next
     * attempt is presented with a fresh challenge instead of a stale token
     * that Google will reject as already used. The event must be dispatched
     * globally because the listener lives in the shared auth layout.
     */
    protected function resetRecaptchaChallenge(): void
    {
        $this->gRecaptchaResponse = null;
        $this->dispatch('recaptcha-reset');
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
            Str::lower($this->username).'|'.request()->ip(),
        );
    }
}
