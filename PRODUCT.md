# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

**Primaire — Représentant·e de PME Local Content gabonaise.** Dirigeant·e ou contact commercial d'une PME cartographiée dans l'écosystème d'achats de COMILOG (BTP, logistique, IT, maintenance, sécurité, restauration, nettoyage, fournitures…), souvent basé·e à Moanda (Haut-Ogooué) ou dans le Haut-Ogooué. Situation de connexion internet variable, usage mobile fréquent depuis le terrain. Job : identifier vite les opportunités d'affaires et formations qui correspondent à ses métiers, sans devoir filtrer un fil bruité.

**Secondaire — Administrateur·rice COMILOG.** Chargé·e Local Content / achats responsables de COMILOG. Travaille depuis un bureau, sur ordinateur. Job : publier opportunités, formations et actualités SMI ; valider ou rejeter les nouvelles inscriptions PME ; consulter les KPI consolidés pour le reporting institutionnel (rapports IRMA, audits internes ERAMET, exigences ministérielles).

## Product Purpose

Réduire l'asymétrie d'information entre COMILOG et l'écosystème des PME Local Content gabonaises, en structurant un canal officiel où les opportunités d'affaires, les formations et les évolutions du Système de Management Intégré (SMI) circulent de manière ciblée par métier.

Le succès se mesure à la **capacité de reporting institutionnel** : nombre de PME actives par métier, nombre d'opportunités publiées, répartition géographique et sectorielle — chiffres consolidés utilisables dans les rapports IRMA, audits ERAMET et documents de conformité à la Loi minière gabonaise n°037/2018.

## Positioning

Plateforme officielle opérée directement par COMILOG (Groupe ERAMET) pour son propre écosystème Local Content au Gabon. Ce n'est pas un annuaire fournisseur générique : chaque publication provient des équipes achats/Local Content COMILOG, et le filtrage par métier garantit qu'une PME ne reçoit que ce qui relève strictement de son secteur.

Le mécanisme différenciateur qu'aucun portail concurrent ne peut copier honnêtement : ancrage dans la politique d'achats responsables du Groupe ERAMET, alignement sur le standard IRMA (Initiative for Responsible Mining Assurance), et conformité à la Loi n°037/2018 portant réglementation du secteur minier en République Gabonaise.

## Operating Context

**Cycle utilisateur PME.**
1. Découverte de la plateforme (bouche-à-oreille, ANPI, campagne COMILOG).
2. Inscription auto-serve sur `/inscription` : identité entreprise (raison sociale, RCCM, NIF, ville, contact), représentant légal, sélection multi-métiers, création compte.
3. Validation manuelle par un admin COMILOG sous 48h ouvrées (email de confirmation ou de rejet avec motif).
4. Accès à l'espace privé : dashboard, liste des opportunités filtrée sur les métiers de la PME, formations, actualités SMI, édition du profil.
5. Notification email automatique à chaque nouvelle opportunité correspondant à au moins un métier de la PME.
6. La candidature elle-même s'effectue **hors plateforme**, via le contact indiqué sur chaque opportunité (email/nom du référent achats).

**Cycle admin COMILOG.**
- Publication CRUD : opportunités (draft/published/closed), formations, actualités SMI, catégories métier.
- Validation PME (bouton unique) ou rejet motivé.
- Dashboard KPI : nombre de PME actives, en attente, opportunités publiées sur 30j, répartition PME × métier, dernières inscriptions.

**Environnements.** Développement local sous MAMP (MySQL 5.7/8). Production sur Hostinger, hébergée à `jobs-conseil.host`. Locale unique : français (Africa/Libreville). Pas de multi-langue prévue pour cette version.

## Capabilities and Constraints

**Confirmé et livré.**
- Auth Laravel Breeze (Blade) avec rôles `admin_comilog` et `pme` (middleware RBAC).
- Inscription PME auto-serve avec validation manuelle (statuts : `pending` / `active` / `suspended` / `rejected`).
- Catalogue de catégories métier éditable par admin, couleur personnalisable.
- CRUD opportunités avec ciblage multi-métiers, types : appel d'offres / consultation / devis / manifestation d'intérêt, référence auto `COM-YYYY-NNNN`.
- CRUD formations et actualités SMI.
- Filtrage automatique côté PME : une opportunité n'est visible que si au moins une de ses catégories intersecte celles de la PME.
- Notifications email transactionnelles via Resend : accusé d'inscription, validation, rejet (avec motif), alerte nouvelle opportunité (queue Laravel `ShouldQueue`).
- Champ téléphone international via `intl-tel-input` (Gabon par défaut, format E.164 en base).
- Dashboard KPI admin.
- Responsive complet (drawer mobile pour nav publique et sidebar portail, typographie fluide, back-to-top).

