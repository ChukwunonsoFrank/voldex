<?php

namespace App\Livewire\Dashboard;

use App\Models\Event as EventModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Event extends Component
{
    public function render()
    {
        $events = EventModel::latest()->get();

        return view('livewire.dashboard.event', [
            'events' => $events,
        ]);
    }
}
