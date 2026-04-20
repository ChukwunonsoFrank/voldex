<?php

namespace App\Livewire\Dashboard;

use App\Models\MembershipLevel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index', [
            'membershipLevels' => MembershipLevel::all(),
            'userLevel' => auth()->user()->membership_level,
        ]);
    }
}
