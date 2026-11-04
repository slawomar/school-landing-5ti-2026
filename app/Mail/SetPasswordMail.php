<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ustaw swoje hasło do konta',
        );
    }

    public function content(): Content
    {
        // Link prowadzący do formularza ustawiania hasła w Twojej aplikacji
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->user->email,
        ], false));

        return new Content(
            markdown: 'emails.set-password', // Widok Blade
            with: [
                'url' => $url,
                'name' => $this->user->name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
