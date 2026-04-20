<?php

namespace App\Livewire\Dashboard\Security\Twofa;

use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;

class VerifyTwofa extends Component
{
    public $code;

    public function enable2fa()
    {
        try {
            $google2fa = new Google2FA();
            $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $this->code);
            if ($valid) {
                $user = Auth::user();
                $user->two_factor_enabled = true;
                $user->save();
                session()->flash('message', '2FA enabled successfully');
                $this->redirectRoute('dashboard.security.setup');
            } else {
                $this->reset('code');
                $this->dispatch('error', message: 'Invalid code')->self();
            }
        } catch (\Exception $e) {
            $this->dispatch('error', message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.security.twofa.verify-twofa');
    }
}
