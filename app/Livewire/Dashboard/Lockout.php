<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use Livewire\Component;

class Lockout extends Component
{
  public $timerCheckpointOne;

  public $timerCheckpointTwo;

  public int $activeBotCount;

  public function mount()
  {
    if (session()->has("message")) {
      $message = session()->get("message");
      $this->dispatch("lockout-message", message: $message)->self();
    }

    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    $this->activeBotCount = count($activeBots);

    $this->timerCheckpointOne = auth()->user()->lockout_ends_in;
    $this->timerCheckpointTwo = auth()->user()->lockout_two_ends_in;
  }

  public function refreshBotData(): void
  {
    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    $this->activeBotCount = count($activeBots);

    $this->timerCheckpointOne = auth()->user()->lockout_ends_in;
    $this->timerCheckpointTwo = auth()->user()->lockout_two_ends_in;
  }

  public function redirectToRobotSetupRoute(): void
  {
    $this->redirectRoute("dashboard.robot");
  }

  public function redirectToTraderoomRoute(): void
  {
    $this->redirectRoute("dashboard.robot.traderoom");
  }

  public function render()
  {
    return view('livewire.dashboard.lockout');
  }
}
