<?php

namespace App\Livewire\Dashboard;

use App\Models\Alert as AlertModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Alert extends Component
{
    public function render()
    {
        $alerts = AlertModel::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('livewire.dashboard.alert', [
            'alerts' => $alerts,
        ]);
    }
}
