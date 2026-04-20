<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class WithdrawPasswordStep extends Component
{
    public string $withdrawal_password = '';

    public function verifyWithdrawalPassword(): void
    {
        $this->validate([
            'withdrawal_password' => ['required', 'string'],
        ]);

        $user = auth()->user();

        if (! Hash::check($this->withdrawal_password, $user->withdrawal_password)) {
            $this->dispatch('change-error', message: 'Invalid withdrawal password.');
            $this->reset('withdrawal_password');

            return;
        }

        session(['withdrawal_password_verified' => true]);

        $this->redirect(route('dashboard.withdraw'));
    }

    public function render()
    {
        return view('livewire.dashboard.withdraw-password-step');
    }
}
