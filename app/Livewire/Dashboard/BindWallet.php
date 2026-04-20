<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class BindWallet extends Component
{
    public string $network = 'ERC 20';

    public string $wallet_address = '';

    public string $withdrawal_password = '';

    public function bind(): void
    {
        try {
            $this->validate([
                'network' => ['required', 'in:ERC 20,TRC 20'],
                'wallet_address' => ['required', 'string'],
                'withdrawal_password' => ['required', 'string'],
            ]);
        } catch (ValidationException $e) {
            $this->dispatch('bind-error', message: $e->validator->errors()->first());

            return;
        }

        $user = Auth::user();

        if (! Hash::check($this->withdrawal_password, $user->withdrawal_password)) {
            $this->dispatch('bind-error', message: 'Incorrect withdrawal password.');

            return;
        }

        try {
            $user->update([
                'withdrawal_address' => $this->wallet_address,
                'withdrawal_address_type' => $this->network,
            ]);
        } catch (\Throwable $e) {
            $this->dispatch('bind-error', message: 'An error occurred while binding your wallet.')->self();

            return;
        }

        $this->reset('withdrawal_password');
        $this->dispatch('bind-wallet', message: 'Wallet updated successfully.')->self();
    }

    public function render()
    {
        return view('livewire.dashboard.bind-wallet');
    }
}
