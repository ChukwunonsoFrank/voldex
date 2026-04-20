<?php

namespace App\Livewire\Dashboard;

use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Models\Withdrawal;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Account extends Component
{
    public function render()
    {
        $user = auth()->user();

        $membershipLevel = MembershipLevel::query()
            ->where('name', $user->membership_level)
            ->first();

        $percentage = $membershipLevel ? $membershipLevel->percentage / 100 : 0;

        $todaysCommission = CompletedTask::query()
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->whereDate('updated_at', today())
            ->get()
            ->sum(fn (CompletedTask $task) => (float) $task->cost * $percentage);

        $pendingWithdrawalsTotal = Withdrawal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        return view('livewire.dashboard.account', [
            'membershipLevels' => MembershipLevel::all(),
            'userLevel' => $user->membership_level,
            'user' => $user,
            'todaysCommission' => $todaysCommission,
            'creditScore' => $user->credit_score,
            'pendingWithdrawalsTotal' => $pendingWithdrawalsTotal,
        ]);
    }
}
