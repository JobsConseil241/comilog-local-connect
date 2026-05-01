<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\News;
use App\Models\Opportunity;
use App\Models\Pme;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'BTP & Génie civil', 'color' => '#0A2240'],
            ['name' => 'Logistique & Transport', 'color' => '#1B3358'],
            ['name' => 'IT & Télécoms', 'color' => '#2C4978'],
            ['name' => 'Maintenance industrielle', 'color' => '#D97706'],
            ['name' => 'Sécurité & Gardiennage', 'color' => '#B45309'],
            ['name' => 'Restauration & Catering', 'color' => '#15803D'],
            ['name' => 'Nettoyage & Hygiène', 'color' => '#0E7490'],
            ['name' => 'Fournitures de bureau', 'color' => '#7C3AED'],
        ])->map(fn ($c) => BusinessCategory::updateOrCreate(
            ['slug' => Str::slug($c['name'])],
            [
                'name' => $c['name'],
                'color' => $c['color'],
                'is_active' => true,
            ]
        ));

        $adminComilog = User::updateOrCreate(
            ['email' => 'admin@comilog.local'],
            [
                'name' => 'Admin COMILOG',
                'password' => 'password',
                'role' => User::ROLE_ADMIN_COMILOG,
                'email_verified_at' => now(),
            ]
        );

        collect([
            ['raison' => 'BTP Moanda Construction', 'cats' => ['btp-genie-civil', 'maintenance-industrielle']],
            ['raison' => 'TransLog Haut-Ogooué', 'cats' => ['logistique-transport']],
            ['raison' => 'Gabon Tech Services', 'cats' => ['it-telecoms']],
            ['raison' => 'Sécurité Plus Sarl', 'cats' => ['securite-gardiennage']],
            ['raison' => 'Saveurs du Gabon', 'cats' => ['restauration-catering']],
        ])->each(function ($p) use ($categories) {
            $pme = Pme::firstOrCreate(
                ['raison_sociale' => $p['raison']],
                [
                    'rccm' => 'RCCM-GA-' . strtoupper(Str::random(6)),
                    'nif' => 'NIF-' . strtoupper(Str::random(8)),
                    'ville' => 'Moanda',
                    'telephone' => '+241 0' . random_int(1, 7) . ' ' . random_int(10, 99) . ' ' . random_int(10, 99) . ' ' . random_int(10, 99),
                    'email_contact' => 'contact@' . Str::slug($p['raison']) . '.local',
                    'representant_nom' => 'Représentant ' . explode(' ', $p['raison'])[0],
                    'representant_fonction' => 'Gérant',
                    'description' => 'PME locale spécialisée dans son domaine, basée à Moanda.',
                    'status' => Pme::STATUS_ACTIVE,
                    'imported_from_anpi' => true,
                    'validated_at' => now()->subDays(random_int(1, 30)),
                ]
            );

            $catIds = $categories->whereIn('slug', $p['cats'])->pluck('id')->all();
            $pme->categories()->sync($catIds);

            User::updateOrCreate(
                ['email' => 'pme.' . Str::slug(explode(' ', $p['raison'])[0]) . '@local.test'],
                [
                    'name' => $pme->representant_nom,
                    'password' => 'password',
                    'role' => User::ROLE_PME,
                    'pme_id' => $pme->id,
                    'email_verified_at' => now(),
                ]
            );
        });

        Pme::firstOrCreate(
            ['rccm' => 'RCCM-GA-PEND01'],
            [
                'raison_sociale' => 'Nouvelle PME en attente',
                'ville' => 'Franceville',
                'email_contact' => 'demande@nouvellepme.local',
                'representant_nom' => 'Jean Dupont',
                'representant_fonction' => 'Directeur',
                'description' => "Demande d'inscription en cours de validation.",
                'status' => Pme::STATUS_PENDING,
            ]
        );

        $opportunities = [
            ['titre' => "Construction d'un hangar de stockage à Moanda", 'type' => 'appel_offres', 'cats' => ['btp-genie-civil'], 'budget' => '120 000 000 - 180 000 000 XAF', 'deadline' => now()->addDays(20)],
            ['titre' => 'Maintenance préventive flotte véhicules légers', 'type' => 'consultation', 'cats' => ['maintenance-industrielle', 'logistique-transport'], 'budget' => '50 000 000 XAF / an', 'deadline' => now()->addDays(15)],
            ['titre' => "Fourniture et installation d'un réseau Wi-Fi sur site minier", 'type' => 'appel_offres', 'cats' => ['it-telecoms'], 'budget' => '85 000 000 XAF', 'deadline' => now()->addDays(35)],
            ['titre' => 'Prestation de gardiennage 24/7 — site industriel Bangombé', 'type' => 'consultation', 'cats' => ['securite-gardiennage'], 'budget' => '180 000 000 XAF / an', 'deadline' => now()->addDays(10)],
            ['titre' => 'Catering équipes minières — 250 repas / jour', 'type' => 'devis', 'cats' => ['restauration-catering'], 'budget' => 'À évaluer', 'deadline' => now()->addDays(25)],
        ];

        foreach ($opportunities as $i => $opp) {
            $reference = 'COM-' . now()->year . '-' . str_pad((string) ($i + 1), 4, '0', STR_PAD_LEFT);

            $o = Opportunity::firstOrCreate(
                ['reference' => $reference],
                [
                    'titre' => $opp['titre'],
                    'description' => "Dans le cadre de sa politique d'achats responsables et du contenu local, COMILOG lance la présente consultation. Les PME locales intéressées et qualifiées sont invitées à manifester leur intérêt.\n\nLes candidatures doivent être adressées à l'adresse de contact indiquée ci-dessous, accompagnées des pièces justificatives habituelles (RCCM, NIF, références techniques).",
                    'type' => $opp['type'],
                    'deadline' => $opp['deadline'],
                    'budget_estime' => $opp['budget'],
                    'lieu_execution' => 'Moanda, Haut-Ogooué',
                    'contact_email' => 'achats.local@comilog.local',
                    'contact_nom' => 'Service Achats Local Content',
                    'status' => Opportunity::STATUS_PUBLISHED,
                    'published_at' => now()->subDays(random_int(0, 5)),
                    'created_by' => $adminComilog->id,
                ]
            );

            $catIds = $categories->whereIn('slug', $opp['cats'])->pluck('id')->all();
            $o->categories()->sync($catIds);
        }

        Training::firstOrCreate(
            ['titre' => 'Hygiène, Sécurité et Environnement (HSE) — Niveau 1'],
            [
                'description' => 'Formation initiale aux exigences HSE COMILOG pour les sous-traitants. Obligatoire pour intervenir sur site.',
                'date_debut' => now()->addDays(14),
                'date_fin' => now()->addDays(15),
                'lieu' => 'Centre de formation COMILOG, Moanda',
                'places_disponibles' => 25,
                'contact_email' => 'formation@comilog.local',
                'status' => Training::STATUS_PUBLISHED,
                'published_at' => now()->subDay(),
                'created_by' => $adminComilog->id,
            ]
        );

        Training::firstOrCreate(
            ['titre' => 'Comprendre le standard IRMA pour les PME fournisseurs'],
            [
                'description' => "Atelier d'acculturation au référentiel IRMA (Initiative for Responsible Mining Assurance) appliqué à la chaîne d'approvisionnement.",
                'date_debut' => now()->addDays(30),
                'lieu' => 'Visio + présentiel Libreville',
                'places_disponibles' => 50,
                'contact_email' => 'formation@comilog.local',
                'status' => Training::STATUS_PUBLISHED,
                'published_at' => now(),
                'created_by' => $adminComilog->id,
            ]
        );

        News::updateOrCreate(
            ['slug' => 'mise-a-jour-smi-2026'],
            [
                'titre' => 'Mise à jour du SMI COMILOG : nouvelles exigences pour les sous-traitants',
                'extrait' => 'Le Système de Management Intégré de COMILOG évolue. Découvrez les principales nouveautés impactant les PME locales.',
                'contenu' => "Le Système de Management Intégré (SMI) de COMILOG, certifié ISO 9001 / 14001 / 45001, fait l'objet d'une mise à jour majeure en 2026.\n\nLes principales évolutions concernant les PME locales :\n\n- Renforcement des exigences HSE pour les interventions sur site\n- Nouveau processus de qualification fournisseur\n- Démarche d'audit fournisseur renforcée\n\nUne session d'information sera organisée prochainement.",
                'tags' => ['SMI', 'Qualification', 'HSE'],
                'published_at' => now()->subDays(2),
                'created_by' => $adminComilog->id,
            ]
        );

        News::updateOrCreate(
            ['slug' => 'politique-achats-responsables-2026'],
            [
                'titre' => "Politique d'achats responsables ERAMET : focus Local Content",
                'extrait' => "COMILOG décline la politique groupe ERAMET et renforce son engagement en faveur des PME locales du Haut-Ogooué.",
                'contenu' => "Dans le cadre de sa politique d'achats responsables, le Groupe ERAMET s'engage à contribuer au développement local des écosystèmes dans lesquels il opère.\n\nÀ COMILOG, cela se traduit par une procédure dédiée favorisant l'achat local et la mise en place de cette plateforme numérique pour structurer les échanges avec les PME du tissu local.",
                'tags' => ['ERAMET', 'Local Content', 'Achats responsables'],
                'published_at' => now()->subWeek(),
                'created_by' => $adminComilog->id,
            ]
        );
    }
}
