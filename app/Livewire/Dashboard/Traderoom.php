<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Dashboard\Partials\AssetIndicator;
use App\Models\Bot;
use App\Models\Referral;
use App\Models\Strategy;
use App\Models\Trade;
use App\Models\User;
use App\Notifications\CommissionEarned;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Renderless;
use Livewire\Component;

#[Layout("components.layouts.app")]
class Traderoom extends Component
{
  #[Locked]
  public $isProcessing = false;

  public int $totalLiveBalance;

  public int $minimumBalanceForDoubleTrades = 5000;

  public $lockoutOneTimer;

  public $lockoutTwoTimer;

  public $activeBotOne;

  public $activeBotTwo;

  public int $activeBotCount;

  public $botOneAmount;

  public $botTwoAmount;

  public $botOneFee;

  public $botTwoFee;

  public string $botOneAccountType = "";

  public string $botTwoAccountType = "";

  public string $botOneStrategy = "";

  public string $botTwoStrategy = "";

  public string $botOneMinProfitLimit = "";

  public string $botTwoMinProfitLimit = "";

  public string $botOneMaxProfitLimit = "";

  public string $botTwoMaxProfitLimit = "";

  public string $botOneProfit = "";

  public string $botTwoProfit = "";

  public $previousBotOneProfit;

  public $previousBotTwoProfit;

  public string $botOneAsset = "";

  public string $botTwoAsset = "";

  public string $botOneAssetIcon = "";

  public string $botTwoAssetIcon = "";

  public string $botOneAssetClass = "";

  public string $botTwoAssetClass = "";

  public string $botOneSentiment = "";

  public string $botTwoSentiment = "";

  public $botOneTimerCheckpoint;

  public $botTwoTimerCheckpoint;

  public int $botOneExpirationInHrs;

  public int $botTwoExpirationInHrs;

  public $firstUpline;

  public $secondUpline;

  public int $level = 0;

  public function mount()
  {
    if (session()->has("message")) {
      $message = session()->get("message");
      $this->dispatch("robot-created", message: $message)->self();
    }

    $this->lockoutOneTimer = auth()->user()->lockout_ends_in;
    $this->lockoutTwoTimer = auth()->user()->lockout_two_ends_in;

    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    if (count($activeBots) > 0) {
      $this->calculateTotalBalance();
    }

    if (! $activeBots->isEmpty()) {
      $this->activeBotOne = $activeBots[0];
      $this->activeBotCount = count($activeBots);
    }

    if (count($activeBots) > 1) {
      $this->activeBotTwo = $activeBots[1];
    }

    // RULE:: Do not remove from this position
    if ($activeBots->isEmpty()) {
      $this->redirectRoute("dashboard.robot");
      return;
    }
    // RULE:: Do not remove from this position

    if ($this->activeBotOne && isset($this->activeBotOne["end"])) {
      $this->getBotOneExpirationInHrs();
    } else {
      $this->botOneExpirationInHrs = 0;
    }

    if ($this->activeBotTwo && isset($this->activeBotTwo["end"])) {
      $this->getBotTwoExpirationInHrs();
    } else {
      $this->botTwoExpirationInHrs = 0;
    }

    $this->initializeBotOneData();

    if (count($activeBots) > 1) {
      $this->initializeBotTwoData();
    }
  }


  public function calculateTotalBalance()
  {
    $activeBots = Bot::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->where("status", "=", "active", "and")
      ->get();

    $this->totalLiveBalance = $activeBots[0]["amount"] + auth()->user()->live_balance;
    $this->totalLiveBalance = $this->normalizeAmount($this->totalLiveBalance);
  }

  public function redirectToLockoutRoute(): void
  {
    $this->redirectRoute("dashboard.robot.lockout");
  }

  public function redirectToRobotSetupRoute(): void
  {
    $this->redirectRoute("dashboard.robot");
  }

