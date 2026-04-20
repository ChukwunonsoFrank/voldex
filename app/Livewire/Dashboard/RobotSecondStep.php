<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use App\Models\Strategy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout("components.layouts.app")]
class RobotSecondStep extends Component
{
  public int $activeBotCount;

  public string $accountStatus = "";

  public bool $isBanned;

  #[Url]
  public string $amount;

  #[Url]
  public string $accountType;

  #[Url]
  public string $accountTypeSlug;

  public string $durationType = "";

  public int $accountBalance;

  public $strategy;

  public $strategies;

  public $strategySlug;

  public int $minimumAmount;

  public $expectedProfitMin;

  public $expectedProfitMax;

  public function mount()
  {
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

    $this->strategies = Strategy::all();

    $this->expectedProfitMin = 0;
    $this->expectedProfitMax = 0;
    $this->accountStatus = auth()->user()->account_status;
    $this->accountBalance =
      $this->accountTypeSlug === "demo"
      ? auth()->user()->demo_balance
      : auth()->user()->live_balance;
  }

  public function calculateProfitExpected()
  {
    if ($this->amount === "") {
      $this->expectedProfitMin = 0;
      $this->expectedProfitMax = 0;
      return;
    }

    if (floatval($this->amount) < floatval($this->strategy["min_amount"])) {
      $this->expectedProfitMin = 0;
      $this->expectedProfitMax = 0;
      return;
    }

    $expectedProfitMin =
      (floatval($this->strategy["min_roi"]) / 100) *
      floatval($this->amount);
    $expectedProfitMax =
      floatval($this->strategy["max_roi"] / 100) *
      floatval($this->amount);
    $this->expectedProfitMin = number_format(
      $expectedProfitMin,
      2,
      ".",
      ",",
    );
    $this->expectedProfitMax = number_format(
      $expectedProfitMax,
      2,
      ".",
      ",",
    );
  }

  public function selectDurationType(
    string $durationType,
  ): void {
    $this->durationType = $durationType;
  }

