<?php

namespace App\Livewire\Dashboard;

use App\Models\MembershipLevel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Account extends Component
{
    public function render()
    {
        $user = auth()->user();

        $todaysCommission = ((int) ($user->daily_commission ?? 0)) / 100;

        return view('livewire.dashboard.account', [
            'membershipLevels' => MembershipLevel::all(),
            'userLevel' => $user->membership_level,
            'user' => $user,
            'todaysCommission' => $todaysCommission,
            'creditScore' => $user->credit_score,
        ]);
    }
}
