<?php

namespace App\Livewire\Dashboard\Security\Twofa;

use Livewire\Attributes\Layout;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

#[Layout('components.layouts.app')]

class Secret extends Component
{
    public $google2faSecret;

    public $qrCodeUrl;

    public function mount()
    {
        $this->google2faSecret = auth()->user()->google2fa_secret;
        $google2fa = new Google2FA();
        $this->qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            auth()->user()->email,
            $this->google2faSecret
        );
    }

    public function render()
    {
        return view('livewire.dashboard.security.twofa.secret');
    }
}
