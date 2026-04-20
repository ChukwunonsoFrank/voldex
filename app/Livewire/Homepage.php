<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]

#[Title('Home')]

class Homepage extends Component
{
    public function render()
    {
        return view('livewire.homepage');
    }
}
