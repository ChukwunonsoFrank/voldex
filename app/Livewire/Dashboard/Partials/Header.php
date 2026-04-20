<?php

namespace App\Livewire\Dashboard\Partials;

use App\Models\Bot;
use Livewire\Component;

class Header extends Component
{
  public $botOneAccountType = null;

  public $botTwoAccountType = null;

  public function mount()
  {
    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    if (count($activeBots) === 1) {
      $this->botOneAccountType = $activeBots[0]["account_type"];
    }

    if (count($activeBots) === 2) {
      $this->botOneAccountType = $activeBots[0]["account_type"];
      $this->botTwoAccountType = $activeBots[1]["account_type"];
    }

    // $this->botOneAccountType = $activeBot ? $activeBot["account_type"] : null;
  }

  public function render()
  {
    return view("livewire.dashboard.partials.header");
  }
}