  public function initializeBotOneData()
  {
    $previousBotOneTrade = Trade::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->where("bot_id", "=", $this->activeBotOne["id"], "and")
      ->latest()
      ->first();

    $this->previousBotOneProfit = $previousBotOneTrade
      ? number_format($previousBotOneTrade["profit"] / 100, 2, ".", ",")
      : 0;

    $this->botOneAmount = $this->normalizeAmount($this->activeBotOne["amount"]);
    $this->botOneAccountType =
      $this->activeBotOne["account_type"] === "demo"
      ? "Demo account"
      : "Live account";

    $botOneStrategy = Strategy::find($this->activeBotOne["strategy"], ["*"]);

    $this->botOneStrategy = $botOneStrategy["name"];

    $user = auth()->user();
    $exceedPercentages = [11, 12, 13];
    $dailyPercentages = [8, 9, 10];

    if ($user->profit_exceed_day > 0 && $this->botOneAccountType === 'Live account') {
      $this->botOneMinProfitLimit = min($exceedPercentages);
      $this->botOneMaxProfitLimit = max($exceedPercentages);
    } else {
      $this->botOneMinProfitLimit = min($dailyPercentages);
      $this->botOneMaxProfitLimit = max($dailyPercentages);
    }
    $this->botOneProfit = $this->activeBotOne["profit"];
    $this->botOneFee = $this->calculateFees($this->activeBotOne["profit"]);
    $this->botOneAsset = $this->activeBotOne["asset"];
    $this->botOneAssetClass = $this->activeBotOne["asset_class"];
    $this->botOneAssetIcon = $this->activeBotOne["asset_image_url"];
    $this->botOneSentiment = $this->activeBotOne["sentiment"];
    $this->botOneTimerCheckpoint = $this->activeBotOne["timer_checkpoint"];
  }

  public function initializeBotTwoData()
  {
    $previousBotTwoTrade = Trade::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->where("bot_id", "=", $this->activeBotTwo["id"], "and")
      ->latest()
      ->first();

    $this->previousBotTwoProfit = $previousBotTwoTrade
      ? number_format($previousBotTwoTrade["profit"] / 100, 2, ".", ",")
      : 0;

    $this->botTwoAmount = $this->normalizeAmount($this->activeBotTwo["amount"]);
    $this->botTwoAccountType =
      $this->activeBotTwo["account_type"] === "demo"
      ? "Demo account"
      : "Live account";

    $botTwoStrategy = Strategy::find($this->activeBotTwo["strategy"], ["*"]);

    $this->botTwoStrategy = $botTwoStrategy["name"];

    $user = auth()->user();
    $exceedPercentages = [11, 12, 13];
    $dailyPercentages = [8, 9, 10];

    if ($user->profit_exceed_day > 0) {
      $this->botTwoMinProfitLimit = min($exceedPercentages);
      $this->botTwoMaxProfitLimit = max($exceedPercentages);
    } else {
      $this->botTwoMinProfitLimit = min($dailyPercentages);
      $this->botTwoMaxProfitLimit = max($dailyPercentages);
    }
    $this->botTwoProfit = $this->activeBotTwo["profit"];
    $this->botTwoFee = $this->calculateFees($this->activeBotTwo["profit"]);
    $this->botTwoAsset = $this->activeBotTwo["asset"];
    $this->botTwoAssetClass = $this->activeBotTwo["asset_class"];
    $this->botTwoAssetIcon = $this->activeBotTwo["asset_image_url"];
    $this->botTwoSentiment = $this->activeBotTwo["sentiment"];
    $this->botTwoTimerCheckpoint = $this->activeBotTwo["timer_checkpoint"];
  }

  public function getBotOneExpirationInHrs()
  {
    $endString = $this->activeBotOne["end"];
    // If the timestamp is in milliseconds, convert to seconds
    if (is_numeric($endString) && strlen($endString) >= 13) {
      $endTimestamp = intval($endString) / 1000;
      $endTime = \Carbon\Carbon::createFromTimestamp($endTimestamp);
    } else {
      // Try to parse as Y-m-d H:i:s, fallback to strtotime
      try {
        $endTime = \Carbon\Carbon::createFromFormat(
          "Y-m-d H:i:s",
          $endString,
        );
      } catch (\Exception $e) {
        $endTimestamp = strtotime($endString);
        $endTime = $endTimestamp
          ? \Carbon\Carbon::createFromTimestamp($endTimestamp)
          : null;
      }
      // If parsing failed, try Carbon::parse as last resort
      if (empty($endTime)) {
        try {
          $endTime = \Carbon\Carbon::parse($endString);
        } catch (\Exception $e) {
          $endTime = null;
        }
      }
    }
    $now = \Carbon\Carbon::now();
    $this->botOneExpirationInHrs = isset($endTime)
      ? max(0, $now->diffInHours($endTime, false))
      : 0;
  }

  public function getBotTwoExpirationInHrs()
  {
    $endString = $this->activeBotTwo["end"];
    // If the timestamp is in milliseconds, convert to seconds
    if (is_numeric($endString) && strlen($endString) >= 13) {
      $endTimestamp = intval($endString) / 1000;
      $endTime = \Carbon\Carbon::createFromTimestamp($endTimestamp);
    } else {
      // Try to parse as Y-m-d H:i:s, fallback to strtotime
      try {
        $endTime = \Carbon\Carbon::createFromFormat(
          "Y-m-d H:i:s",
          $endString,
        );
      } catch (\Exception $e) {
        $endTimestamp = strtotime($endString);
        $endTime = $endTimestamp
          ? \Carbon\Carbon::createFromTimestamp($endTimestamp)
          : null;
      }
      // If parsing failed, try Carbon::parse as last resort
      if (empty($endTime)) {
        try {
          $endTime = \Carbon\Carbon::parse($endString);
        } catch (\Exception $e) {
          $endTime = null;
        }
      }
    }
    $now = \Carbon\Carbon::now();
    $this->botTwoExpirationInHrs = isset($endTime)
      ? max(0, $now->diffInHours($endTime, false))
      : 0;
  }

