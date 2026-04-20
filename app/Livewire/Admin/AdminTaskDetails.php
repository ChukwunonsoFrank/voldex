<?php

namespace App\Livewire\Admin;

use App\Models\MembershipLevel;
use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class AdminTaskDetails extends Component
{
    use WithFileUploads;

    #[Url]
    public $id;

    public string $title = '';

    public string $cost = '';

    public string $task_level = '';

    public string $previousImagePath = '';

    public $image;

    public function mount(): void
    {
        $task = Task::where('id', '=', $this->id, 'and')->first();

        if ($task) {
            $this->title = $task->title;
            $this->cost = (string) $task->cost;
            $this->task_level = $task->task_level;
            $this->previousImagePath = $task->task_image_path;
        }
    }

    public function updateTask(int $taskId): void
    {
        try {
            $this->validate([
                'title' => 'required|string|max:255',
                'cost' => 'required|numeric|min:0',
                'task_level' => 'required|string',
                'image' => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
            ]);

            Task::where('id', '=', $taskId, 'and')->update([
                'title' => $this->title,
                'cost' => $this->cost,
                'task_level' => $this->task_level,
                'task_image_path' => $this->image
                    ? 'task-image/'.$this->image->getClientOriginalName()
                    : $this->previousImagePath,
            ]);

            if ($this->image) {
                $this->image->storeAs(
                    path: 'task-image',
                    name: $this->image->getClientOriginalName(),
                    options: 'public',
                );

                $this->previousImagePath = 'task-image/'.$this->image->getClientOriginalName();
            }

            $this->reset('image');

            session()->flash(
                'success-message',
                'Task updated successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $membershipLevels = MembershipLevel::all();

        return view('livewire.admin.admin-task-details', [
            'membershipLevels' => $membershipLevels,
        ]);
    }
}
