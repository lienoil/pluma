<?php

namespace User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use User\Mail\ResetPasswordLink;

class ResetPasswordNotification extends Notification
{
    use Queueable, SerializesModels;

    /**
     * The token to validate against.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
                ->view("Theme::emails.reset.index", [
                    'token' => $this->token,
                    'email' => $notifiable->email,
                    'url' => route('password.token', [$this->token, 'email' => $notifiable->email])
                ]);
    }
}
