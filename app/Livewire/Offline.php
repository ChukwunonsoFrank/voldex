<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.offline")]
class Offline extends Component
{
    public function render()
    {
        return view("livewire.offline");
    }
}
