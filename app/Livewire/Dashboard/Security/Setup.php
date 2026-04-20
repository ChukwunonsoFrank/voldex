<?php

namespace App\Livewire\Dashboard\Security;

use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;

class Setup extends Component
{
    public bool $is2faEnabled;

    public function mount()
    {
        if (session()->has('message')) {
            $message = session()->get('message');
            $this->dispatch('message', message: $message)->self();
        }

        $this->is2faEnabled = auth()->user()->two_factor_enabled;
    }

    public function generateSecretKey()
    {
        try {
            $user = Auth::user();
            $google2fa = new Google2FA();
            $user->google2fa_secret = $google2fa->generateSecretKey(16);
            $user->save();
            $this->redirectRoute('dashboard.security.2fa.secret');
        } catch (\Exception $e) {
            $this->dispatch('error', message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.security.setup');
    }
}
