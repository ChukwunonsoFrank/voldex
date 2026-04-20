<?php

namespace App\Livewire\Dashboard;

use App\Models\Trade;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout("components.layouts.app")]
class HistoryDetails extends Component
{
    #[Url]
    public $id;

    public $perPage = 10;

    public $visibleCount;

    public $totalTrades;

    public function mount()
    {
        $this->totalTrades = Trade::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )
            ->where("bot_id", "=", $this->id, "and")
            ->count();
        $this->visibleCount = min($this->perPage, $this->totalTrades);
    }

    public function loadMore(): void
    {
        $this->visibleCount = min(
            $this->visibleCount + $this->perPage,
            $this->totalTrades,
        );
    }

    public function getAssetClass($asset)
    {
        $pairs = [
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

        $collection = collect($pairs);

        $searchedPair = $collection->firstWhere("name", $asset);

        if ($searchedPair) {
            return $searchedPair["assetType"];
        } else {
            return "Missing";
        }
    }

    public function render()
    {
        $trades = Trade::with("bot")
            ->where(["user_id" => auth()->user()->id, "bot_id" => $this->id])
            ->latest()
            ->take($this->visibleCount)
            ->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalTrades;

        return view("livewire.dashboard.history-details", [
            "trades" => $trades,
            "showLoadMoreButton" => $showLoadMoreButton,
        ]);
    }
}
