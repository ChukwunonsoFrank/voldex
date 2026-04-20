<?php

namespace App\Livewire\Dashboard;

use App\Models\OtpToken;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\TokenRequested;
use App\Notifications\TransactionOccured;
use App\Notifications\WithdrawalInitiated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout("components.layouts.app")]
class VerifyOtp extends Component
{
  #[Url]
  public $amount;

  #[Url]
  public $amountToReceive;

  #[Url]
  public $method;

  #[Url]
  public $address;

  public $token = "";

  public $generatedToken;

  #[Locked]
  public $processingWithdrawal = false;

  public function mount()
  {
    $this->generatedToken = OtpToken::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )->first();
  }

  public function createWithdrawal()
  {
    // Prevent double submission
    if ($this->processingWithdrawal) {
      $this->dispatch(
        "withdraw-error",
        message: "Already processing withdrawal",
      )->self();
      return;
    }

    $this->processingWithdrawal = true;

    try {
      // Validate OTP token
      if (empty($this->token)) {
        throw new \Exception("OTP token field is empty");
      }

      if (
        !isset($this->generatedToken["token"]) ||
        !isset($this->generatedToken["expires_at"])
      ) {
        throw new \Exception(
          "No valid OTP session found. Please generate a new code.",
        );
      }

      if ($this->token !== $this->generatedToken["token"]) {
        // Increment failed attempts (optional: implement lockout after X attempts)
        throw new \Exception("Invalid OTP token");
      }

      $expiresAt = $this->generatedToken["expires_at"];
      $now = now()->getTimestampMs();

      if ($now > $expiresAt) {
        throw new \Exception(
          'Expired OTP token. Click on "Resend code" to generate a new token.',
        );
      }

      DB::transaction(function () {
        // Lock the user record to prevent concurrent withdrawals
        $user = User::where("id", "=", auth()->user()->id, "and")
          ->lockForUpdate()
          ->first();

        if (!$user) {
          throw new \Exception("User not found");
        }

        $userId = $user->id;
        $userLiveBalance = $user->live_balance;

        $newBalance = $userLiveBalance - $this->amount;

        // Create withdrawal record
        $withdrawal = Withdrawal::create([
          "user_id" => $userId,
          "amount" => $this->amount,
          "received_amount" => $this->amountToReceive,
          "payment_method" => $this->method,
          "address" => $this->address,
          "status" => "pending",
        ]);

        // Update user balance atomically
        $user->live_balance = $newBalance;
        $user->save();

        // Invalidate the OTP token after successful use (prevent replay)
        $this->generatedToken["token"] = null;
        $this->generatedToken["expires_at"] = null;

        // Send notifications
        $user->notify(
          new WithdrawalInitiated(
            $user->name,
            strval($this->amount / 100),
          ),
        );

        Notification::route("mail", "fredbest230@gmail.com")->notify(
          new TransactionOccured(
            "withdrawal",
            $user->name,
            strval($this->amount / 100),
          ),
        );
      });

      session()->flash(
        "message",
        "Withdrawal successful. You will receive an email when your withdrawal has been processed.",
      );

      $this->reset([
        "token",
        "amount",
        "amountToReceive",
        "method",
        "address",
      ]);
      $this->redirectRoute("dashboard.transactions");
    } catch (\Exception $e) {
      $this->dispatch(
        "withdraw-error",
        message: $e->getMessage(),
      )->self();
    } finally {
      $this->processingWithdrawal = false;
    }
  }

  public function resendOTPToken()
  {
    try {
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

      $message = "A new code has been sent to your email address";

      $this->dispatch("token-generated", message: $message)->self();
    } catch (\Exception $e) {
      $this->dispatch(
        "withdraw-error",
        message: $e->getMessage(),
      )->self();
    }
  }

  public function render()
  {
    return view("livewire.dashboard.verify-otp");
  }
}
