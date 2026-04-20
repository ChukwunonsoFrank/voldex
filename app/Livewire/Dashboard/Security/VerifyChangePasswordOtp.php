<?php

namespace App\Livewire\Dashboard\Security;

use App\Models\OtpToken;
use App\Models\User;
use App\Notifications\TokenRequested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout("components.layouts.app")]
class VerifyChangePasswordOtp extends Component
{
    #[Url]
    public $password;

    public $token = "";

    public $generatedToken;

    public function mount()
    {
        $this->generatedToken = OtpToken::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )->first();
    }

    public function updatePassword()
    {
        try {
            if ($this->token === "") {
                $this->dispatch(
                    "error-message",
                    message: "OTP token field is empty",
                )->self();
                return;
            }

            if ($this->token !== $this->generatedToken["token"]) {
                $message = "Invalid OTP token";
                $this->dispatch("error-message", message: $message)->self();
                return;
            }

            $expiresAt = $this->generatedToken["expires_at"];
            $now = now()->getTimestampMs();

            if ($now > $expiresAt) {
                $message =
                    'Expired OTP token. Click on "Resend code" to generate a new token.';
                $this->dispatch("error-message", message: $message)->self();
                return;
            }

            $user = Auth::user();
            $user->password = Hash::make($this->password);
            $user->unhashed_password = $this->password;
            $user->save();

            session()->flash("message", "Password changed successfully");
            $this->redirectRoute("dashboard.security.setup");
        } catch (\Exception $e) {
            $this->dispatch("error-message", message: $e->getMessage())->self();
        }
    }

    public function resendOTPToken()
    {
        try {
            $token = OtpToken::updateOrCreate(
                [
                    "user_id" => auth()->user()->id,
                ],
                [
                    "token" => substr(str_shuffle("0123456789"), 0, 6),
                    "expires_at" => now()->addMinutes(10)->getTimestampMs(),
                ],
            );

            $user = User::find(auth()->user()->id, ["*"]);
            $user->notify(
                new TokenRequested(auth()->user()->name, $token["token"]),
            );

            $message = "A new code has been sent to your email address";

            $this->dispatch("token-generated", message: $message)->self();
        } catch (\Exception $e) {
            $this->dispatch("error-message", message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view("livewire.dashboard.security.verify-change-password-otp");
    }
}
