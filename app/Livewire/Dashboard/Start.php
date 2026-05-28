<?php

namespace App\Livewire\Dashboard;

use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Models\Task;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Start extends Component
{
    private function usesTrainingBalance(User $user): bool
    {
        return $user->task_batch === 0
            && ! $user->has_made_first_deposit
            && $user->training_balance > 0;
    }

    private function getActiveTaskBalanceInCents(User $user): int
    {
        if ($this->usesTrainingBalance($user)) {
            return (int) $user->training_balance;
        }

        return (int) $user->balance;
    }

    public function mount(): void
    {
        if (session('task_completed')) {
            $this->dispatch('task-completed', message: session('task_completed'))->self();
        }
    }

    public function startTask(): void
    {
        $user = auth()->user();
        $activeTaskBalanceInCents = $this->getActiveTaskBalanceInCents($user);

        if ($user->task_batch >= 3) {
            $this->dispatch('task-limit-reached', message: 'Task limit reached. Come back tommorrow for more tasks.')->self();

            return;
        }

        if ($user->task_batch >= 1 && ! $user->has_made_first_deposit) {
            $this->dispatch('task-limit-reached', message: 'You need to make your first deposit of $100 to continue with tasks.')->self();

            return;
        }

        $membershipLevel = MembershipLevel::query()
            ->where('name', $user->membership_level)
            ->first();

        if (
            $membershipLevel
            && $membershipLevel->minimum_balance !== null
        ) {
            $minimumBalanceValue = str_replace(',', '', (string) $membershipLevel->minimum_balance);
            $minimumBalanceInCents = str_contains($minimumBalanceValue, '.')
                ? (int) round(((float) $minimumBalanceValue) * 100)
                : (int) $minimumBalanceValue;

            if ($activeTaskBalanceInCents < $minimumBalanceInCents) {
                $this->dispatch(
                    'minimum-balance-required',
                    message: 'The minimum balance for this level is '.number_format($minimumBalanceInCents / 100, 2).' USDT',
                )->self();

                return;
            }
        }

        if ($user->tasks_completed >= $user->task_pole && $user->lien_status === 'on_hold' && $user->lien_amount !== null) {
            $this->dispatch('task-limit-reached', message: 'You need to make an extra deposit to proceed with completion of tasks.')->self();

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

        if ($activeTaskBalanceInCents < $taskCostInCents) {
            $this->dispatch('insufficient-balance', message: 'Insufficient balance to complete task. Top up to continue.')->self();

            return;
        }

        $completedTask = CompletedTask::create([
            'user_id' => $user->id,
            'title' => $task->title,
            'cost' => $task->cost,
            'task_image_path' => $task->task_image_path,
            'rating' => '0',
            'rating_id' => substr(bin2hex(random_bytes(7)), 0, 14),
            'status' => 'pending',
        ]);

        session(['pending_task_id' => $completedTask->id]);

        $this->redirect(route('dashboard.optimize'));
    }

    public function render()
    {
        $user = auth()->user();

        $todaysCommission = ((int) ($user->daily_commission ?? 0)) / 100;

        return view('livewire.dashboard.start', [
            'membershipLevels' => MembershipLevel::all(),
            'userLevel' => $user->membership_level,
            'user' => $user,
            'todaysCommission' => $todaysCommission,
        ]);
    }
}
