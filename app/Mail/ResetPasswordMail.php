<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Reset Password CanyoKuy')
                    ->view('emails.reset-password')
                    ->with([
                        'resetLink' => route('admin.reset-password.form', ['token' => $this->token]),
                        'email' => $this->email
                    ]);
    }
}