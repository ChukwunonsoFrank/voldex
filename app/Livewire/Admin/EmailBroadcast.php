<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Notifications\BroadcastSent;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class EmailBroadcast extends Component
{
    #[Validate('required')]
    public string $subject = '';

    #[Validate('required')]
    public string $message = '';

    #[Validate('required')]
    public string $country = 'all';

    public function sendBroadcast(): void
    {
        try {
            $this->validate();

            User::query()
                ->where('is_admin', false)
                ->when($this->country !== 'all', fn ($query) => $query->where('country', $this->country))
                ->chunk(200, function (Collection $users) {
                    foreach ($users as $user) {
                        $user->notify(new BroadcastSent($user->name, $this->subject, $this->message));
                    }
                });

            session()->flash('success-message', 'Email broadcast sent successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $countries = User::query()
            ->where('is_admin', false)
            ->whereNotNull('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        return view('livewire.admin.email-broadcast', compact('countries'));
    }
}
