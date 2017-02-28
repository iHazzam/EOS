<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreated extends Notification
{
    use Queueable;
    private $password;
    private $username;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('EOS@playdale.me')
                    ->subject('Welcome to Playdale EOS')
                    ->line('Welcome to the Playdale Export Order System - our new way to process orders')
                    ->action('Please login to your new account at', url('/'))
                    ->line('Your username and password are:'  )
                    ->line('Username: ' . $this->username)
                    ->line('Password: '. $this->password);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
