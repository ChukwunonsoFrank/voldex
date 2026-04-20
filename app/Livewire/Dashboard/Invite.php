<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Invite extends Component
{
    public function render()
    {
        $user = auth()->user();

        return view('livewire.dashboard.invite', [
            'user' => $user,
        ]);
    }
}
