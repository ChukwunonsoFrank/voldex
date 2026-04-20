<?php

namespace App\Livewire\Dashboard\Security;

use App\Models\OtpToken;
use App\Models\User;
use App\Notifications\TokenRequested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public string $current_password = "";

    public string $password = "";

    public string $password_confirmation = "";

    /**
     * Update the password for the currently authenticated user.
     */
    public function generateOTP(): void
    {
        try {
            if ($this->current_password === "") {
                $this->dispatch(
                    "error-message",
                    message: "Current password is required",
                )->self();
                return;
            }

            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $this->dispatch(
                    "error-message",
                    message: "Current password is invalid",
                )->self();
                return;
            }

            if ($this->password === "") {
                $this->dispatch(
                    "error-message",
                    message: "New password is required",
                )->self();
                return;
            }

            if ($this->password_confirmation === "") {
                $this->dispatch(
                    "error-message",
                    message: "Confirm password is required",
                )->self();
                return;
            }

            if ($this->password_confirmation !== $this->password) {
                $this->dispatch(
                    "error-message",
                    message: "New and confirm password fields do not match",
                )->self();
                return;
            }

            $queryParams = http_build_query([
                "password" => $this->password,
            ]);

            if (auth()->user()->two_factor_enabled) {
                $this->redirect(
                    "/dashboard/security/changepassword/verifytwofa?$queryParams",
                );
            } else {
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

                $this->redirect(
                    "/dashboard/security/changepassword/verifyotp?$queryParams",
                );
            }
        } catch (\Exception $e) {
            $this->dispatch("error-message", message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view("livewire.dashboard.security.change-password");
    }
}
