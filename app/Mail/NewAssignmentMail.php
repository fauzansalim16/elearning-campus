<?php

namespace App\Mail;

use App\Models\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Assignment $assignment)
    {
    }

    public function build(): self
    {
        return $this->subject('Tugas Baru: '.$this->assignment->title)
            ->text('emails.assignment_new_plain');
    }
}



