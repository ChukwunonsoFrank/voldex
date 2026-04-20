<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AdminEvents extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $image;

    public function createNewEvent(): void
    {
        try {
            Event::create([
                'poster_image_path' => 'event-image/'.$this->image->getClientOriginalName(),
            ]);

            $this->image->storeAs(
                'event-image',
                $this->image->getClientOriginalName(),
                'public',
            );

            $this->reset('image');

            session()->flash(
                'success-message',
                'Event created successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function destroyEvent(int $eventId): void
    {
        try {
            Event::destroy($eventId);
            session()->flash(
                'success-message',
                'Event deleted successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $events = Event::latest()->paginate(10);

        return view('livewire.admin.admin-events', [
            'events' => $events,
        ]);
    }
}
