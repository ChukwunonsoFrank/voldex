<?php

namespace App\Livewire\Dashboard\Security;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;

class ChangeEmail extends Component
{
    #[Validate("required|string|email")]
    public $currentEmail = "";

    #[Validate("required|string|email")]
    public $newEmail = "";

    #[Validate("required|string|email")]
    public $confirmEmail = "";

    #[Validate("required|string")]
    public $password = "";

    public function mount()
    {
        $this->currentEmail = Auth::user()->email;
    }

    public function changeEmailAddress()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatch("error-message", message: $e->getMessage())->self();
        }

        try {
            if (
                $this->newEmail !== "" &&
                $this->confirmEmail !== "" &&
                $this->confirmEmail !== $this->newEmail
            ) {
                $this->dispatch(
                    "error-message",
                    message: "New and confirm email fields do not match",
                )->self();
                return;
            }

            if (
                $this->password !== "" &&
                !Hash::check($this->password, Auth::user()->password)
            ) {
                $this->dispatch(
                    "error-message",
                    message: "Invalid password",
                )->self();
                return;
            }

            $user = Auth::user();
            $user->email = $this->newEmail;
            $user->save();

            session()->flash("message", "Email changed successfully");
            $this->redirectRoute("dashboard.accountinformation");
        } catch (\Exception $e) {
            $this->dispatch("error-message", message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view("livewire.dashboard.security.change-email");
    }
}
