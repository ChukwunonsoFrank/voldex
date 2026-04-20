<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionOccured extends Notification implements ShouldQueue
{
  use Queueable;

  public $tries = 5;

  public $backoff = [10, 30, 60];

  /**
   * Create a new notification instance.
   */
  public function __construct(public string $type, public string $username = '', public string $amount = '',) {}

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
      ->subject($this->type === 'deposit' ? 'Deposit Notification' : 'Withdrawal Request')
      ->greeting("Hi Admin User,")
      ->line($this->username . " made a " . $this->type . " of $" . $this->amount)
      ->line("Login to the admin dashboard to confirm this action.");
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