**Non-fonctionnalités volontaires du MVP.**
- Pas de candidature en ligne (les PME candidatent hors plateforme sur les coordonnées de l'opportunité).
- Pas de forum ni de messagerie interne PME↔PME ou PME↔admin (prévu V1.1 selon cadrage).
- Pas de multi-langue.
- Pas d'API publique.

**Terminologie interne.**
- « PME » = Petite ou Moyenne Entreprise du tissu Local Content gabonais.
- « Métier » = catégorie business (`business_categories`), utilisée pour tagger PME et opportunités.
- « SMI » = Système de Management Intégré COMILOG (certifié ISO 9001 / 14001 / 45001).
- « Local Content » = mécanisme réglementaire imposant l'intégration d'entreprises locales dans la chaîne de valeur minière.
- « IRMA » = Initiative for Responsible Mining Assurance.
- Référence opportunité : `COM-{année}-{séquence 4 chiffres}`.

**Décidé mais différé.**
- **Import CSV ANPI** : le partenariat ANPI est en pause à l'affichage public mais peut réapparaître comme source de cartographie (import automatisé). La colonne `pmes.imported_from_anpi` est déjà en place ; l'UI et la copy publique ne l'exposent plus.

## Brand Commitments

- **Nom produit :** COMILOG Local Connect.
- **Marque parente :** COMILOG, filiale du Groupe ERAMET.
- **Logo officiel :** `public/images/comilog-logo.png` (lockup ERAMET-COMILOG orange/jaune sur fond blanc — proportions et couleurs à préserver, ne jamais recolorer).
- **Voix :** institutionnelle, factuelle, française professionnelle. Zéro emoji dans les surfaces produit. Copy sobre — la plateforme parle au nom de COMILOG, pas d'un blog corporate. Pas de superlatifs marketing ni de langue promotionnelle exagérée.
- **Partenariat ANPI :** en pause à l'affichage public. Ne pas mentionner sans validation explicite. La plomberie technique (colonne DB, imports futurs) reste possible.
- **Domaine expéditeur email :** `no-reply@jobs-conseil.host` (à ajuster quand un domaine `@comilog.*` sera provisionné en prod).

## Evidence on Hand

- **Cadrage produit initial :** [docs/cadrage.md](docs/cadrage.md).
- **Instructions techniques :** [CLAUDE.md](CLAUDE.md), [AGENTS.md](AGENTS.md).
- **README dépôt :** [README.md](README.md).
- **Données seeder démo :** 8 catégories métier réelles, 5 PMEs fictives (dont 1 en attente de validation), 5 opportunités fictives, 2 formations réalistes (HSE Niveau 1, IRMA), 2 actualités SMI (mise à jour SMI 2026, politique achats responsables ERAMET).
- **Assets marque :** logo ERAMET-COMILOG (`public/images/comilog-logo.png`).

**Absences à ne pas fabriquer sans validation.**
- Aucun vrai témoignage de PME ni d'admin COMILOG à ce stade. La landing en contient trois écrits pour la démo — à remplacer par du réel avant lancement officiel, ou à retirer.
- Aucune vraie opportunité, formation ou actualité — le contenu actuel est illustratif.
- Aucun chiffre officiel (# PMEs cartographiées par ANPI, budget Local Content COMILOG, tonnage manganèse Moanda) : ne jamais inventer.
- Aucun contact opérationnel COMILOG (email, téléphone, adresse Moanda) confirmé pour la copy publique.
- Aucun engagement contractuel visible sur le partenariat ANPI actuellement.

## Product Principles

1. **Le filtrage par métier n'est pas négociable.** Une PME ne voit et ne reçoit *jamais* une opportunité hors de ses métiers. Toute exception à cette règle doit être explicitement demandée par un admin.
2. **Validation humaine avant activation.** L'inscription n'ouvre pas l'accès automatiquement — un admin COMILOG valide chaque compte. Ce contrôle qualité est un actif, pas une friction à supprimer.
3. **Traçabilité pour le reporting institutionnel.** Chaque donnée qui compte pour un rapport IRMA ou un audit ERAMET doit être requêtable en une jointure : catégories métier, statuts PME, dates de publication, historique de validation.
4. **Mobile n'est pas un cas dégradé.** Les PME consultent souvent depuis le terrain avec une connexion instable. Les surfaces PME doivent être aussi lisibles à 375px qu'à 1440px, sans scroll horizontal ni navigation cachée.
5. **La plateforme parle au nom de COMILOG, pas d'un blog.** Ton institutionnel, factuel, français professionnel. Toute copy ambigüe entre « communication corporate » et « portail opérationnel » doit se ranger côté portail.

## Accessibility & Inclusion

Standard cible : **WCAG 2.1 niveau AA**. Ce standard est cohérent avec les exigences de la plupart des appels d'offres institutionnels et audits ERAMET.

Points d'attention connus, non-encore audités :
- Contrastes texte/fond sur les surfaces sombres (sidebar dark, footer navy, hero) — à vérifier systématiquement.
- Focus visible sur tous les contrôles interactifs, y compris les composants Alpine (drawers, modales).
- Étiquettes ARIA sur les icônes-seules (burger, bell, logout).
- Support du zoom navigateur jusqu'à 200% sans perte de fonctionnalité.
- Navigation clavier complète, y compris fermeture drawer par `Escape`.
- Support `prefers-reduced-motion` (déjà déclaré globalement dans `resources/css/app.css`).
- Locale unique française — pas d'ARIA multi-langue à gérer pour cette version.
