<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Url;
use Livewire\Component;

class WithdrawAddressStep extends Component
{
    #[Url]
    public $amount;

    #[Url]
    public $method;

    #[Url]
    public $iconUrl;

    #[Url]
    public $slug;

    public string $address = "";

    public function confirmWithdraw()
    {
        try {
            if ($this->address === "") {
                $this->dispatch(
                    "withdraw-error",
                    message: "Address field is empty",
                )->self();
                return;
            }

            $queryParams = http_build_query([
                "amount" => $this->amount,
                "method" => $this->method,
                "address" => $this->address,
                "iconUrl" => $this->iconUrl,
                "slug" => $this->slug,
            ]);

            $this->redirect("/dashboard/withdraw/confirm?$queryParams");
        } catch (\Exception $e) {
            $this->dispatch(
                "withdraw-error",
                message: $e->getMessage(),
            )->self();
        }
    }

    public function render()
    {
        return view("livewire.dashboard.withdraw-address-step");
    }
}
