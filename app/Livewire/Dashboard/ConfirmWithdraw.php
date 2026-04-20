<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\OtpToken;
use App\Models\User;
use App\Notifications\TokenRequested;
use Livewire\Attributes\Layout;

#[Layout("components.layouts.app")]
class ConfirmWithdraw extends Component
{
  #[Url]
  public $amount;

  #[Url]
  public $method;

  #[Url]
  public $address;

  #[Url]
  public $iconUrl;

  #[Url]
  public $slug;

  public $amountToPay;

  public $fee;

  public $feePercentage = 2;

  public $amountToReceive;

  public function mount()
  {
    $this->amountToPay = $this->amount / 100;
    $this->fee = $this->calculateFees($this->amountToPay);
    $this->amountToReceive = $this->amountToPay - $this->fee;
  }

  public function back()
  {
    $this->redirect("/dashboard/withdraw");
  }

  public function calculateFees(float|int $amount): float
  {
    $fee = round(($amount * $this->feePercentage) / 100, 2);
    return $fee;
  }

  public function formatAmountToPay()
  {
    return '$' . strval($this->amountToPay) . " USD";
  }

  public function formatFee()
  {
    return '$' . strval($this->fee) . " USD";
  }

  public function formatAmountToReceive()
  {
    return '$' . strval($this->amountToReceive) . " USD";
  }

  public function serializeAmount(float $amount): int
  {
    return $amount * 100;
  }

  public function generateOTP()
  {
    try {
      // Pass query parameters by appending them to the URL string:
      $twoFAQueryParams = http_build_query([
        "amount" => $this->amount,
        "amountToReceive" => $this->serializeAmount(
          $this->amountToReceive,
        ),
        "method" => $this->method,
        "address" => $this->address,
      ]);

      $otpQueryParams = http_build_query([
        "amount" => $this->amount,
        "amountToReceive" => $this->serializeAmount(
          $this->amountToReceive,
        ),
        "method" => $this->method,
        "address" => $this->address,
      ]);

      if (auth()->user()->two_factor_enabled) {
        $this->redirect(
          "/dashboard/withdraw/verifywithdrawtwofa?$twoFAQueryParams",
        );
      } else {
        $token = OtpToken::updateOrCreate(
          [
            "user_id" => auth()->user()->id,
          ],
          [
            "token" => substr(str_shuffle("0123456789"), 0, 6),
            "expires_at" => now()->addMinutes(10)->getTimestampMs(),
          ],
        );

        $user = User::find(auth()->user()->id, ["*"]);

        $user->notify(
          new TokenRequested(auth()->user()->name, $token["token"]),
        );

        $this->redirect(
          "/dashboard/withdraw/verifyotp?$otpQueryParams",
        );
      }
    } catch (\Exception $e) {
      $this->dispatch(
        "withdraw-error",
        message: $e->getMessage(),
      )->self();
    }
  }

  public function render()
  {
    return view("livewire.dashboard.confirm-withdraw");
  }
}
