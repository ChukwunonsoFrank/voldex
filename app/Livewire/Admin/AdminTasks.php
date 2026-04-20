<?php

namespace App\Livewire\Admin;

use App\Models\MembershipLevel;
use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AdminTasks extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $title = '';

    public string $cost = '';

    public string $task_level = '';

    public $image;

    public function createNewTask(): void
    {
        try {
            $this->validate([
                'title' => 'required|string|max:255',
                'cost' => 'required|numeric|min:0',
                'task_level' => 'required|string',
                'image' => 'required|image|mimes:png,jpeg,jpg|max:2048',
            ]);

            Task::create([
                'title' => $this->title,
                'cost' => $this->cost,
                'task_level' => $this->task_level,
                'task_image_path' => 'task-image/'.$this->image->getClientOriginalName(),
            ]);

            $this->image->storeAs(
                'task-image',
                $this->image->getClientOriginalName(),
                'public',
            );

            $this->reset('title', 'cost', 'task_level', 'image');

            session()->flash(
                'success-message',
                'Task created successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function destroyTask(int $taskId): void
    {
        try {
            Task::destroy($taskId);
            session()->flash(
                'success-message',
                'Task deleted successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $tasks = Task::latest()->paginate(10);
        $membershipLevels = MembershipLevel::all();

        return view('livewire.admin.admin-tasks', [
            'tasks' => $tasks,
            'membershipLevels' => $membershipLevels,
        ]);
    }
}
