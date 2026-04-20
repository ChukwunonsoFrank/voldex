<?php

namespace App\Livewire\Admin;

use App\Models\Kyc;
use App\Models\User;
use App\Notifications\KYCApproved;
use App\Notifications\KYCDeclined;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout("components.layouts.admin")]
class AdminKycDetails extends Component
{
    #[Url]
    public $id;

    public $kycRequest;

    public string $fullname;

    public string $country;

    public string $idImagePath;

    public string $status;

    public function mount()
    {
        $this->kycRequest = Kyc::with("user")->where("id", $this->id)->first();

        $this->fullname = $this->kycRequest["fullname"];
        $this->country = $this->kycRequest["country"];
        $this->idImagePath = $this->kycRequest["id_image_path"];
        $this->status = $this->kycRequest["status"];
    }

    public function getStatusIndicatorColor(string $status)
    {
        if ($status === "pending") {
            return "bg-warning-50 text-warning-600";
        }

        if ($status === "approved") {
            return "bg-success-50 text-success-600";
        }

        if ($status === "declined") {
            return "bg-error-50 text-error-600";
        }
    }

    public function approveRequest()
    {
        try {
            $user = User::where(
                "id",
                "=",
                $this->kycRequest->user->id,
                "and",
            )->first();

            DB::transaction(function () use ($user) {
                User::where("id", "=", $user["id"], "and")->update([
                    "is_kyc_verified" => true,
                ]);
                Kyc::where("id", "=", $this->id, "and")->update([
                    "status" => "approved",
                ]);
            });

            $this->status = "approved";

            $user->notify(new KYCApproved($user->name));

            session()->flash(
                "success-message",
                "Request approved successfully",
            );
        } catch (\Exception $e) {
            session()->flash("error-message", $e->getMessage());
        }
    }

    public function declineRequest()
    {
        try {
            $user = User::where(
                "id",
                "=",
                $this->kycRequest->user->id,
                "and",
            )->first();

            DB::transaction(function () use ($user) {
                User::where("id", "=", $user["id"], "and")->update([
                    "is_kyc_verified" => false,
                ]);
                Kyc::where("id", "=", $this->id, "and")->update([
                    "status" => "declined",
                ]);
            });

            $this->status = "declined";

            $user->notify(new KYCDeclined($user->name));

            session()->flash(
                "success-message",
                "Request declined successfully",
            );
        } catch (\Exception $e) {
            session()->flash("error-message", $e->getMessage());
        }
    }

    public function render()
    {
        return view("livewire.admin.admin-kyc-details");
    }
}
