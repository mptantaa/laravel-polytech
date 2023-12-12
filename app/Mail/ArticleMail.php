<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class ArticleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $article;
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function build() 
    {
        return $this->from(env('MAIL_USERNAME'))
                    ->to('alexeevanton@internet.ru')
                    ->with('article', $this->article)
                    ->view('mail.article');
    }
}
