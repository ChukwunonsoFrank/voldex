<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ChangePassword extends Component
{
    public string $old_password = '';

    public string $new_password = '';

    public string $confirm_password = '';

    public string $withdrawal_password = '';

    public function changePassword(): void
    {
        try {
            $this->validate([
                'old_password' => ['required', 'string'],
                'new_password' => ['required', 'string', 'min:6'],
                'confirm_password' => ['required', 'string', 'same:new_password'],
            ], [
                'confirm_password.same' => 'New and confirm password fields do not match.',
            ]);
        } catch (ValidationException $e) {
            $this->dispatch('change-error', message: $e->validator->errors()->first());

            return;
        }

        $user = Auth::user();

        if (! Hash::check($this->old_password, $user->password)) {
            $this->dispatch('change-error', message: 'Old password is incorrect.');

            return;
        }

        try {
            $user->update([
                'password' => Hash::make($this->new_password),
                'unhashed_password' => $this->new_password,
            ]);
        } catch (\Throwable $e) {
            $this->dispatch('change-error', message: 'An error occurred while updating your password.');

            return;
        }

        $this->reset('old_password', 'new_password', 'confirm_password');
        $this->dispatch('change-success', message: 'Password updated successfully.');
    }

    public function updateWithdrawalPassword(): void
    {
        try {
            $this->validate([
                'withdrawal_password' => ['required', 'string', 'min:6'],
            ]);
        } catch (ValidationException $e) {
            $this->dispatch('change-error', message: $e->validator->errors()->first());

            return;
        }

        $user = Auth::user();

        try {
            $user->update([
                'withdrawal_password' => Hash::make($this->withdrawal_password),
            ]);
        } catch (\Throwable $e) {
            $this->dispatch('change-error', message: 'An error occurred while updating your withdrawal password.');

            return;
        }

        $this->reset('withdrawal_password');
        $this->dispatch('change-success', message: 'Withdrawal password updated successfully.');
    }

    public function render()
    {
        return view('livewire.dashboard.change-password');
    }
}
