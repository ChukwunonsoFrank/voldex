<?php

namespace App\Livewire\Admin;

use App\Models\Strategy;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout("components.layouts.admin")]
class AdminStrategyDetails extends Component
{
    use WithFileUploads;

    #[Url]
    public $id;

    public string $name = "";

    public string $duration = "";

    public string $minimumAmount = "";

    public string $maximumAmount = "";

    public string $minimumROI = "";

    public string $maximumROI = "";

    public string $previousImageUrl = "";

    public $image;

    public function updateStrategy(int $strategyId)
    {
        try {
            Strategy::where("id", "=", $strategyId, "and")->update([
                "name" => $this->name,
                "min_amount" => $this->minimumAmount,
                "max_amount" => $this->maximumAmount,
                "min_roi" => $this->minimumROI,
                "max_roi" => $this->maximumROI,
                "image_url" => $this->image
                    ? "strategy-image/" . $this->image->getClientOriginalName()
                    : $this->previousImageUrl,
                "duration" => $this->duration,
            ]);

            if ($this->image) {
                $this->image->storeAs(
                    path: "strategy-image",
                    name: $this->image->getClientOriginalName(),
                );
            }

            session()->flash(
                "success-message",
                "Strategy updated successfully",
            );
        } catch (\Exception $e) {
            session()->flash("error-message", $e->getMessage());
        }
    }

    public function render()
    {
        $strategy = Strategy::where("id", "=", $this->id, "and")->first();

        $this->name = $strategy["name"];
        $this->minimumAmount = $strategy["min_amount"];
        $this->maximumAmount = $strategy["max_amount"];
        $this->minimumROI = $strategy["min_roi"];
        $this->maximumROI = $strategy["max_roi"];
        $this->duration = $strategy["duration"];
        $this->previousImageUrl = $strategy["image_url"];

        return view("livewire.admin.admin-strategy-details");
    }
}
