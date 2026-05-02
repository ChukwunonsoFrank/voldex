<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\WithdrawalApproved;
use App\Notifications\WithdrawalDeclined;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AdminWithdrawals extends Component
{
    use WithPagination;

    public function getStatusIndicatorColor(string $status)
    {
        if ($status === 'pending') {
            return 'bg-warning-50 text-warning-600';
        }

        if ($status === 'approved') {
            return 'bg-success-50 text-success-600';
        }

        if ($status === 'declined') {
            return 'bg-error-50 text-error-600';
        }
    }

    public function approveWithdrawal(
        int $withdrawalId,
        int $userId,
        int $amount,
    ) {
        try {
            Withdrawal::where('id', '=', $withdrawalId, 'and')->update([
                'status' => 'completed',
            ]);

            DB::transaction(function () use ($withdrawalId, $userId, $amount) {
                // Lock the withdrawal record first to prevent concurrent approvals
                $withdrawal = Withdrawal::where('id', '=', $withdrawalId, 'and')
                    ->lockForUpdate()
                    ->first();

                if (! $withdrawal) {
                    throw new \Exception('Withdrawal not found');
                }

                // Check if already processed (declined or approved)
                if ($withdrawal->status === 'approved') {
                    throw new \Exception('Withdrawal already approved');
                }

                // Verify the withdrawal belongs to this user (security check)
                if ($withdrawal->user_id != $userId) {
                    throw new \Exception(
                        'Withdrawal does not belong to this user',
                    );
                }

                // Lock user and update balance atomically
                $user = User::where('id', '=', $userId, 'and')
                    ->lockForUpdate()
                    ->first();

                if (! $user) {
                    throw new \Exception('User not found');
                }

                $userBalance = $user->balance;
                $newBalance = $userBalance - $amount;

                // Update user balance
                $user->balance = $newBalance;
                $user->processing_amount = max(0, (int) $user->processing_amount - $amount);
                $user->save();

                // Update withdrawal status
                $withdrawal->status = 'approved';
                $withdrawal->save();

                // Send notification (inside transaction)
                $user->notify(
                  new WithdrawalApproved($user->username, strval($amount / 100)),
                );
            });
            session()->flash(
                'success-message',
                'Withdrawal approved successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function declineWithdrawal(
        int $withdrawalId,
        int $userId,
        int $amount,
    ) {
        try {
            DB::transaction(function () use ($withdrawalId, $userId, $amount) {
                // Lock the withdrawal record first to prevent concurrent declines
                $withdrawal = Withdrawal::where('id', '=', $withdrawalId, 'and')
                    ->lockForUpdate()
                    ->first();

                if (! $withdrawal) {
                    throw new \Exception('Withdrawal not found');
                }

                // Check if already processed (declined)
                if ($withdrawal->status === 'declined') {
                    throw new \Exception('Withdrawal already declined');
                }

                // Verify the withdrawal belongs to this user (security check)
                if ($withdrawal->user_id != $userId) {
                    throw new \Exception(
                        'Withdrawal does not belong to this user',
                    );
                }

                // Verify amount matches (prevents parameter tampering)
                if ($withdrawal->amount != $amount) {
                    throw new \Exception('Amount mismatch');
                }

                // Lock user and update balance atomically
                $user = User::where('id', '=', $userId, 'and')
                    ->lockForUpdate()
                    ->first();

                if (! $user) {
                    throw new \Exception('User not found');
                }

                $user->processing_amount = max(0, (int) $user->processing_amount - $amount);
                $user->save();

                // Update withdrawal status
                $withdrawal->status = 'declined';
                $withdrawal->save();

                // Send notification (inside transaction)
                $user->notify(
                  new WithdrawalDeclined($user->username, strval($amount / 100)),
                );
            });

            session()->flash(
                'success-message',
                'Withdrawal declined successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $withdrawals = Withdrawal::with('user')
            ->whereHas('user', function ($query) {
                $query->where('is_admin', 0);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.admin-withdrawals', [
            'withdrawals' => $withdrawals,
        ]);
    }
}
