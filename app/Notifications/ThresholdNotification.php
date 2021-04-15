<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThresholdNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param string $symbol
     * @param string $rate
     */
    public function __construct(private string $symbol, private string $rate)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $symbol = $this->symbol;
        $rate = $this->rate;
        return (new MailMessage)
            ->subject('Threshold Notification')
            ->line("$symbol is now $rate")
            ->action('Got to App', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
