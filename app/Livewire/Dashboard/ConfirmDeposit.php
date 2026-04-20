<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use App\Models\DepositIntent;
use App\Models\User;
use App\Notifications\DepositInitiated;
use App\Notifications\DepositIntentInitiated;
use App\Notifications\TransactionOccured;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Livewire\Component;

#[Layout("components.layouts.app")]
class ConfirmDeposit extends Component
{
  use WithFileUploads;

  #[Url]
  public $amount;

  #[Url]
  public $method;

  #[Url]
  public $address;

  #[Url]
  public $iconUrl;

  #[Url]
  public $slug;

  public $amountToPay;

  public $hasUserMadeTwoSuccessfulDeposits = false;

  public $screenshot;

  protected $rules = [
    "screenshot" => "required|file|mimes:jpeg,jpg,png|max:5120",
  ];

  protected $messages = [
    "screenshot.required" => "Please upload a screenshot of your payment.",
    "screenshot.file" => "The uploaded file is not valid.",
    "screenshot.mimes" => "ID document must be a JPEG, JPG or PNG file.",
    "screenshot.max" => "ID document size cannot exceed 5MB.",
  ];

  public function mount()
  {
    $this->amountToPay = $this->amount / 100;

    $confirmedCount = Deposit::where("user_id", "=", auth()->id(), "and")
      ->where("status", "confirmed")
      ->count();

    $this->hasUserMadeTwoSuccessfulDeposits = $confirmedCount >= 2;
  }

  public function back()
  {
    $this->redirect("/dashboard/deposit");
  }

  public function createDeposit()
  {
    try {
      $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
      $errors = $e->validator->errors()->all();
      $this->dispatch(
        "deposit-error",
        message: implode(" ", $errors),
      )->self();
      return;
    }

    try {
      Deposit::create([
        "user_id" => auth()->user()->id,
        "payment_method" => $this->method,
        "amount" => $this->amount,
        "payment_screenshot_path" => "payment-screenshot/" . $this->screenshot->getClientOriginalName(),
        "status" => "pending",
      ]);

      $this->screenshot->storeAs(
        path: "payment-screenshot",
        name: $this->screenshot->getClientOriginalName(),
      );

      /**
       * Send notifications to respective correspondents.
       */
      $user = User::find(auth()->user()->id, ["*"]);
      $user->notify(
        new DepositInitiated(
          auth()->user()->name,
          strval($this->amount / 100),
        ),
      );

      Notification::route("mail", "fredbest230@gmail.com")->notify(
        new TransactionOccured(
          "deposit",
          $user["name"],
          strval($this->amount / 100),
        ),
      );

      session()->flash(
        "message",
        "Deposit successful. You will receive an email when deposit has been confirmed.",
      );

      $this->redirectRoute("dashboard.transactions");
    } catch (\Exception $e) {
      $this->dispatch("deposit-error", message: $e->getMessage())->self();
    }
  }

  #[Renderless]
  public function storeDepositIntent()
  {
    try {
      DepositIntent::create([
        "user_id" => auth()->user()->id,
        "name" => auth()->user()->name,
        "amount" => $this->amount,
        "payment_method" => $this->method,
      ]);
    } catch (\Exception $e) {
      $this->dispatch("deposit-error", message: $e->getMessage())->self();
    }
  }

  public function formatAmountToPay()
  {
    return '$' . strval($this->amountToPay) . " USD";
  }

  public function render()
  {
    return view("livewire.dashboard.confirm-deposit");
  }
}