  public function getBotExpirationInHrs(string $endString)
  {
    // If the timestamp is in milliseconds, convert to seconds
    if (is_numeric($endString) && strlen($endString) >= 13) {
      $endTimestamp = intval($endString) / 1000;
      $endTime = \Carbon\Carbon::createFromTimestamp($endTimestamp);
    } else {
      // Try to parse as Y-m-d H:i:s, fallback to strtotime
      try {
        $endTime = \Carbon\Carbon::createFromFormat(
          "Y-m-d H:i:s",
          $endString,
        );
      } catch (\Exception $e) {
        $endTimestamp = strtotime($endString);
        $endTime = $endTimestamp
          ? \Carbon\Carbon::createFromTimestamp($endTimestamp)
          : null;
      }
      // If parsing failed, try Carbon::parse as last resort
      if (empty($endTime)) {
        try {
          $endTime = \Carbon\Carbon::parse($endString);
        } catch (\Exception $e) {
          $endTime = null;
        }
      }
    }
    $now = \Carbon\Carbon::now();
    $botExpirationInHrs = isset($endTime)
      ? max(0, $now->diffInHours($endTime, false))
      : 0;
    return $botExpirationInHrs;
  }

  public function calculateFees(int $profit): int
  {
    $fee = intval(round($profit * (5 / 100)));
    return $fee;
  }

  public function normalizeAmount(int $amount): int|float
  {
    return $amount / 100;
  }

  public function serializeAmount(float $amount): int
  {
    return $amount * 100;
  }

  #[Renderless]
  public function refreshBotOneAssetData(): void
  {
    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    $activeBotOne = $activeBots[0];

    if ($activeBotOne === null) {
      return;
    }

    $previousBotOneTrade = Trade::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->where("bot_id", $this->activeBotOne["id"])
      ->latest()
      ->first();

    $this->previousBotOneProfit = $previousBotOneTrade
      ? number_format($previousBotOneTrade["profit"] / 100, 2, ".", ",")
      : 0;

    $this->botOneProfit = $activeBotOne["profit"];
    $this->botOneFee = $this->calculateFees($activeBotOne["profit"]);
    $this->botOneAsset = $activeBotOne["asset"];
    $this->botOneAssetClass = $activeBotOne["asset_class"];
    $this->botOneAssetIcon = $activeBotOne["asset_image_url"];
    $this->botOneSentiment = $activeBotOne["sentiment"];
    $data = [
      "asset" => $activeBotOne["asset"],
      "assetImageUrl" => $activeBotOne["asset_image_url"],
      "assetClass" => $activeBotOne["asset_class"],
      "isBotActive" => true,
    ];
    $this->dispatch("asset-updated", data: $data)->to(
      AssetIndicator::class,
    );
    $this->botOneTimerCheckpoint = $activeBotOne["timer_checkpoint"];
  }

  #[Renderless]
  public function refreshBotTwoAssetData(): void
  {
    $activeBots = Bot::where("user_id", "=", auth()->user()->id, "and")
      ->where("status", "=", "active", "and")
      ->get();

    $activeBotTwo = $activeBots[1];

    if ($activeBotTwo === null) {
      return;
    }

    $previousBotTwoTrade = Trade::where(
      "user_id",
      "=",
      auth()->user()->id,
      "and",
    )
      ->where("bot_id", $this->activeBotTwo["id"])
      ->latest()
      ->first();

    $this->previousBotTwoProfit = $previousBotTwoTrade
      ? number_format($previousBotTwoTrade["profit"] / 100, 2, ".", ",")
      : 0;

    $this->botTwoProfit = $activeBotTwo["profit"];
    $this->botTwoFee = $this->calculateFees($activeBotTwo["profit"]);
    $this->botTwoAsset = $activeBotTwo["asset"];
    $this->botTwoAssetClass = $activeBotTwo["asset_class"];
    $this->botTwoAssetIcon = $activeBotTwo["asset_image_url"];
    $this->botTwoSentiment = $activeBotTwo["sentiment"];
    $data = [
      "asset" => $activeBotTwo["asset"],
      "assetImageUrl" => $activeBotTwo["asset_image_url"],
      "assetClass" => $activeBotTwo["asset_class"],
      "isBotActive" => true,
    ];
    $this->dispatch("asset-updated", data: $data)->to(
      AssetIndicator::class,
    );
    $this->botOneTimerCheckpoint = $activeBotTwo["timer_checkpoint"];
  }

