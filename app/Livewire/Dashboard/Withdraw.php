<?php

namespace App\Livewire\Dashboard;

use App\Models\Withdrawal;
use App\Notifications\TransactionOccured;
use App\Notifications\WithdrawalInitiated;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Withdraw extends Component
{
    public $amount;

    public function mount(): void
    {
        if (! session('withdrawal_password_verified')) {
            $this->redirect(route('dashboard.withdraw-password-step'));
        }
    }

    public function submitWithdrawal(): void
    {
        $user = auth()->user();

        if ($this->amount <= 0) {
            $this->dispatch('change-error', message: 'Invalid withdrawal amount');

            return;
        }

        if (! $user->withdrawal_address || ! $user->withdrawal_address_type) {
            $this->dispatch('change-error', message: 'You need to bind a wallet address to your account to process withdrawals');

            return;
        }

        $amountInCents = (int) round($this->amount * 100);

        if ($user->balance < $amountInCents) {
            $this->dispatch('change-error', message: 'Insufficient balance');

            return;
        }

        $hasPending = Withdrawal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasPending) {
            $this->dispatch('change-error', message: 'You have 1 or more processing transactions. Please wait until processing is complete');

            return;
        }

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $amountInCents,
            'payment_method' => $user->withdrawal_address_type,
            'address' => $user->withdrawal_address,
            'status' => 'pending',
        ]);

        $user->increment('processing_amount', $amountInCents);

        $user->notify(
          new WithdrawalInitiated(
            $user->username,
            strval($amountInCents / 100),
          ),
        );

        Notification::route("mail", "voldexcustomersservice@gmail.com")->notify(
          new TransactionOccured(
            "withdrawal",
            $user->username,
            strval($amountInCents / 100),
          ),
        );

        $this->reset('amount');
        $this->dispatch('change-success', message: 'Withdrawal initiated successfully');
    }

    public function render()
    {
        return view('livewire.dashboard.withdraw');
    }
}
