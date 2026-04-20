<?php

namespace App\Livewire\Admin;

use App\Models\Bot;
use App\Models\Deposit;
use App\Models\Strategy;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public int $totalDepositSum = 0;

    public int $totalWithdrawalSum = 0;

    public $strategies;

    public function mount()
    {
        // $this->totalDepositSum = Deposit::where(
        //     'status',
        //     '=',
        //     'confirmed',
        //     'and',
        // )->sum('amount');
        // $this->totalWithdrawalSum = Withdrawal::where(
        //     'status',
        //     '=',
        //     'completed',
        //     'and',
        // )->sum('amount');
        // $this->strategies = Strategy::all();
    }

    public function getStatusIndicatorColor(string $status)
    {
        if ($status === 'active') {
            return 'bg-success-50 text-success-600';
        }

        if ($status === 'closed') {
            return 'bg-error-50 text-error-600';
        }

        if ($status === 'expired') {
            return 'bg-error-50 text-error-600';
        }
    }

    // public function getStrategyName(int $strategyId)
    // {
    //     $filtered = $this->strategies->filter(
    //         fn (Strategy $value) => $value['id'] === intval($strategyId),
    //     );

    //     return $filtered->first()['name'];
    // }

    public function convertTimestampToDateTime(string $timestamp): string
    {
        return toBali(Carbon::createFromTimestampMs($timestamp))->format('Y-m-d H:i:s');
    }

    public function normalizeAmount(int $amount): int|float
    {
        return $amount / 100;
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    public function calculateFees(int $profit): int
    {
        $fee = intval(round(($profit * 5) / 100));

        return $fee;
    }

    // public function stopRobot(int $botId)
    // {
    //     try {
    //         DB::transaction(function () use ($botId) {
    //             // Lock the bot record first to prevent concurrent stops
    //             $bot = Bot::where('id', '=', $botId, 'and')
    //                 ->lockForUpdate()
    //                 ->first();

    //             if (! $bot) {
    //                 throw new \Exception('Bot not found');
    //             }

    //             // Check if already stopped/closed
    //             if ($bot->status === 'closed') {
    //                 throw new \Exception('Bot already stopped');
    //             }

    //             // Only allow stopping active bots
    //             if ($bot->status !== 'active') {
    //                 throw new \Exception('Only active bots can be stopped');
    //             }

    //             $userId = $bot->user_id;
    //             $accountType = $bot->account_type;
    //             $amount = $bot->amount;
    //             $profit = $bot->profit;
    //             $fee = $this->calculateFees($profit);
    //             $netProfit = $profit - $fee;

    //             // Lock the user record for balance update
    //             $user = User::where('id', '=', $userId, 'and')
    //                 ->lockForUpdate()
    //                 ->first();

    //             if (! $user) {
    //                 throw new \Exception('User not found');
    //             }

    //             if ($accountType === 'demo') {
    //                 $currentBalance = $user->demo_balance;
    //                 $newBalance = $currentBalance + $amount + $netProfit;

    //                 // Update user balance
    //                 $user->demo_balance = $newBalance;
    //                 $user->save();
    //             } elseif ($accountType === 'live') {
    //                 $currentBalance = $user->live_balance;
    //                 $newBalance = $currentBalance + $amount + $netProfit;

    //                 // Update user balance
    //                 $user->live_balance = $newBalance;
    //                 $user->save();
    //             } else {
    //                 throw new \Exception('Invalid account type');
    //             }

    //             // Update bot status
    //             $bot->status = 'closed';
    //             $bot->save();
    //         });

    //         session()->flash('success-message', 'Robot stopped successfully.');
    //     } catch (\Exception $e) {
    //         session()->flash('error-message', $e->getMessage());
    //     }
    // }

    public function render()
    {
        // $activeBots = Bot::with('user')
        //     ->where('status', 'active')
        //     ->paginate(10);

        return view('livewire.admin.dashboard');
    }
}
