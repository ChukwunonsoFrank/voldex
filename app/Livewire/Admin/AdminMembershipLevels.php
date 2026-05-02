<?php

namespace App\Livewire\Admin;

use App\Models\MembershipLevel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AdminMembershipLevels extends Component
{
    use WithPagination;

    public function render()
    {
        $membershipLevels = MembershipLevel::latest()->paginate(10);

        return view('livewire.admin.admin-membership-levels', [
            'membershipLevels' => $membershipLevels,
        ]);
    }
}
