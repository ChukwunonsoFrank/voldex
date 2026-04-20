<?php

namespace App\Livewire\Dashboard\Partials;

use App\Models\Bot;
use Livewire\Component;

class MobileNavbar extends Component
{
  public function robot()
  {
    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    if (count($activeBots) === 0 && auth()->user()->is_lockout_active) {
      $this->redirectRoute("dashboard.robot.lockout");
    }

    if (count($activeBots) === 0 && ! auth()->user()->is_lockout_active) {
      $this->redirectRoute("dashboard.robot");
    }

    if (count($activeBots) > 0) {
      $this->redirectRoute("dashboard.robot.traderoom");
    }
  }

  public function render()
  {
    return view("livewire.dashboard.partials.mobile-navbar");
  }
}
