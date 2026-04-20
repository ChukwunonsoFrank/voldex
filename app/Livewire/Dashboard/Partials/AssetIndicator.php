<?php

namespace App\Livewire\Dashboard\Partials;

use App\Models\Bot;
use Livewire\Attributes\On;
use Livewire\Component;

class AssetIndicator extends Component
{
    public $activeBot;

    public string $assetImageUrl = "";

    public string $asset = "";

    public string $assetClass = "";

    public bool $isBotActive = false;

    public function mount()
    {
        $this->activeBot = Bot::where("user_id", "=", auth()->user()->id, "and")
            ->where("status", "=", "active", "and")
            ->first();

        if ($this->activeBot) {
            $this->assetImageUrl = $this->activeBot["asset_image_url"];
            $this->asset = $this->activeBot["asset"];
            $this->assetClass = $this->activeBot["asset_class"];
            $this->isBotActive = true;
        } else {
            $this->assetImageUrl = "assets/logomark.png";
            $this->asset = "No data";
            $this->assetClass = "No data";
            $this->isBotActive = false;
        }
    }

    #[On("asset-updated")]
    public function assetUpdated($data)
    {
        $this->assetImageUrl = $data["assetImageUrl"];
        $this->asset = $data["asset"];
        $this->assetClass = $data["assetClass"];
        $this->isBotActive = $data["isBotActive"];
    }

    public function render()
    {
        return view("livewire.dashboard.partials.asset-indicator");
    }
}
