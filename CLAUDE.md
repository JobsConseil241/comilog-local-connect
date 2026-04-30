# CLAUDE.md — Plateforme COMILOG × ANPI Local Connect

> Instructions de travail pour Claude Code sur ce projet.
> **Ces consignes complètent le CLAUDE.md global de l'utilisateur** (Git Flow, conventions de commit, audit). En cas de conflit, le global prime sauf override explicite ici.

---

## 1. Contexte produit

Plateforme numérique d'échanges interactifs dédiée aux PME Local Content gabonaises, mise en place par **COMILOG** (Groupe ERAMET) en partenariat avec l'**ANPI Gabon**.

- **Objectif principal** : donner aux PME locales la visibilité sur les opportunités d'affaires, formations et actualités SMI de COMILOG, segmentées par métier.
- **Cible** : PME cartographiées par l'ANPI (BTP, IT, Logistique, Restauration, Sécurité, Maintenance, etc.).
- **Document de cadrage de référence** : [docs/cadrage.md](docs/cadrage.md). **Toujours s'y référer** avant d'ajouter une fonctionnalité.

---

## 2. Stack technique

| Couche | Choix |
|---|---|
| Backend | **Laravel 11** (PHP 8.2) |
| Auth | **Laravel Breeze (Blade)** |
| Front | **Blade + Tailwind CSS 3 + Alpine.js** |
| DB DEV | **MySQL 5.7 (MAMP)** — socket : `/Applications/MAMP/tmp/mysql/mysql.sock` |
| DB PROD | MySQL 8 (à préciser à la mise en prod) |
| Mail | SMTP (Mailtrap en DEV) |
| Tests | PHPUnit |
| Stockage | `storage/app/public` + symlink (`php artisan storage:link`) |

### Commandes essentielles
```bash
# Dev (MAMP doit tourner pour MySQL sur port 8889)
php artisan serve                       # http://127.0.0.1:8000
npm run dev                             # Vite (Tailwind)

# Migrations & seeds
php artisan migrate:fresh --seed

# Tests
php artisan test

# Cache (à vider après modif config)
php artisan optimize:clear
```

### Connexion MAMP MySQL (`.env`)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=comilog_anpi
DB_USERNAME=root
DB_PASSWORD=root
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
```

---

## 3. Identité visuelle (Design System)

**À respecter strictement dans toutes les vues.**

### Couleurs (définies dans `tailwind.config.js`)
| Token | Hex | Usage |
|---|---|---|
| `navy.DEFAULT` (Deep Navy COMILOG) | `#0A2240` | **Couleur principale** — header, boutons primaires, titres clés |
| `navy.dark` | `#061833` | Hover boutons primaires |
| `navy.light` | `#1B3358` | Surfaces sombres alternatives |
| `manganese.DEFAULT` (Accent) | `#D97706` | Accent (CTA secondaires, badges importants) |
| `success` | `#15803D` | États succès |
| `danger` | `#B91C1C` | États erreur |
| `slate-50` | `#F8FAFC` | Fond général |

### Typographie
- Police : **Inter** (chargée via Google Fonts ou bunny.net en self-host)
- Titres : `font-bold tracking-tight`
- Corps : `font-normal text-slate-700`

### Composants — règles
- **Boutons primaires** : `bg-navy text-white hover:bg-navy-dark rounded-md shadow-sm`
- **Cartes** : `bg-white rounded-xl border border-slate-200 shadow-sm`
- **Badges métier** : pastilles colorées arrondies (`rounded-full`)
- **Forms** : labels en `text-slate-700 text-sm font-medium`, inputs avec ring `focus:ring-navy`
- **Pas d'emojis** dans les UI sauf si demande explicite

---

## 4. Organisation du code

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Back-office COMILOG/ANPI
│   │   ├── Pme/            # Espace PME
│   │   └── Public/         # Landing, inscription
│   ├── Middleware/
│   │   └── EnsureUserHasRole.php
│   └── Requests/           # Form Requests (validation)
├── Models/                 # Eloquent (Pme, Opportunity, Training, News, BusinessCategory)
├── Notifications/          # Notifications email (NewOpportunityNotification, etc.)
└── Services/               # Logique métier réutilisable

resources/views/
├── layouts/
│   ├── app.blade.php       # Layout authentifié (sidebar)
│   ├── public.blade.php    # Layout public (header simple)
│   └── admin.blade.php     # Layout admin (sidebar admin)
├── public/                 # Pages publiques
├── pme/                    # Vues espace PME
├── admin/                  # Vues back-office
└── components/             # Composants Blade réutilisables (x-button, x-card, etc.)

