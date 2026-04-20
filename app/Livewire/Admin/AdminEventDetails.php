<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class AdminEventDetails extends Component
{
    use WithFileUploads;

    #[Url]
    public $id;

    public string $previousImagePath = '';

    public $image;

    public function updateEvent(int $eventId): void
    {
        try {
            Event::where('id', '=', $eventId, 'and')->update([
                'poster_image_path' => $this->image
                    ? 'event-image/'.$this->image->getClientOriginalName()
                    : $this->previousImagePath,
            ]);

            if ($this->image) {
                $this->image->storeAs(
                    path: 'event-image',
                    name: $this->image->getClientOriginalName(),
                );
            }

            $this->reset('image');

            session()->flash(
                'success-message',
                'Event updated successfully',
            );
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $event = Event::where('id', '=', $this->id, 'and')->first();

        $this->previousImagePath = $event['poster_image_path'];

        return view('livewire.admin.admin-event-details');
    }
}
