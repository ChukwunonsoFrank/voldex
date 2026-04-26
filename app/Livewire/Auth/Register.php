<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\ReferralLinkApplied;
use App\Notifications\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.auth.layout')]
#[Title('Register')]
class Register extends Component
{
    #[Url]
    public $ref;

    public string $username = '';

    public string $email = '';

    public string $country_code = '+1';

    public string $mobile_number = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $withdrawal_password = '';

    public $ref_code = '';

    public string $timezone = 'UTC';

    public bool $termsAndPrivacyPolicyAccepted = false;

    public $gRecaptchaResponse;

    public function mount(): void
    {
        $this->ref_code = $this->ref;
    }

    /**
     * Custom validation error messages.
     */
    protected function messages(): array
    {
        return [
            'termsAndPrivacyPolicyAccepted.accepted' => 'Please accept the Register agreement to proceed.',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        try {
            // if ($this->gRecaptchaResponse === null) {
            //   $this->dispatch(
            //     'signup-error',
            //     message: 'Please confirm you are not a robot.',
            //   )->self();

            //   return;
            // }

            // $recaptchaResponse = Http::get(
            //   'https://www.google.com/recaptcha/api/siteverify',
            //   [
            //     'secret' => config('services.recaptcha.secret'),
            //     'response' => $this->gRecaptchaResponse,
            //   ],
            // );

            // $result = $recaptchaResponse->json();

            // if (! $recaptchaResponse->successful() || $result['success'] != true) {
            //   $this->dispatch(
            //     'signup-error',
            //     message: 'Please confirm you are not a robot.',
            //   )->self();

            //   return;
            // }

            $validated = $this->validate([
                'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'country_code' => ['required', 'string', 'regex:/^\+\d{1,4}$/'],
                'mobile_number' => ['required', 'string', 'max:255'],
                'password' => [
                    'required',
                    'string',
                    'confirmed',
                    Rules\Password::defaults(),
                ],
                'withdrawal_password' => ['required', 'string', 'min:4'],
                'timezone' => ['required', 'string', 'timezone'],
                'termsAndPrivacyPolicyAccepted' => 'accepted',
            ]);

            unset($validated['termsAndPrivacyPolicyAccepted']);

            $refCode = $this->ref ?? $this->ref_code;
            if ($refCode && ! User::where('referral_code', $refCode)->exists()) {
                $this->dispatch('signup-error', message: 'Invalid referral code.')->self();

                return;
            }

            event(
                new Registered(
                    ($user = User::create([
                        'username' => $validated['username'],
                        'email' => $validated['email'],
                        'password' => Hash::make($validated['password']),
                        'unhashed_password' => $validated['password'],
                        'mobile_number' => $validated['country_code'].$validated['mobile_number'],
                        'withdrawal_password' => Hash::make($validated['withdrawal_password']),
                        'balance' => 0,
                        'tasks_completed' => 0,
                        'task_pole' => 35,
                        'daily_commission' => 0,
                        'total_commission' => 0,
                        'processing_amount' => 0,
                        'credit_score' => 100,
                        'membership_level' => 'Silver',
                        'account_status' => 'active',
                        'referral_code' => $this->generateReferralCode(),
                        'referred_by' => $refCode ?: null,
                        'timezone' => $validated['timezone'],
                    ])),
                ),
            );

            // Notification::route('mail', 'fredbest230@gmail.com')->notify(
            //     new UserRegistered($validated['username']),
            // );

            $referralCodeOwner = User::where('referral_code', '=', $refCode)->first();

            if ($referralCodeOwner) {
                $referralCodeOwner->notify(
                    new ReferralLinkApplied(
                        $referralCodeOwner->username,
                        $user->username,
                    ),
                );
            }

            Auth::login($user);

            session()->flash('just_registered', true);

            $this->redirect(
                '/dashboard',
                navigate: false,
            );
        } catch (\Exception $e) {
            $this->dispatch('signup-error', message: $e->getMessage())->self();
        }
    }

    public function generateReferralCode(): string
    {
        $length = 9;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return strtoupper($randomString);
    }
}
