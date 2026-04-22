<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout("components.layouts.app")]
class Deposit extends Component
{
  public $amount;

  public function submitDeposit(): void
  {
    if ($this->amount <= 0) {
      $this->dispatch('change-error', message: 'Invalid deposit amount');

      return;
    }
  }

  public function render()
  {
    return view("livewire.dashboard.deposit");
  }
}
