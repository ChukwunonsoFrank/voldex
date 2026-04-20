<?php

namespace App\Livewire\Dashboard;

use App\Models\Kyc;
use Livewire\Component;

class IdentityVerification extends Component
{
    public string $kycStatus = "";

    public bool $isKycPending = false;

    public function mount()
    {
        $this->kycStatus = auth()->user()->is_kyc_verified
            ? "Verified"
            : "Not verified";
        $kycRequest = Kyc::where("user_id", "=", auth()->user()->id, "and")
            ->latest()
            ->first();

        if ($kycRequest && $kycRequest["status"] === "pending") {
            $this->isKycPending = true;
        }
    }

    public function render()
    {
        return view("livewire.dashboard.identity-verification");
    }
}
