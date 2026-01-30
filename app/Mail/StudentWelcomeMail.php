<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentWelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $student;
    public $password;

    public function __construct(Student $student, $password)
    {
        $this->student  = $student;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Student Login – Smart Hostel')
            ->view('emails.student-welcome');
    }
}