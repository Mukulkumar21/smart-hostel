<?php

namespace App\Mail;

use App\Models\Warden;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WardenWelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $warden;
    public $password;

    public function __construct(Warden $warden, $password)
    {
        $this->warden = $warden;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Warden Login – Smart Hostel')
            ->view('emails.warden-welcome');
    }
}