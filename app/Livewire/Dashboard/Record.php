<?php

namespace App\Livewire\Dashboard;

use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Record extends Component
{
    use WithPagination;

    public function mount(): void
    {
        if (session('pending_task_warning')) {
            $this->dispatch('pending-task', message: session('pending_task_warning'))->self();
        }
    }

    public function submitTask(int $taskId): void
    {
        $user = auth()->user();

        $task = CompletedTask::query()
            ->where('id', $taskId)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $task->update(['status' => 'approved']);

        $user->increment('tasks_completed');

        $membershipLevel = MembershipLevel::query()
            ->where('name', $user->membership_level)
            ->first();

        if ($membershipLevel) {
            $commission = (float) $task->cost * ($membershipLevel->percentage / 100);
            $commissionInCents = (int) round($commission * 100);
            $user->increment('total_commission', $commissionInCents);
            $user->increment('balance', $commissionInCents);
        }

        session()->forget('pending_task_id');
        session()->flash('task_completed', 'Task completed successfully');

        $this->redirect(route('dashboard.start'));
    }

    public function render()
    {
        $user = auth()->user();

        $membershipLevel = MembershipLevel::query()
            ->where('name', $user->membership_level)
            ->first();

        $commissionPercentage = $membershipLevel?->percentage ?? 0;

        return view('livewire.dashboard.record', [
            'completedTasks' => CompletedTask::query()
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10),
            'commissionPercentage' => $commissionPercentage,
        ]);
    }
}
