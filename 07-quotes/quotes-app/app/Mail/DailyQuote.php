<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyQuote extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $quote,
        public string $author
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Daily Motivational Quote',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily-quote',
        );
    }
} 