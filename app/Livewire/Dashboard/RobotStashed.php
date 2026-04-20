<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.app")]
class Robot extends Component
{
  public int $activeBotCount;

  public string $accountStatus = "";

  public bool $isBanned;

  public string $amount = "";

  public int $duration = 5;

  public string $accountType = "Demo Account";

  public string $accountTypeSlug = "demo";

  public int $accountBalance;

  public int $minimumAmount = 100;

  public $expectedProfitMin;

  public $expectedProfitMax;

  public function mount()
  {
    if (session()->has("message")) {
      $message = session()->get("message");
      $this->dispatch("robot-stopped", message: $message)->self();
    }

    $this->isBanned = auth()->user()->is_banned;

    $this->activeBotCount = Bot::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->where("status", "=", "active", "and")
      ->count();

    if ($this->activeBotCount > 0) {
      $this->redirectRoute("dashboard.robot.traderoom");
    }

    $this->expectedProfitMin = 0;
    $this->expectedProfitMax = 0;
    $this->accountStatus = auth()->user()->account_status;

    if (auth()->user()->live_balance > 0) {
      $this->accountType = "Live account";
      $this->accountTypeSlug = "live";
      $this->accountBalance = auth()->user()->live_balance;
    } else {
      $this->accountType = "Demo account";
      $this->accountTypeSlug = "demo";
      $this->accountBalance = auth()->user()->demo_balance;
    }
  }

  public function selectAccountType(
    string $accountType,
    string $accountTypeSlug,
  ): void {
    $this->accountType = $accountType;
    $this->accountTypeSlug = $accountTypeSlug;
    $this->accountBalance =
      $this->accountTypeSlug === "demo"
      ? auth()->user()->demo_balance
      : auth()->user()->live_balance;
  }

  public function serializeAmount(float $amount): int
  {
    return $amount * 100;
  }

  public function goToRobotSecondStep()
  {
    $this->redirectRoute("dashboard.robot-second-step", [
      "amount" => $this->amount,
      "accountType" => $this->accountType,
      "accountTypeSlug" => $this->accountTypeSlug,
    ]);
  }

  public function render()
  {
    return view("livewire.dashboard.robot");
  }
}
