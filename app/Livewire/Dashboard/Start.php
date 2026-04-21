<?php

namespace App\Livewire\Dashboard;

use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Models\Task;
use App\Models\Withdrawal;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Start extends Component
{
  public function mount(): void
  {
    if (session('task_completed')) {
      $this->dispatch('task-completed', message: session('task_completed'))->self();
    }
  }

  public function startTask(): void
  {
    $user = auth()->user();

    $membershipLevel = MembershipLevel::query()
      ->where('name', $user->membership_level)
      ->first();

    if ($membershipLevel && $membershipLevel->minimum_balance !== null && ($user->balance / 100 ?? 0) < (int) $membershipLevel->minimum_balance) {
      $this->dispatch('minimum-balance-required', message: 'The minimum balance for this level is ' .  $membershipLevel->minimum_balance . ' USDT')->self();

      return;
    }

    if ($user->tasks_completed >= $user->task_pole && $user->lien_status === 'on_hold' && $user->lien_amount !== null) {
      $this->dispatch('task-limit-reached', message: 'You need to make an extra deposit to proceed with completion of tasks. Please contact customer support for further assistance')->self();

      return;
    }

    if ($user->tasks_completed >= $user->task_pole) {
      $this->dispatch('task-limit-reached', message: 'Task limit reached. Come back tommorrow for more tasks.')->self();

      return;
    }

    $hasPendingTask = CompletedTask::query()
      ->where('user_id', $user->id)
      ->where('status', 'pending')
      ->exists();

    if ($hasPendingTask) {
      session()->flash('pending_task_warning', 'You have one or more tasks pending completion. Complete it to continue.');

      $this->redirect(route('dashboard.record'));

      return;
    }

    $task = Task::query()
      ->where('task_level', $user->membership_level)
      ->inRandomOrder()
      ->first();

    if (! $task) {
      $this->dispatch('task-limit-reached', message: 'No tasks available for your membership level at this time.')->self();

      return;
    }

    $taskCostInCents = (int) round((float) $task->cost * 100);

    if (($user->balance ?? 0) < $taskCostInCents) {
      $this->dispatch('insufficient-balance', message: 'Insufficient balance to complete task. Top up to continue.')->self();

      return;
    }

    $completedTask = CompletedTask::create([
      'user_id' => $user->id,
      'title' => $task->title,
      'cost' => $task->cost,
      'task_image_path' => $task->task_image_path,
      'rating' => '',
      'rating_id' => '',
      'status' => 'pending',
    ]);

    session(['pending_task_id' => $completedTask->id]);

    $this->redirect(route('dashboard.optimize'));
  }

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
      ->sum(fn(CompletedTask $task) => (float) $task->cost * $percentage);

    $pendingWithdrawalsTotal = Withdrawal::where('user_id', $user->id)
      ->where('status', 'pending')
      ->sum('amount');

    return view('livewire.dashboard.start', [
      'membershipLevels' => MembershipLevel::all(),
      'userLevel' => $user->membership_level,
      'user' => $user,
      'todaysCommission' => $todaysCommission,
      'pendingWithdrawalsTotal' => $pendingWithdrawalsTotal,
    ]);
  }
}
