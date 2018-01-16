<?php

namespace User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The token to validate against.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new event instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("Theme::emails.reset.index")->with([
            'token' => $this->token,
            'url' => route('password.token', $this->token)
        ]);
    }
}
