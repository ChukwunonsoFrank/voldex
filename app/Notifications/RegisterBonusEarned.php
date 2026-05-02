<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterBonusEarned extends Notification implements ShouldQueue
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
            ->greeting('Hi '.$this->name.',')
            ->line('Welcome to Voldex Global!')
            ->line('A registration bonus of $'.$this->amount.' has been added to your account.');
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
