<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use App\Models\Kyc;
use App\Models\Trade;
use App\Models\Deposit;
use Livewire\Component;
use App\Models\OtpToken;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountInformation extends Component
{
  public string $kycStatus = "";

  public bool $isKycPending = false;

  public function mount()
  {
    if (session()->has("message")) {
      $message = session()->get("message");
      $this->dispatch("message", message: $message)->self();
    }

    $this->kycStatus = auth()->user()->is_kyc_verified
      ? "Verified"
      : "Not verified";
    $kycRequest = Kyc::where("user_id", "=", auth()->user()->id, "and")
      ->latest()
      ->first();

    if ($kycRequest && $kycRequest["status"] === "pending") {
      $this->isKycPending = true;
    }
  }

  public function destroyAccount()
  {
    try {
      $user = Auth::user();

      DB::transaction(function () use ($user) {
        // Delete related KYC records
        Kyc::where("user_id", "=", $user->id, "and")->delete();

        // Delete related deposit records
        Deposit::where("user_id", "=", $user->id, "and")->delete();

        // Delete related withdrawal records
        Withdrawal::where("user_id", "=", $user->id, "and")->delete();

        // Delete related bot trades records
        Trade::where("user_id", "=", $user->id, "and")->delete();

        // Delete related bot records
        Bot::where("user_id", "=", $user->id, "and")->delete();

        // Delete related bot trades records
        OtpToken::where("user_id", "=", $user->id, "and")->delete();

        // Delete the user account
        $user->delete($user->id);
      });

      // Log out the user
      Auth::logout();

      // Redirect to signup page
      return redirect()->route("register");
    } catch (\Exception $e) {
      $this->dispatch("error-message", message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view("livewire.dashboard.account-information");
  }
}
