<?php

namespace App\Livewire\Admin;

use App\Models\Alert;
use App\Models\MembershipLevel;
use App\Models\User;
use App\Models\Withdrawal;
// use App\Notifications\BroadcastSent;
// use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class UsersDetails extends Component
{
  use WithPagination;

  protected $queryString = ['id'];

  #[Url]
  public $id;

  public $balance;

  public $email;

  public $membershipLevel;

  public $tasksCompleted;

  public $dailyCommission;

  public $totalCommission;

  public $processingAmount;

  public $taskPole;

  public $newTaskPole;

  public $taskPoleAmount;

  public $bonusAmount;

  public $title;

  public $message;

  public $selectedMembershipLevel;

  public $newCreditScore;

  public function getStatusIndicatorColor(string $status)
  {
    if (
      $status === 'approved'
    ) {
      return 'bg-success-50 text-success-600';
    }

    if ($status === 'pending') {
      return 'bg-warning-50 text-warning-600';
    }

    if (
      $status === 'declined'
    ) {
      return 'bg-error-50 text-error-600';
    }

    if ($status === 'unredeemed') {
      return 'bg-error-50 text-error-600';
    }

    if ($status === 'redeemed') {
      return 'bg-success-50 text-success-600';
    }
  }

  public function addBonus()
  {
    try {
      // Validate bonus amount
      if (! isset($this->bonusAmount) || $this->bonusAmount <= 0) {
        throw new \Exception('Invalid amount');
      }

      DB::transaction(function () {
        // Lock the user record
        $user = User::where('id', '=', $this->id, 'and')
          ->lockForUpdate()
          ->first();

        if (! $user) {
          throw new \Exception('User not found');
        }

        $bonusAmountInCents = $this->bonusAmount * 100;

        // Update balance atomically
        $user->balance += $bonusAmountInCents;
        $user->save();
      });

      $this->dispatch('notify', message: 'User credited successfully', type: 'success');

      // Reset form
      $this->reset(['bonusAmount']);
    } catch (\Exception $e) {
      $this->dispatch('notify', message: $e->getMessage(), type: 'error');
    }
  }

  public function removeBonus()
  {
    try {
      // Validate bonus amount
      if (! isset($this->bonusAmount) || $this->bonusAmount <= 0) {
        throw new \Exception('Invalid amount');
      }

      DB::transaction(function () {
        // Lock the user record
        $user = User::where('id', '=', $this->id, 'and')
          ->lockForUpdate()
          ->first();

        if (! $user) {
          throw new \Exception('User not found');
        }

        if ($this->bonusAmount > $user->balance) {
          throw new \Exception(
            'Insufficient balance for debit',
          );
        }

        $bonusAmountInCents = $this->bonusAmount * 100;

        // Update balance atomically
        $user->balance -= $bonusAmountInCents;
        $user->save();
      });

      $this->dispatch('notify', message: 'User debited successfully', type: 'success');

      // Reset form
      $this->reset(['bonusAmount']);
    } catch (\Exception $e) {
      $this->dispatch('notify', message: $e->getMessage(), type: 'error');
    }
  }

  public function sendNotification()
  {
    try {
      Alert::create([
        'user_id' => $this->id,
        'title' => $this->title,
        'body' => $this->message,
        'read_status' => 'unread',
      ]);
      $this->dispatch('notify', message: 'Notification sent successfully', type: 'success');
    } catch (\Exception $e) {
      $this->dispatch('notify', message: $e->getMessage(), type: 'error');
    }
  }

  public function requestDeposit()
  {
    $this->validate([
      'newTaskPole' => ['required'],
      'taskPoleAmount' => ['required', 'numeric', 'min:0.01'],
    ], [
      'newTaskPole.required' => 'The task pole field is required.',
      'taskPoleAmount.required' => 'The amount field is required.',
      'taskPoleAmount.numeric' => 'The amount must be a number.',
      'taskPoleAmount.min' => 'The amount must be at least 0.01.',
    ]);

    try {
      $lienAmount = $this->balance + ($this->taskPoleAmount * 100);
      $lienAmount = strval($lienAmount);
      DB::transaction(function () use ($lienAmount) {
        // Lock the user record
        $user = User::where('id', '=', $this->id, 'and')
          ->lockForUpdate()
          ->first();

        if (! $user) {
          throw new \Exception('User not found');
        }

        $user->task_pole = $this->newTaskPole;
        $user->lien_amount = $lienAmount;
        $user->lien_status = 'on_hold';
        $user->save();
      });
      $this->dispatch('notify', message: 'Task pole set successfully', type: 'success');
    } catch (\Exception $e) {
      $this->dispatch('notify', message: $e->getMessage(), type: 'error');
    }
  }

  public function upgradeMembership(): void
  {
    $this->validate([
      'selectedMembershipLevel' => ['required', 'exists:membership_levels,name'],
    ], [
      'selectedMembershipLevel.required' => 'Please select a membership level.',
      'selectedMembershipLevel.exists' => 'The selected membership level is invalid.',
    ]);

    try {
      DB::transaction(function () {
        $user = User::where('id', '=', $this->id)
          ->lockForUpdate()
          ->first();

        if (! $user) {
          throw new \Exception('User not found');
        }

        $user->membership_level = $this->selectedMembershipLevel;
        $user->save();
      });

      $this->dispatch('notify', message: 'Membership level updated successfully', type: 'success');
      $this->reset(['selectedMembershipLevel']);
    } catch (\Exception $e) {
      $this->dispatch('notify', message: $e->getMessage(), type: 'error');
    }
  }

  public function updateCreditScore(): void
  {
    $this->validate([
      'newCreditScore' => ['required', 'numeric', 'min:0'],
    ], [
      'newCreditScore.required' => 'The credit score field is required.',
      'newCreditScore.numeric' => 'The credit score must be a number.',
      'newCreditScore.min' => 'The credit score must be at least 0.',
    ]);

    try {
      DB::transaction(function () {
        $user = User::where('id', '=', $this->id)
          ->lockForUpdate()
          ->first();

        if (! $user) {
          throw new \Exception('User not found');
        }

        $user->credit_score = $this->newCreditScore;
        $user->save();
      });

      $this->dispatch('notify', message: 'Credit score updated successfully', type: 'success');
      $this->reset(['newCreditScore']);
    } catch (\Exception $e) {
      $this->dispatch('notify', message: $e->getMessage(), type: 'error');
    }
  }

  public function releaseLien(): void
  {
    DB::transaction(function () {
      $user = User::where('id', '=', $this->id)
        ->lockForUpdate()
        ->first();

      if (! $user) {
        throw new \Exception('User not found');
      }

      $user->lien_status = 'off_hold';
      $user->lien_amount = null;
      $user->task_pole = 35;
      $user->save();
    });

    $this->dispatch('notify', message: 'Hold released successfully', type: 'success');
  }

  public function render()
  {
    $user = User::where('id', $this->id)->first();
    $this->balance = $user->balance;
    $this->email = $user->email;
    $this->membershipLevel = $user->membership_level;
    $this->tasksCompleted = $user->tasks_completed;
    $this->totalCommission = $user->total_commission;
    $this->dailyCommission = $user->daily_commission;
    $this->processingAmount = Withdrawal::where('user_id', $user->id)
      ->where('status', 'pending')
      ->sum('amount');
    $this->taskPole = $user->task_pole;

    $withdrawals = Withdrawal::with('user')
      ->where('user_id', $user->id)
      ->latest()
      ->paginate(10, ['*'], 'withrawals_page');

    $membershipLevels = MembershipLevel::all();

    return view('livewire.admin.users-details', [
      'user' => $user,
      'withdrawals' => $withdrawals,
      'membershipLevels' => $membershipLevels,
    ]);
  }
}
