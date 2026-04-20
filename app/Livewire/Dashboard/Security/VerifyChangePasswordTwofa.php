<?php

namespace App\Livewire\Dashboard\Security;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Url;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

class VerifyChangePasswordTwofa extends Component
{
    #[Url]
    public $password;

    public $code;

    public function verify2fa()
    {
        try {
            $google2fa = new Google2FA();
            $valid = $google2fa->verifyKey(
                auth()->user()->google2fa_secret,
                $this->code,
            );
            if ($valid) {
                Auth::user()->password = Hash::make($this->password);
                Auth::user()->unhashed_password = $this->password;
                Auth::user()->save();

                session()->flash("message", "Password changed successfully");
                $this->redirectRoute("dashboard.security.setup");
            } else {
                $this->reset("code");
                $this->dispatch(
                    "error-message",
                    message: "Invalid code",
                )->self();
            }
        } catch (\Exception $e) {
            $this->dispatch("error-message", message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view("livewire.dashboard.security.verify-change-password-twofa");
    }
}
