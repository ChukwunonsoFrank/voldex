<?php

namespace App\Livewire\Admin;

use App\Models\Deposit;
use App\Models\Referral;
use App\Models\User;
use App\Notifications\CommissionEarned;
use App\Notifications\DepositApproved;
use App\Notifications\DepositDeclined;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout("components.layouts.admin")]
class AdminDepositDetails extends Component
{
  #[Url]
  public $id;

  public $deposit;

  public string $name;

  public string $paymentMethod;

  public string $amount;

  public string $paymentScreenshotPath;

  public string $status;

  public $firstUpline;

  public $secondUpline;

  public int $level = 0;

  public function mount()
  {
    $this->deposit = Deposit::with("user")->where("id", $this->id)->first();
    $this->name = $this->deposit->user->name;
    $this->paymentMethod = $this->deposit["payment_method"];
    $this->amount = $this->deposit["amount"];
    $this->paymentScreenshotPath = $this->deposit["payment_screenshot_path"];
    $this->status = $this->deposit["status"];
  }

  public function computeUpline(string $referredBy)
  {
    // Reset properties
    $this->firstUpline = null;
    $this->secondUpline = null;
    $this->level = 0;

    $currentUpline = User::where(
      "referral_code",
      "=",
      $referredBy,
      "and",
    )->first();
    if ($currentUpline !== null) {
      $this->firstUpline = $currentUpline;
      $this->level = 1;
      Log::info("First upline found: " . $this->firstUpline["id"]);
      Log::info("Level: " . $this->level);
      $currentUpline = User::where(
        "referral_code",
        "=",
        $currentUpline["referred_by"],
        "and",
      )->first();
      if ($currentUpline !== null) {
        $this->secondUpline = $this->firstUpline;
        $this->firstUpline = $currentUpline;
        $this->level = 2;
        Log::info("Second upline found: " . $this->firstUpline["id"]);
        Log::info("Level: " . $this->level);
      }
    }
  }

  public function processReferralPayouts(
    float $depositAmount,
    string $referralCode,
    string $depositOwnerName,
  ) {
    if ($this->level === 1) {
      // Lock and fetch the first upline user
      $firstUpline = User::where("id", "=", $this->firstUpline["id"], "and")
        ->lockForUpdate()
        ->first();

      if (!$firstUpline) {
        throw new \Exception("First upline user not found");
      }

      /**
       * Top upline commission
       */
      $commission = intval(round($depositAmount * (8 / 100)));
      $newFirstUplineBalance = $firstUpline->live_balance + $commission;

      $firstUpline->live_balance = $newFirstUplineBalance;
      $firstUpline->save();

      Referral::create([
        "user_id" => $firstUpline->id,
        "referral_code" => $referralCode,
        "amount" => $commission,
        "level" => "1",
      ]);

      $firstUpline->notify(
        new CommissionEarned(
          $firstUpline->name,
          $depositOwnerName,
          strval($commission / 100),
          "deposit",
        ),
      );

      Log::info("Ran level 1 referral payout for user ID: " . $firstUpline->id);
    }

    if ($this->level === 2) {
      // Lock both upline users to prevent race conditions
      $secondUpline = User::where("id", "=", $this->secondUpline["id"], "and")
        ->lockForUpdate()
        ->first();

      if (!$secondUpline) {
        throw new \Exception("Second upline user not found");
      }

      $firstUpline = User::where("id", "=", $this->firstUpline["id"], "and")
        ->lockForUpdate()
        ->first();

      if (!$firstUpline) {
        throw new \Exception("First upline user not found");
      }

      /**
       * Middle upline commission
       */
      $commission = intval(round($depositAmount * (8 / 100)));
      $newSecondUplineBalance = $secondUpline->live_balance + $commission;

      $secondUpline->live_balance = $newSecondUplineBalance;
      $secondUpline->save();

      Referral::create([
        "user_id" => $secondUpline->id,
        "referral_code" => $referralCode,
        "amount" => $commission,
        "level" => "1",
      ]);

      $secondUpline->notify(
        new CommissionEarned(
          $secondUpline->name,
          $depositOwnerName,
          strval($commission / 100),
          "deposit",
        ),
      );

      /**
       * First upline commission
       */
      $commission = intval(round($depositAmount * (4 / 100)));
      $newFirstUplineBalance = $firstUpline->live_balance + $commission;

      $firstUpline->live_balance = $newFirstUplineBalance;
      $firstUpline->save();

      Referral::create([
        "user_id" => $firstUpline->id,
        "referral_code" => $referralCode,
        "amount" => $commission,
        "level" => "2",
      ]);

      $firstUpline->notify(
        new CommissionEarned(
          $firstUpline->name,
          $depositOwnerName,
          strval($commission / 100),
          "deposit",
        ),
      );

      Log::info("Ran level 1 & 2 referral payout for user IDs: " . $firstUpline->id . ", " . $secondUpline->id);
    }
  }

  public function approveDeposit(int $depositId, int $userId, int $amount)
  {
    try {
      DB::transaction(function () use ($depositId, $userId, $amount) {
        // Lock the deposit record first to prevent concurrent approvals
        $deposit = Deposit::where("id", "=", $depositId, "and")
          ->lockForUpdate()
          ->first();

        if (!$deposit) {
          throw new \Exception("Deposit not found");
        }

        // Check if already processed
        if ($deposit->status === "confirmed") {
          throw new \Exception("Deposit already confirmed");
        }

        // Lock the user record for balance update
        $user = User::where("id", "=", $userId, "and")
          ->lockForUpdate()
          ->first();

        if (!$user) {
          throw new \Exception("User not found");
        }

        $userLiveBalance = $user->live_balance;
        $newBalance = $userLiveBalance + $amount;

        // Update user balance
        $user->live_balance = $newBalance;
        $user->save();

        // Update deposit status
        $deposit->status = "confirmed";
        $deposit->save();

        // Send notification (inside transaction to ensure it only happens once)
        $user->notify(
          new DepositApproved($user->name, strval($amount / 100)),
        );

        // Process referral payouts if applicable
        if ($user->referred_by !== null) {
          Log::info("Processing referral payouts for user ID: " . $user->id);
          $this->computeUpline($user->referred_by);
          Log::info("Current Level: " . $this->level);
          $this->processReferralPayouts(
            $amount,
            $user->referral_code,
            $user->name,
          );
        }
      });

      session()->flash(
        "success-message",
        "Deposit confirmed successfully",
      );
    } catch (\Exception $e) {
      session()->flash("error-message", $e->getMessage());
    }
  }

  public function declineDeposit(int $depositId, int $userId, int $amount)
  {
    try {
      $user = User::where("id", "=", $userId, "and")->first();

      Deposit::where("id", "=", $depositId, "and")->update([
        "status" => "declined",
      ]);

      $user->notify(
        new DepositDeclined($user->name, strval($amount / 100)),
      );

      session()->flash(
        "success-message",
        "Deposit declined successfully",
      );
    } catch (\Exception $e) {
      session()->flash("error-message", $e->getMessage());
    }
  }

  public function getStatusIndicatorColor(string $status)
  {
    if ($status === "pending") {
      return "bg-warning-50 text-warning-600";
    }

    if ($status === "approved") {
      return "bg-success-50 text-success-600";
    }

    if ($status === "declined") {
      return "bg-error-50 text-error-600";
    }
  }

  public function render()
  {
    return view('livewire.admin.admin-deposit-details');
  }
}
