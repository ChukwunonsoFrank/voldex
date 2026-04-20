<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.app")]
class History extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalBots;

    public function mount()
    {
        $this->totalBots = Bot::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )->count();
        $this->visibleCount = min($this->perPage, $this->totalBots);
    }

    public function displayProfitMinusFee($profit)
    {
        $fee = intval(round($profit * (5 / 100)));
        $displayProfit = $profit - $fee;
        return $displayProfit / 100;
    }

    public function loadMore(): void
    {
        $this->visibleCount = min(
            $this->visibleCount + $this->perPage,
            $this->totalBots,
        );
    }

    public function render()
    {
        $bots = Bot::where("user_id", "=", auth()->user()->id, "and")
            ->latest()
            ->take($this->visibleCount)
            ->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalBots;

        return view("livewire.dashboard.history", [
            "bots" => $bots,
            "showLoadMoreButton" => $showLoadMoreButton,
        ]);
    }
}