  public function generateAssetToTrade()
  {
    $weekendTradingPair = [
      [
        "name" => "BTC/USDT",
        "percentage" => "91%",
        "assetType" => "crypto",
        "symbol" => "BTCUSDT",
        "image" => "btc.svg",
      ],
      [
        "name" => "ETH/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "ETHUSDT",
        "image" => "eth.svg",
      ],
      [
        "name" => "LTC/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "LTCUSDT",
        "image" => "ltc.svg",
      ],
      [
        "name" => "SOL/USDT",
        "percentage" => "98%",
        "assetType" => "crypto",
        "symbol" => "SOLUSDT",
        "image" => "sol.svg",
      ],
      [
        "name" => "XRP/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "XRPUSDT",
        "image" => "xrp.svg",
      ],
      [
        "name" => "DOGE/USDT",
        "percentage" => "83%",
        "assetType" => "crypto",
        "symbol" => "DOGEUSDT",
        "image" => "doge.svg",
      ],
      [
        "name" => "BCH/USDT",
        "percentage" => "89%",
        "assetType" => "crypto",
        "symbol" => "BCHUSDT",
        "image" => "bch.svg",
      ],
      [
        "name" => "DAI/USDT",
        "percentage" => "97%",
        "assetType" => "crypto",
        "symbol" => "DAIUSDT",
        "image" => "dai.svg",
      ],
      [
        "name" => "BNB/USDT",
        "percentage" => "87%",
        "assetType" => "crypto",
        "symbol" => "BNBUSDT",
        "image" => "bnb.svg",
      ],
      [
        "name" => "ADA/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "ADAUSDT",
        "image" => "ada.svg",
      ],
      [
        "name" => "AVAX/USDT",
        "percentage" => "99%",
        "assetType" => "crypto",
        "symbol" => "AVAXUSDT",
        "image" => "avax.svg",
      ],
      [
        "name" => "TRX/USDT",
        "percentage" => "90%",
        "assetType" => "crypto",
        "symbol" => "TRXUSDT",
        "image" => "trx.svg",
      ],
      [
        "name" => "MATIC/USDT",
        "percentage" => "91%",
        "assetType" => "crypto",
        "symbol" => "MATICUSDT",
        "image" => "matic.svg",
      ],
      [
        "name" => "ATOM/USDT",
        "percentage" => "96%",
        "assetType" => "crypto",
        "symbol" => "ATOMUSDT",
        "image" => "atom.svg",
      ],
      [
        "name" => "LINK/USDT",
        "percentage" => "87%",
        "assetType" => "crypto",
        "symbol" => "LINKUSDT",
        "image" => "link.svg",
      ],
      [
        "name" => "DASH/USDT",
        "percentage" => "87%",
        "assetType" => "crypto",
        "symbol" => "DASHUSDT",
        "image" => "dash.svg",
      ],
      [
        "name" => "XLM/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "XLMUSDT",
        "image" => "xlm.svg",
      ],
      [
        "name" => "NEO/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "NEOUSDT",
        "image" => "neo.svg",
      ],
      [
        "name" => "BAT/USDT",
        "percentage" => "83%",
        "assetType" => "crypto",
        "symbol" => "BATUSDT",
        "image" => "bat.svg",
      ],
      [
        "name" => "ETC/USDT",
        "percentage" => "86%",
        "assetType" => "crypto",
        "symbol" => "ETCUSDT",
        "image" => "etc.svg",
      ],
      [
        "name" => "ZEC/USDT",
        "percentage" => "94%",
        "assetType" => "crypto",
        "symbol" => "ZECUSDT",
        "image" => "zec.svg",
      ],
      [
        "name" => "ONT/USDT",
        "percentage" => "96%",
        "assetType" => "crypto",
        "symbol" => "ONTUSDT",
        "image" => "ont.svg",
      ],
      [
        "name" => "STX/USDT",
        "percentage" => "96%",
        "assetType" => "crypto",
        "symbol" => "STXUSDT",
        "image" => "stx.svg",
      ],
      [
        "name" => "MKR/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "MKRUSDT",
        "image" => "mkr.svg",
      ],
      [
        "name" => "AAVE/USDT",
        "percentage" => "90%",
        "assetType" => "crypto",
        "symbol" => "AAVEUSDT",
        "image" => "aave.svg",
      ],
      [
        "name" => "XMR/USDT",
        "percentage" => "99%",
        "assetType" => "crypto",
        "symbol" => "XMRUSDT",
        "image" => "xmr.svg",
      ],
      [
        "name" => "YFI/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "YFIUSDT",
        "image" => "yfi.svg",
      ],
    ];

    $weekdayTradingPair = [
      [
        "name" => "EUR/USD",
        "percentage" => "99%",
        "assetType" => "forex",
        "symbol" => "EURUSD",
        "image" => "EURUSD_OTC.svg",
      ],
      [
        "name" => "AUD/CAD",
        "percentage" => "96%",
        "assetType" => "forex",
        "symbol" => "AUDCAD",
        "image" => "AUDCAD.svg",
      ],
      [
        "name" => "GBP/USD",
        "percentage" => "85%",
        "assetType" => "forex",
        "symbol" => "GBPUSD",
        "image" => "GBPUSD_OTC.svg",
      ],
      [
        "name" => "GBP/NZD",
        "percentage" => "89%",
        "assetType" => "forex",
        "symbol" => "GBPNZD",
        "image" => "GBPNZD.svg",
      ],
      [
        "name" => "USD/JPY",
        "percentage" => "97%",
        "assetType" => "forex",
        "symbol" => "USDJPY",
        "image" => "USDJPY_OTC.svg",
      ],
      [
        "name" => "EUR/GBP",
        "percentage" => "95%",
        "assetType" => "forex",
        "symbol" => "EURGBP",
        "image" => "EURGBP.svg",
      ],
      [
        "name" => "GBP/CHF",
        "percentage" => "90%",
        "assetType" => "forex",
        "symbol" => "GBPCHF",
        "image" => "GBPCHF.svg",
      ],
      [
        "name" => "GBP/CAD",
        "percentage" => "88%",
        "assetType" => "forex",
        "symbol" => "GBPCAD",
        "image" => "GBPCAD.svg",
      ],
      [
        "name" => "NASDAQ",
        "percentage" => "92%",
        "assetType" => "forex",
        "symbol" => "NQ",
        "image" => "NQ.svg",
      ],
      [
        "name" => "AUD/JPY",
        "percentage" => "93%",
        "assetType" => "forex",
        "symbol" => "AUDJPY",
        "image" => "AUDJPY.svg",
      ],
      [
        "name" => "CAD/CHF",
        "percentage" => "77%",
        "assetType" => "forex",
        "symbol" => "CADCHF",
        "image" => "CADCHF.svg",
      ],
      [
        "name" => "CAD/JPY",
        "percentage" => "85%",
        "assetType" => "forex",
        "symbol" => "CADJPY",
        "image" => "CADJPY.svg",
      ],
      [
        "name" => "EUR/AUD",
        "percentage" => "97%",
        "assetType" => "forex",
        "symbol" => "EURAUD",
        "image" => "EURAUD.svg",
      ],
      [
        "name" => "EUR/JPY",
        "percentage" => "91%",
        "assetType" => "forex",
        "symbol" => "EURJPY",
        "image" => "EURJPY.svg",
      ],
      [
        "name" => "EUR/CAD",
        "percentage" => "99%",
        "assetType" => "forex",
        "symbol" => "EURCAD",
        "image" => "EURCAD.svg",
      ],
      [
        "name" => "GPB/JPY",
        "percentage" => "83%",
        "assetType" => "forex",
        "symbol" => "GBPJPY",
        "image" => "GBPJPY.svg",
      ],
      [
        "name" => "NZD/CAD",
        "percentage" => "90%",
        "assetType" => "forex",
        "symbol" => "NZDCAD",
        "image" => "NZDCAD.svg",
      ],
      [
        "name" => "NZD/CHF",
        "percentage" => "98%",
        "assetType" => "forex",
        "symbol" => "NZDCHF",
        "image" => "NZDCHF.svg",
      ],
      [
        "name" => "NZD/JPY",
        "percentage" => "95%",
        "assetType" => "forex",
        "symbol" => "NZDJPY",
        "image" => "NZDJPY.svg",
      ],
      [
        "name" => "USD/MXN",
        "percentage" => "95%",
        "assetType" => "forex",
        "symbol" => "USDMXN",
        "image" => "USDMXN.svg",
      ],
      [
        "name" => "USD/SGD",
        "percentage" => "98%",
        "assetType" => "forex",
        "symbol" => "USDSGD",
        "image" => "USDSGD.svg",
      ],
      [
        "name" => "NZD/USD",
        "percentage" => "96%",
        "assetType" => "forex",
        "symbol" => "NZDUSD",
        "image" => "NZDUSD_OTC.svg",
      ],
      [
        "name" => "USD/CHF",
        "percentage" => "91%",
        "assetType" => "forex",
        "symbol" => "USDCHF",
        "image" => "USDCHF_OTC.svg",
      ],
      [
        "name" => "AUD/CHF",
        "percentage" => "96%",
        "assetType" => "forex",
        "symbol" => "AUDCHF",
        "image" => "AUDCHF.svg",
      ],
      [
        "name" => "CHF/JPY",
        "percentage" => "99%",
        "assetType" => "forex",
        "symbol" => "CHFJPY",
        "image" => "CHFJPY.svg",
      ],
      [
        "name" => "BTC/USDT",
        "percentage" => "91%",
        "assetType" => "crypto",
        "symbol" => "BTCUSDT",
        "image" => "btc.svg",
      ],
      [
        "name" => "ETH/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "ETHUSDT",
        "image" => "eth.svg",
      ],
      [
        "name" => "LTC/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "LTCUSDT",
        "image" => "ltc.svg",
      ],
      [
        "name" => "SOL/USDT",
        "percentage" => "98%",
        "assetType" => "crypto",
        "symbol" => "SOLUSDT",
        "image" => "sol.svg",
      ],
      [
        "name" => "XRP/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "XRPUSDT",
        "image" => "xrp.svg",
      ],
      [
        "name" => "DOGE/USDT",
        "percentage" => "83%",
        "assetType" => "crypto",
        "symbol" => "DOGEUSDT",
        "image" => "doge.svg",
      ],
      [
        "name" => "BCH/USDT",
        "percentage" => "89%",
        "assetType" => "crypto",
        "symbol" => "BCHUSDT",
        "image" => "bch.svg",
      ],
      [
        "name" => "DAI/USDT",
        "percentage" => "97%",
        "assetType" => "crypto",
        "symbol" => "DAIUSDT",
        "image" => "dai.svg",
      ],
      [
        "name" => "BNB/USDT",
        "percentage" => "87%",
        "assetType" => "crypto",
        "symbol" => "BNBUSDT",
        "image" => "bnb.svg",
      ],
      [
        "name" => "ADA/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "ADAUSDT",
        "image" => "ada.svg",
      ],
      [
        "name" => "AVAX/USDT",
        "percentage" => "99%",
        "assetType" => "crypto",
        "symbol" => "AVAXUSDT",
        "image" => "avax.svg",
      ],
      [
        "name" => "TRX/USDT",
        "percentage" => "90%",
        "assetType" => "crypto",
        "symbol" => "TRXUSDT",
        "image" => "trx.svg",
      ],
      [
        "name" => "MATIC/USDT",
        "percentage" => "91%",
        "assetType" => "crypto",
        "symbol" => "MATICUSDT",
        "image" => "matic.svg",
      ],
      [
        "name" => "ATOM/USDT",
        "percentage" => "96%",
        "assetType" => "crypto",
        "symbol" => "ATOMUSDT",
        "image" => "atom.svg",
      ],
      [
        "name" => "LINK/USDT",
        "percentage" => "87%",
        "assetType" => "crypto",
        "symbol" => "LINKUSDT",
        "image" => "link.svg",
      ],
      [
        "name" => "DASH/USDT",
        "percentage" => "87%",
        "assetType" => "crypto",
        "symbol" => "DASHUSDT",
        "image" => "dash.svg",
      ],
      [
        "name" => "XLM/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "XLMUSDT",
        "image" => "xlm.svg",
      ],
      [
        "name" => "NEO/USDT",
        "percentage" => "93%",
        "assetType" => "crypto",
        "symbol" => "NEOUSDT",
        "image" => "neo.svg",
      ],
      [
        "name" => "BAT/USDT",
        "percentage" => "83%",
        "assetType" => "crypto",
        "symbol" => "BATUSDT",
        "image" => "bat.svg",
      ],
      [
        "name" => "ETC/USDT",
        "percentage" => "86%",
        "assetType" => "crypto",
        "symbol" => "ETCUSDT",
        "image" => "etc.svg",
      ],
      [
        "name" => "ZEC/USDT",
        "percentage" => "94%",
        "assetType" => "crypto",
        "symbol" => "ZECUSDT",
        "image" => "zec.svg",
      ],
      [
        "name" => "ONT/USDT",
        "percentage" => "96%",
        "assetType" => "crypto",
        "symbol" => "ONTUSDT",
        "image" => "ont.svg",
      ],
      [
        "name" => "STX/USDT",
        "percentage" => "96%",
        "assetType" => "crypto",
        "symbol" => "STXUSDT",
        "image" => "stx.svg",
      ],
      [
        "name" => "MKR/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "MKRUSDT",
        "image" => "mkr.svg",
      ],
      [
        "name" => "AAVE/USDT",
        "percentage" => "90%",
        "assetType" => "crypto",
        "symbol" => "AAVEUSDT",
        "image" => "aave.svg",
      ],
      [
        "name" => "XMR/USDT",
        "percentage" => "99%",
        "assetType" => "crypto",
        "symbol" => "XMRUSDT",
        "image" => "xmr.svg",
      ],
      [
        "name" => "YFI/USDT",
        "percentage" => "95%",
        "assetType" => "crypto",
        "symbol" => "YFIUSDT",
        "image" => "yfi.svg",
      ],
    ];

    $randomSeed = mt_rand(1, 20);

    $sentiment = $randomSeed % 2 === 0 ? "BUY" : "SELL";

    if (now()->isWeekday()) {
      $asset = rand(0, count($weekdayTradingPair) - 1);
      return [
        "ticker_symbol" => $weekdayTradingPair[$asset]["symbol"],
        "display_name" => $weekdayTradingPair[$asset]["name"],
        "asset_class" => $weekdayTradingPair[$asset]["assetType"],
        "image_url" =>
        "assets/icons/dashboard/" .
          $weekdayTradingPair[$asset]["image"],
        "sentiment" => $sentiment,
      ];
    } else {
      $asset = rand(0, count($weekendTradingPair) - 1);
      return [
        "ticker_symbol" => $weekendTradingPair[$asset]["symbol"],
        "display_name" => $weekendTradingPair[$asset]["name"],
        "asset_class" => $weekendTradingPair[$asset]["assetType"],
        "image_url" =>
        "assets/icons/dashboard/" .
          $weekendTradingPair[$asset]["image"],
        "sentiment" => $sentiment,
      ];
    }
  }