  // continue from here
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
      }
    }
  }

  public function processReferralPayouts(
    float $robotProfit,
    string $referralCode,
    string $botOwnerName,
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
       * Top upline commission(12% on trade profits)
       */
      $commission = intval(round($robotProfit * (12 / 100)));
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
          $botOwnerName,
          strval($this->normalizeAmount($commission)),
          "trade profit",
        ),
      );
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
       * Middle upline commission(12% on trade profits)
       */
      $commission = intval(round($robotProfit * (12 / 100)));
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
          $botOwnerName,
          strval($this->normalizeAmount($commission)),
          "trade profit",
        ),
      );

      /**
       * First upline commission(8% on trade profits)
       */
      $commission = intval(round($robotProfit * (8 / 100)));
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
          $botOwnerName,
          strval($this->normalizeAmount($commission)),
          "trade profit",
        ),
      );
    }
  }

  public function stopRobot(int $botId): void
  {
    try {
      if ($this->isProcessing) {
        return;
      }

      $this->isProcessing = true;

      $botData = null;

      if ($botId === 1) {
        $botData = Bot::where("user_id", "=", auth()->user()->id, "and")
          ->where("status", "active")
          ->where("id", $this->activeBotOne["id"])
          ->first();
      }

      if ($botId === 2) {
        $botData = Bot::where("user_id", "=", auth()->user()->id, "and")
          ->where("status", "active")
          ->where("id", $this->activeBotTwo["id"])
          ->first();
      }

      DB::transaction(function () use ($botId) {
        $bot = null;

        if ($botId === 1) {
          // Lock the bot row for update
          $bot = Bot::where("user_id", "=", auth()->user()->id, "and")
            ->where("status", "active")
            ->where("id", $this->activeBotOne["id"])
            ->lockForUpdate()
            ->first();
        }

        if ($botId === 2) {
          // Lock the bot row for update
          $bot = Bot::where("user_id", "=", auth()->user()->id, "and")
            ->where("status", "active")
            ->where("id", $this->activeBotTwo["id"])
            ->lockForUpdate()
            ->first();
        }

        if (!$bot) {
          throw new \Exception("No active bot found!");
        }

        // Lock the user record for balance update
        $user = User::where("id", "=", auth()->user()->id, "and")
          ->lockForUpdate()
          ->first();

        if (!$user) {
          throw new \Exception("User not found!");
        }

        // Now proceed with the rest of the logic
        $accountType = $bot->account_type;
        $amount = $bot->amount;
        $profit = $bot->profit;
        $fee = $this->calculateFees($bot->profit);

        // Update bot status
        $bot->status = "closed";
        $bot->save();

        // Update user balance
        if ($accountType === "demo") {
          $user->demo_balance += $amount + $profit - $fee;
          $user->save();
        } else {
          $user->live_balance += $amount + $profit - $fee;
          $user->save();

          if ($user->referred_by && $profit > 0) {
            $profitMinusFees = $profit - $fee;
            $this->computeUpline($user->referred_by);
            $this->processReferralPayouts(
              $profitMinusFees,
              $user->referral_code,
              $user->name,
            );
          }
        }

        if ($accountType === "live") {
          if (! $user->lockout_ends_in) {
            $user->is_lockout_active = true;
            $user->lockout_ends_in = strval(
              now()
                ->addMinutes(45)
                ->getTimestampMs()
            );
            $user->save();
          } else {
            $user->is_lockout_active = true;
            $user->lockout_two_ends_in = strval(
              now()
                ->addMinutes(45)
                ->getTimestampMs()
            );
            $user->save();
          }
        }
      });

      if ($this->activeBotCount > 0 && $botData->account_type === 'demo') {
        $this->redirectRoute("dashboard.robot.traderoom");
        return;
      }

      if ($botData->account_type === 'demo') {
        $this->redirectRoute("dashboard.robot");
        return;
      }

      if ($this->activeBotCount > 1 && $botData->account_type === 'live') {
        $this->redirectRoute("dashboard.robot.traderoom");
      } else {
        $this->redirectRoute("dashboard.robot.lockout");
      }
    } catch (\Exception $e) {
      $this->dispatch(
        "stop-robot-error",
        message: $e->getMessage(),
      )->self();
    } finally {
      $this->isProcessing = false;
    }
  }

  public function render()
  {
    return view("livewire.dashboard.traderoom");
  }
}
