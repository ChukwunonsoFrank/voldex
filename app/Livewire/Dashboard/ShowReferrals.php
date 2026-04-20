<?php

namespace App\Livewire\Dashboard;

use App\Models\Referral;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.app")]
class ShowReferrals extends Component
{
    // public $perPage = 10;

    // public $visibleCount;

    // public $totalReferrals;

    public $totalCommissions;

    public function mount()
    {
        // $this->totalReferrals = Referral::where('user_id', auth()->user()->id)->count();
        // $this->visibleCount = min($this->perPage, $this->totalReferrals);
        $this->totalCommissions = Referral::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )->sum("amount");
        $this->totalCommissions /= 100;
    }

    // public function loadMore(): void
    // {
    //     $this->visibleCount = min($this->visibleCount + $this->perPage, $this->totalReferrals);
    // }

    // public function getLevelPercentage(string $level)
    // {
    //     if ($level === '1') {
    //         return '5%';
    //     }

    //     if ($level === '2') {
    //         return '2%';
    //     }

    //     if ($level === '3') {
    //         return '1%';
    //     }
    // }

    public function render()
    {
        $level1Downlines = [];
        $level2Downlines = [];

        $level1Referrals = User::where(
            "referred_by",
            "=",
            auth()->user()->referral_code,
            "and",
        )
            ->latest()
            ->get();

        $level1Referrals->each(function ($user) use (
            &$level1Downlines,
            &$level2Downlines,
        ) {
            $level1Downlines[] = $user->name;

            $level2Referrals = User::where(
                "referred_by",
                "=",
                $user->referral_code,
                "and",
            )
                ->latest()
                ->get();

            foreach ($level2Referrals as $level2User) {
                $level2Downlines[] = $level2User->name;
            }
        });

        return view("livewire.dashboard.show-referrals", [
            "level1Downlines" => $level1Downlines,
            "level2Downlines" => $level2Downlines,
        ]);
    }
}
