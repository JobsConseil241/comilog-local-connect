<?php

namespace App\Console\Commands;

use App\Models\Opportunity;
use App\Models\Pme;
use App\Models\User;
use App\Notifications\NewOpportunityDigest;
use App\Notifications\NewOpportunityPublished;
use App\Notifications\PmeInscriptionReceived;
use App\Notifications\PmeInterestExpressed;
use App\Notifications\PmeRejected;
use App\Notifications\PmeValidated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class TestAllEmails extends Command
{
    protected $signature = 'mail:test-all
        {email : Adresse destinataire des mails de test}
        {--only= : Ne tester qu\'un seul type (inscription|validated|rejected|opportunity|digest|interest)}';

    protected $description = "Envoie les 6 emails transactionnels à une adresse pour vérifier l'intégration Resend / le rendu HTML.";

    public function handle(): int
    {
        $email = $this->argument('email');
        $only = $this->option('only');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("Adresse email invalide : {$email}");
            return self::FAILURE;
        }

        $this->newLine();
        $this->info("→ Envoi des emails de test à : {$email}");
        $this->line('   Mailer actif : ' . config('mail.default') . ' (from ' . config('mail.from.address') . ')');
        $this->newLine();

        // Sample data
        $opp = Opportunity::published()->with('categories')->first();
        if (! $opp) {
            $this->error('Aucune opportunité publiée en base — lance `php artisan db:seed` d\'abord.');
            return self::FAILURE;
        }

        $catIds = $opp->categories->pluck('id')->all();

        $pmeMatch = Pme::query()
            ->where('status', Pme::STATUS_ACTIVE)
            ->whereHas('categories', fn ($q) => $q->whereIn('business_categories.id', $catIds))
            ->with('categories', 'users')
            ->first();

        $pmeOther = Pme::query()
            ->where('status', Pme::STATUS_ACTIVE)
            ->whereDoesntHave('categories', fn ($q) => $q->whereIn('business_categories.id', $catIds))
            ->with('categories', 'users')
            ->first();

        // Fallback si pas de PME dispo dans les deux cas
        $pmeMatch = $pmeMatch ?: Pme::where('status', Pme::STATUS_ACTIVE)->with('categories', 'users')->first();
        $pmeOther = $pmeOther ?: $pmeMatch;

        if (! $pmeMatch) {
            $this->error('Aucune PME active en base — lance `php artisan db:seed` d\'abord.');
            return self::FAILURE;
        }

        $pmeUser = $pmeMatch->users->first() ?? User::where('role', User::ROLE_PME)->first();
        if (! $pmeUser) {
            $this->error('Aucun user PME en base.');
            return self::FAILURE;
        }

        $this->line('   Data de test :');
        $this->line("     · Opportunité : {$opp->reference} — " . mb_strimwidth($opp->titre, 0, 60, '…'));
        $this->line("     · PME match   : {$pmeMatch->raison_sociale}");
        $this->line("     · PME digest  : {$pmeOther->raison_sociale}");
        $this->line("     · User PME    : {$pmeUser->name} <{$pmeUser->email}>");
        $this->newLine();

        $notifications = [
            'inscription' => [
                'label' => "Accusé d'inscription  (PmeInscriptionReceived)",
                'notif' => fn () => new PmeInscriptionReceived($pmeMatch, $pmeUser->email),
            ],
            'validated' => [
                'label' => 'Compte validé          (PmeValidated)',
                'notif' => fn () => new PmeValidated($pmeMatch),
            ],
            'rejected' => [
                'label' => 'Rejet avec motif       (PmeRejected)',
                'notif' => fn () => new PmeRejected($pmeMatch, 'Test de motif : dossier RCCM incomplet, à compléter avant re-soumission.'),
            ],
            'opportunity' => [
                'label' => 'Opportunité ciblée     (NewOpportunityPublished)',
                'notif' => fn () => new NewOpportunityPublished($opp, $pmeMatch),
            ],
            'digest' => [
                'label' => 'Opportunité digest     (NewOpportunityDigest)',
                'notif' => fn () => new NewOpportunityDigest($opp, $pmeOther),
            ],
            'interest' => [
                'label' => 'Notif admin — intérêt  (PmeInterestExpressed)',
                'notif' => fn () => new PmeInterestExpressed($opp, $pmeMatch, $pmeUser),
            ],
        ];

        if ($only) {
            if (! isset($notifications[$only])) {
                $this->error("Type inconnu : {$only}. Valides : " . implode(', ', array_keys($notifications)));
                return self::FAILURE;
            }
            $notifications = [$only => $notifications[$only]];
        }

        $success = 0;
        $failed = 0;

        foreach ($notifications as $key => $item) {
            $this->line("   [{$key}] {$item['label']}");
            try {
                // notifyNow bypass la queue même pour les notifications ShouldQueue
                Notification::route('mail', $email)->notifyNow($item['notif']());
                $this->info("        ✓ envoyé");
                $success++;
            } catch (\Throwable $e) {
                $this->error("        ✗ échec : " . $e->getMessage());
                $failed++;
            }
        }

        $this->newLine();
        $this->line("   Résultat : {$success} envoyé(s), {$failed} échec(s)");
        $this->newLine();

        $mailer = config('mail.default');
        if ($mailer === 'log') {
            $this->comment("→ MAIL_MAILER=log — les emails ne partent PAS sur le réseau.");
            $this->comment("  Ils sont écrits dans storage/logs/laravel.log.");
            $this->comment("  Pour un envoi réel : mettre MAIL_MAILER=resend + RESEND_KEY=re_xxx dans .env.");
        } elseif ($mailer === 'resend') {
            $this->comment("→ MAIL_MAILER=resend — envoi via l'API Resend.");
            $this->comment("  Vérifier :");
            $this->comment("    1. La boîte de réception de {$email}");
            $this->comment("    2. Le dashboard Resend → Logs (https://resend.com/logs)");
            $this->comment("  Si aucun mail n'arrive : DNS jobs-conseil.host validé sur Resend + clé API correcte.");
        } else {
            $this->comment("→ Mailer actif : {$mailer}");
        }
        $this->newLine();

        return $failed === 0 ? self::SUCCESS : self::FAILURE;
    }
}