database/
├── migrations/
├── seeders/
│   └── DemoSeeder.php     # Données de démo (catégories, admin, PMEs)
└── factories/
```

---

## 5. Règles métier importantes

- **Rôles utilisateur** : `admin_comilog`, `admin_anpi`, `pme`. Stockés dans `users.role`.
- **Une PME = un compte utilisateur** rattaché (FK `users.pme_id`). Plusieurs contacts par PME viendront en V1.1.
- **Validation PME obligatoire** : à l'inscription, `pmes.status = 'pending'`. Un admin doit valider pour passer à `'active'`. Tant que `pending`, le user ne peut pas se connecter à l'espace PME.
- **Filtrage par métier** : une opportunité est liée à N catégories métier (`opportunity_business_category`). Une PME ne voit que les opportunités dont **au moins une catégorie correspond** à ses propres catégories.
- **Statuts opportunité** : `draft`, `published`, `closed`. Seules les `published` (et `deadline >= today`) sont visibles côté PME.
- **Notifications** : à chaque opportunité passant en `published`, déclencher l'envoi mail aux PME ciblées (queue Laravel).

---

## 6. Conventions de code

### PHP / Laravel
- **PSR-12** (Laravel Pint configuré)
- **Form Requests** pour toute validation entrée (jamais de validation inline dans contrôleur)
- **Single Responsibility** : contrôleurs maigres, logique dans Services ou Models
- **Eloquent relations** explicites et nommées (`pme()`, `categories()`, `opportunities()`)
- **Pas de query Eloquent dans les Blade** — toujours passer par le contrôleur
- **Routes nommées** systématiquement (`route('admin.opportunities.index')`)

### Blade
- Composants Blade (`<x-card>`, `<x-button>`) plutôt que duplication
- `@csrf` obligatoire sur tout formulaire POST
- Échappement par défaut (`{{ }}`), `{!! !!}` interdit sauf cas validé

### Naming
- Tables : pluriel snake_case (`opportunities`, `business_categories`)
- Models : singulier PascalCase (`Opportunity`, `BusinessCategory`)
- Routes : kebab-case en URL, snake_case en nom (`route('admin.business-categories.store')`)
- Vars Blade : snake_case

### Langues
- **Code, commits, identifiants techniques** : anglais
- **Interface utilisateur (Blade, messages flash, libellés)** : français
- **Documentation projet (docs/, README, ce CLAUDE.md)** : français

---

## 7. Sécurité (rappels critiques)

- **Jamais** de SQL brut sans bindings → toujours Query Builder ou Eloquent
- **CSRF actif partout** (ne jamais désactiver `VerifyCsrfToken` sans raison documentée)
- **Authorization** : middleware `role:admin_comilog|admin_anpi` ou Policies Laravel
- **Validation stricte** des uploads (mime, taille max, dossier dédié)
- **Hash bcrypt** par défaut Laravel — ne pas modifier
- **Rate limiting** sur `/login`, `/inscription`, `/forgot-password`
- **Logs d'audit** sur les actions admin sensibles (suppression, validation PME)
- **Variables d'env sensibles** : jamais commit `.env`, toujours utiliser `config('xxx')`
- **Pas de logs de mots de passe** ou tokens

---

## 8. Tests

- **Feature tests** sur les parcours critiques :
  - Inscription PME → validation admin → connexion
  - Admin publie opportunité BTP → PME BTP la voit, PME IT non
  - Filtrage opportunités par métier
- **Unit tests** sur les services métier (filtrage, calcul KPI)
- **Avant tout merge** : `php artisan test` doit passer

---

## 9. Git Flow (rappel)

Suit les règles du **CLAUDE.md global** :
- Branches : `feat/...`, `fix/...`, `chore/...` depuis `develop`
- Commits conventionnels en anglais : `feat(opportunities): add metier filter`
- **Jamais** de `--signoff`, `-S`, `Co-Authored-By` dans les commits
- **Jamais** de force-push sur `main` / `master` / `develop`
- PR vers `develop` (staging), puis `develop` → `main` (production)

---

## 10. À faire / pas faire

### À faire
- Toujours consulter [docs/cadrage.md](docs/cadrage.md) avant d'ajouter une feature
- Respecter le design system (deep navy `#0A2240` partout)
- Écrire des migrations idempotentes et des seeders rejouables
- Documenter les décisions d'architecture importantes dans `docs/`
- Préférer éditer un fichier existant plutôt que d'en créer un nouveau

### À ne pas faire
- Pas de framework JS lourd (React/Vue) sur le MVP — Blade + Alpine suffit
- Pas de dépendances NPM/Composer non justifiées
- Pas de fichiers Markdown documentaires sans demande explicite
- Pas de commentaires de code superflus (le code doit s'auto-documenter)
- Pas de fonctionnalités hors-périmètre MVP sans validation explicite

---

## 11. Contacts & ressources externes (à compléter)

- Charte graphique COMILOG officielle : *à fournir*
- Logo COMILOG haute déf : *à fournir*
- Logo ANPI : *à fournir*
- Contact référent COMILOG Local Content : *à compléter*
- Contact référent ANPI : *à compléter*
