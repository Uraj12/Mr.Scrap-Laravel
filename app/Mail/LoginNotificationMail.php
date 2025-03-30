<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ip;
    public $time;

    public function __construct($user, $ip, $time)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->time = $time;
    }

    public function build()
    {
        return $this->subject('Login Notification - Mr. Scrap')
                    ->markdown('emails.login-notification')
                    ->with([
                        'user' => $this->user,
                        'ip' => $this->ip,
                        'time' => $this->time
                    ]);
    }
}
