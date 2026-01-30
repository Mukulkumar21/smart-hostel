<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentAccountCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $password;

    public function __construct(Student $student, $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Smart Hostel Login Details')
            ->view('emails.student-account-created');
    }
}