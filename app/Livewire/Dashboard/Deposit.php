<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;

#[Layout("components.layouts.app")]
class Deposit extends Component
{
  public string $accountStatus = "";

  public bool $isBanned;

  public bool $isUserPioneer = false;

  public string $amount = "";

  public int $minimumDepositAmount = 100;

  public $paymentMethod;

  public $paymentMethods;

  public $selectedPaymentMethodSlug = "";

  public function mount()
  {
    if (auth()->user()->created_at->isBefore('2026-02-15')) {
      $this->isUserPioneer = !$this->isUserPioneer;
    }

    $this->isBanned = auth()->user()->is_banned;
    $this->paymentMethods = PaymentMethod::all();
    $this->accountStatus = auth()->user()->account_status;
  }

  public function selectPaymentMethod(string $slug): void
  {
    $filtered = $this->paymentMethods->filter(
      fn(PaymentMethod $value) => $value["slug"] === $slug,
    );

    $this->paymentMethod = $filtered->first();
    $this->selectedPaymentMethodSlug = $slug;
  }

  public function serializeAmount(float $amount): int
  {
    return $amount * 100;
  }

  public function confirmDeposit()
  {
    if ($this->amount === "") {
      $this->dispatch(
        "deposit-error",
        message: "Amount field is empty",
      )->self();
      return;
    }

    if (intval($this->amount) === 0) {
      $this->dispatch(
        "deposit-error",
        message: "Amount must be greater than 0",
      )->self();
      return;
    }

    if (floatval($this->amount) < $this->minimumDepositAmount) {
      $message =
        'Minimum deposit is $' . strval($this->minimumDepositAmount);
      $this->dispatch("deposit-error", message: $message)->self();
      return;
    }

    $this->redirectRoute("dashboard.deposit.confirm", [
      "amount" => $this->serializeAmount(floatval($this->amount)),
      "method" => $this->paymentMethod["name"],
      "address" => $this->paymentMethod["address"],
      "iconUrl" => $this->paymentMethod["icon_url"],
      "slug" => $this->paymentMethod["slug"],
    ]);
  }

  public function render()
  {
    return view("livewire.dashboard.deposit");
  }
}
