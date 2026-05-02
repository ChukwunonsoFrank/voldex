<?php

namespace App\Livewire\Admin;

use App\Models\MembershipLevel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class AdminMembershipLevelDetails extends Component
{
    #[Url]
    public $id;

    public string $name = '';

    public string $percentage = '';

    public string $minimum_balance = '';

    public function mount(): void
    {
        $membershipLevel = MembershipLevel::where('id', '=', $this->id, 'and')->first();

        if ($membershipLevel) {
            $this->name = $membershipLevel->name;
            $this->percentage = (string) $membershipLevel->percentage;
            $this->minimum_balance = (string) $membershipLevel->minimum_balance;
        }
    }

    public function updateMembershipLevel(int $membershipLevelId): void
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'percentage' => 'required|numeric|min:0',
                'minimum_balance' => 'required|numeric|min:0',
            ]);

            MembershipLevel::where('id', '=', $membershipLevelId, 'and')->update([
                'name' => $this->name,
                'percentage' => $this->percentage,
                'minimum_balance' => $this->minimum_balance,
            ]);

            session()->flash(
                'success-message',
                'Membership level updated successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-membership-level-details');
    }
}
