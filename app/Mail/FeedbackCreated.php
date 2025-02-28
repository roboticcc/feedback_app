<?php

namespace App\Mail;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Feedback $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function build(): FeedbackCreated
    {
        return $this->view('emails.feedback_created')
            ->with('feedback', $this->feedback);
    }
}

