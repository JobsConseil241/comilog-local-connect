<?php

namespace App\Notifications;

use App\Models\Opportunity;
use App\Models\Pme;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PmeInterestExpressed extends Notification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public Opportunity $opportunity,
        public Pme $pme,
        public User $pmeUser,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Intérêt PME sur {$this->opportunity->reference} · {$this->pme->raison_sociale}")
            ->view('emails.pme-interest-expressed', [
                'opportunity' => $this->opportunity->loadMissing('categories'),
                'pme' => $this->pme->loadMissing('categories'),
                'pmeUser' => $this->pmeUser,
            ]);
    }
}
