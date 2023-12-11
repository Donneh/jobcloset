<?php

namespace App\Mail;

use App\Models\UserInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserInvited extends Mailable
{
    use Queueable, SerializesModels;

    public string $inviteUrl;
    /**
     * Create a new message instance.
     */
    public function __construct(UserInvite $invite)
    {
        $this->inviteUrl = url('/invited/' . $invite->token);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "You've been invited to join " . auth()->user()->tenant->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.user-invite',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
