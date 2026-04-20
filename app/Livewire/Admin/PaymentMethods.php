<?php

namespace App\Livewire\Admin;

use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout("components.layouts.admin")]
class PaymentMethods extends Component
{
    use WithFileUploads;

    public string $name = "";

    public string $address = "";

    public string $slug = "";

    public $image;

    public function createNewPaymentMethod()
    {
        try {
            PaymentMethod::create([
                "name" => $this->name,
                "slug" => $this->slug,
                "address" => $this->address,
                "icon_url" =>
                    "payment-method-icon/" .
                    $this->image->getClientOriginalName(),
            ]);

            $this->image->storeAs(
                "payment-method-icon",
                $this->image->getClientOriginalName(),
                "public",
            );

            session()->flash(
                "success-message",
                "Payment method created successfully",
            );
        } catch (\Exception $e) {
            session()->flash("error-message", $e->getMessage());
        }
    }

    public function destroyStrategy(int $methodId)
    {
        try {
            PaymentMethod::destroy($methodId);
            session()->flash(
                "success-message",
                "Payment method deleted successfully",
            );
        } catch (\Exception $e) {
            session()->flash("error-message", $e->getMessage());
        }
    }

    public function render()
    {
        $paymentMethods = PaymentMethod::all();
        return view("livewire.admin.payment-methods", [
            "paymentMethods" => $paymentMethods,
        ]);
    }
}
