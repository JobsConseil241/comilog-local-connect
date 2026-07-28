<?php

namespace App\Notifications;

use App\Models\Opportunity;
use App\Models\Pme;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOpportunityPublished extends Notification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(public Opportunity $opportunity, public Pme $pme)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle opportunité · ' . $this->opportunity->titre)
            ->view('emails.new-opportunity', [
                'opportunity' => $this->opportunity->loadMissing('categories'),
                'raisonSociale' => $this->pme->raison_sociale,
            ]);
    }
}
