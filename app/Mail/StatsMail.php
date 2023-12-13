<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $totalArticles;
    protected $totalComments;

    public function __construct($totalArticles, $totalComments)
    {
        $this->totalArticles = $totalArticles;
        $this->totalComments = $totalComments;
    }

    public function build() 
    {
        return $this->from(env('MAIL_USERNAME'))
                    ->to('alexeevanton@internet.ru')
                    ->with([
                        'totalArticles' => $this->totalArticles,
                        'totalComments' => $this->totalComments,
                    ])
                    ->view('mail.stats');
    }
}
