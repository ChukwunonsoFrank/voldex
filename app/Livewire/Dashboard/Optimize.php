<?php

namespace App\Livewire\Dashboard;

use App\Models\CompletedTask;
use App\Models\MembershipLevel;
use App\Notifications\TaskThresholdReached;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Optimize extends Component
{
    public int $rating = 0;

    public function setRating(int $rating): void
    {
        $this->rating = ($rating === $this->rating) ? 0 : $rating;
    }

    public function submitTask(): void
    {
        $taskId = session('pending_task_id');

        $task = CompletedTask::query()
            ->where('id', $taskId)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $task->update(['status' => 'approved', 'rating' => $this->rating]);

        $user = auth()->user();
        $user->increment('tasks_completed');

        if ($user->fresh()->tasks_completed === 10) {
            Notification::route('mail', 'voldexcustomersservice@gmail.com')
                ->notify(new TaskThresholdReached($user->username));
        }

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
        $taskId = session('pending_task_id');

        $task = CompletedTask::query()
            ->where('id', $taskId)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if (! $task) {
            $this->redirect(route('dashboard.start'));

            return view('livewire.dashboard.optimize', ['task' => null]);
        }

        $user = auth()->user();
        $membershipLevel = MembershipLevel::query()
            ->where('name', $user->membership_level)
            ->first();

        $commission = $membershipLevel
            ? (float) $task->cost * ($membershipLevel->percentage / 100)
            : 0;

        return view('livewire.dashboard.optimize', [
            'task' => $task,
            'commission' => $commission,
        ]);
    }
}
