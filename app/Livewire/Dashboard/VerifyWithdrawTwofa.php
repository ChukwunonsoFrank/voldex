<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\TransactionOccured;
use App\Notifications\WithdrawalInitiated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

class VerifyWithdrawTwofa extends Component
{
  #[Url]
  public $amount;

  #[Url]
  public $amountToReceive;

  #[Url]
  public $method;

  #[Url]
  public $address;

  public $code;

  public function verify2fa()
  {
    try {
      // Validate 2FA code format
      if (empty($this->code) || strlen($this->code) !== 6) {
        throw new \Exception("Invalid 2FA code format");
      }

      $google2fa = new Google2FA();
      $valid = $google2fa->verifyKey(
        auth()->user()->google2fa_secret,
        $this->code,
        2, // Allow 2 time windows for clock drift
      );

      if (!$valid) {
        $this->reset("code");
        $this->dispatch("error", message: "Invalid 2FA code")->self();
        return;
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

        // Send notifications inside transaction
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

      $this->redirectRoute("dashboard.transactions");
    } catch (\Exception $e) {
      $this->dispatch("error", message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view("livewire.dashboard.verify-withdraw-twofa");
  }
}