  public function selectStrategy(string $strategyId): void
  {
    $filtered = $this->strategies->filter(
      fn(Strategy $value) => $value["id"] === intval($strategyId),
    );

    $this->strategy = $filtered->first();
    $this->strategySlug = $this->strategy['name'];
    $this->calculateProfitExpected();
  }

  public function normalizeAmount(int $amount): int|float
  {
    return $amount / 100;
  }

  public function serializeAmount(float $amount): int
  {
    return $amount * 100;
  }

  /**
   * Generate profit values.
   */
  public function generateProfitValues($duration, $profitLimit)
  {
    $profitValues = [];

    $totalMinutesInDuration = ($duration * 60) / 5;

    for ($i = 0; $i < $totalMinutesInDuration; $i++) {
      $profitValues[] = mt_rand(0, 8000) / 1000;
    }

    $profitValuesSum = array_sum($profitValues);

    $normalizedProfitValues = [];

    foreach ($profitValues as $value) {
      $normalizedProfitValues[] = round(
        ($value / $profitValuesSum) * $profitLimit,
        2,
      );
    }

    return $normalizedProfitValues;
  }

  public function createRobot(): void
  {
    try {
      $amount = $this->serializeAmount(floatval($this->amount));
      $assetToTrade = $this->generateAssetToTrade();
      $profitLimit =
        (intval($this->strategy["max_roi"]) / 100) *
        $this->normalizeAmount($amount);
      $balanceToDebit =
        $this->accountTypeSlug === "demo"
        ? "demo_balance"
        : "live_balance";
      $currentBalance = auth()->user()->{$balanceToDebit};
      $newBalance = $currentBalance - $amount;

      DB::transaction(function () use (
        $amount,
        $newBalance,
        $profitLimit,
        $assetToTrade,
        $balanceToDebit,
      ) {
        Bot::create([
          "user_id" => auth()->user()->id,
          "amount" => $amount,
          "duration" => 5, // bots refresh in 5 min intervals
          "strategy" => $this->strategy["id"],
          "account_type" => $this->accountTypeSlug,
          "profit" => 0,
          "profit_values" => json_encode(
            $this->generateProfitValues(
              48,
              $profitLimit,
            ),
          ),
          "profit_position" => 0,
          "asset" => $assetToTrade["display_name"],
          "asset_class" => $assetToTrade["asset_class"],
          "asset_ticker" => $assetToTrade["ticker_symbol"],
          "asset_image_url" => $assetToTrade["image_url"],
          "sentiment" => $assetToTrade["sentiment"],
          "status" => "active",
          "timer_checkpoint" => strval(
            now()->addMinutes(5)->addSeconds(12)->getTimestampMs(),
          ),
          "duration_type" => $this->durationType,
          "start" => strval(now()->getTimestampMs()),
          "end" => strval(
            now()
              ->addHours(intval($this->strategy["duration"]))
              ->getTimestampMs(),
          ),
        ]);
        User::where("id", "=", auth()->user()->id, "and")->update([
          $balanceToDebit => $newBalance,
        ]);
      });

      session()->flash("message", "Robot has started trading");

      $this->redirectRoute("dashboard.robot.traderoom");
    } catch (\Exception $e) {
      $this->dispatch("robot-error", message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view('livewire.dashboard.robot-second-step');
  }
}
