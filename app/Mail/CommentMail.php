<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Comment;

class CommentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function build() 
    {
        return $this->from(env('MAIL_USERNAME'))
                    ->to('alexeevanton@internet.ru')
                    ->with('comment', $this->comment)
                    ->view('mail.comment');
    }
}
