<?php

namespace App\Notifications;

use App\Models\Pme;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PmeRejected extends Notification
{
    use Queueable;

    public function __construct(public Pme $pme, public ?string $motif = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Votre demande d'inscription · COMILOG Local Connect")
            ->view('emails.pme-rejected', [
                'raisonSociale' => $this->pme->raison_sociale,
                'representantNom' => $this->pme->representant_nom,
                'motif' => $this->motif,
            ]);
    }
}
