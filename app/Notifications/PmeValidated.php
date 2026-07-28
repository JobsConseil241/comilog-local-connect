<?php

namespace App\Notifications;

use App\Models\Pme;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PmeValidated extends Notification
{
    use Queueable;

    public function __construct(public Pme $pme)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre PME est validée · COMILOG Local Connect')
            ->view('emails.pme-validated', [
                'raisonSociale' => $this->pme->raison_sociale,
                'representantNom' => $this->pme->representant_nom,
            ]);
    }
}
