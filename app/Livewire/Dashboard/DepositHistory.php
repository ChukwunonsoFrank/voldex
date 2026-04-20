<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.app")]
class DepositHistory extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalDeposits;

    public $paymentMethods;

    public function mount()
    {
        if (session()->has("message")) {
            $message = session()->get("message");
            $this->dispatch("deposit-created", message: $message)->self();
        }

        $this->paymentMethods = PaymentMethod::all();
        $this->totalDeposits = Deposit::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )->count();
        $this->visibleCount = min($this->perPage, $this->totalDeposits);
    }

    public function loadMore(): void
    {
        $this->visibleCount = min(
            $this->visibleCount + $this->perPage,
            $this->totalDeposits,
        );
    }

    public function getPaymentMethodIconUrl(string $paymentMethod): string
    {
        $filtered = $this->paymentMethods->filter(
            fn(PaymentMethod $value) => $value["name"] === $paymentMethod,
        );

        return $filtered->first()["icon_url"];
    }

    public function getStatusIndicatorColor(string $status)
    {
        if ($status === "pending") {
            return "bg-yellow-600";
        }

        if ($status === "approved") {
            return "bg-green-600";
        }

        if ($status === "declined") {
            return "bg-red-600";
        }
    }

    public function render()
    {
        $deposits = Deposit::where("user_id", "=", auth()->user()->id, "and")
            ->latest()
            ->take($this->visibleCount)
            ->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalDeposits;

        return view("livewire.dashboard.deposit-history", [
            "deposits" => $deposits,
            "showLoadMoreButton" => $showLoadMoreButton,
        ]);
    }
}
