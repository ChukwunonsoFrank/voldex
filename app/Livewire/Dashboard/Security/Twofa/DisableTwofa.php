<?php

namespace App\Livewire\Dashboard\Security\Twofa;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

class DisableTwofa extends Component
{
    public $code;

    public function enable2fa()
    {
        try {
            $google2fa = new Google2FA();
            $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $this->code);
            if ($valid) {
                $user = Auth::user();
                $user->google2fa_secret = null;
                $user->two_factor_enabled = false;
                $user->save();
                session()->flash('message', '2FA disabled successfully');
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
        return view('livewire.dashboard.security.twofa.disable-twofa');
    }
}
