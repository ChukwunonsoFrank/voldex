<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WithdrawalInitiated extends Notification implements ShouldQueue
{
  use Queueable;

  public $tries = 5;

  public $backoff = [10, 30, 60];

  /**
   * Create a new notification instance.
   */
  public function __construct(public string $name, public string $amount)
  {
    //
  }

  /**
   * Determine which queues should be used for each notification channel.
   *
   * @return array<string, string>
   */
  public function viaQueues(): array
  {
    return [
      'mail' => 'notifications',
    ];
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject('Pending Withdrawal')
      ->greeting("Hi " . $this->name . ',')
      ->line("You just made a withdrawal of $" . $this->amount . ".")
      ->line("Your withdrawal is being processed on the blockchain and will be confirmed shortly.");
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
