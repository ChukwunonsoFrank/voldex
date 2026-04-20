<?php

namespace App\Livewire\Dashboard;

use App\Models\PaymentMethod;
use App\Models\Withdrawal;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("components.layouts.app")]
class WithdrawHistory extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalWithdrawals;

    public $paymentMethods;

    public function mount()
    {
        if (session()->has("message")) {
            $message = session()->get("message");
            $this->dispatch("withdrawal-created", message: $message)->self();
        }

        $this->paymentMethods = PaymentMethod::all();
        $this->totalWithdrawals = Withdrawal::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )->count();
        $this->visibleCount = min($this->perPage, $this->totalWithdrawals);
    }

    public function loadMore(): void
    {
        $this->visibleCount = min(
            $this->visibleCount + $this->perPage,
            $this->totalWithdrawals,
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
        $withdrawals = Withdrawal::where(
            "user_id",
            "=",
            auth()->user()->id,
            "and",
        )
            ->latest()
            ->take($this->visibleCount)
            ->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalWithdrawals;

        return view("livewire.dashboard.withdraw-history", [
            "withdrawals" => $withdrawals,
            "showLoadMoreButton" => $showLoadMoreButton,
        ]);
    }
}
