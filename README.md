# COMILOG Local Connect

> Plateforme numérique d'échanges interactifs dédiée aux PME Local Content gabonaises, mise en place par **COMILOG** (Groupe ERAMET).

Connectez-vous, recevez les opportunités d'affaires ciblées par votre métier, accédez aux formations et restez informés des évolutions du SMI COMILOG.

---

## Aperçu

- **Annuaire PME** segmenté par métier (BTP, Logistique, IT, Maintenance, Sécurité, Restauration, etc.)
- **Opportunités d'affaires** filtrées automatiquement selon les métiers de chaque PME
- **Centre de formation** (HSE, IRMA, qualification fournisseur)
- **Actualités SMI** publiées par les équipes COMILOG
- **Back-office d'administration** avec validation manuelle des inscriptions et tableau de bord KPI

## Stack technique

| Couche | Choix |
|---|---|
| Backend | Laravel 11 (PHP 8.2) |
| Auth | Laravel Breeze (Blade) |
| Front | Blade + Tailwind CSS 3 + Alpine.js |
| DB | MySQL 5.7 (DEV) / MySQL 8 (PROD) |
| Mail | SMTP |
| Tests | PHPUnit |

## Démarrage rapide

### Prérequis
- PHP 8.2
- Composer 2.x
- Node.js 18+
- MySQL 5.7+ (ou MAMP en local)

### Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/JobsConseil241/comilog-local-connect.git
cd comilog-local-connect

# 2. Installer les dépendances
composer install
npm install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base dans .env puis :
php artisan migrate --seed

# 5. Compiler les assets
npm run build

# 6. Lancer
php artisan serve
```

### Configuration `.env`

```env
APP_NAME="COMILOG Local Connect"
APP_LOCALE=fr
APP_TIMEZONE=Africa/Libreville

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=comilog_anpi
DB_USERNAME=root
DB_PASSWORD=
```

### Comptes de démonstration (après seed)

| Rôle | Email | Mot de passe |
|---|---|---|
| Admin COMILOG | `admin@comilog.local` | `password` |
| PME (BTP) | `pme.btp@local.test` | `password` |
| PME (IT) | `pme.gabon@local.test` | `password` |

## Documentation

- [Document de cadrage](docs/cadrage.md)
- [Instructions de développement](CLAUDE.md)

## Architecture

```
app/
├── Http/Controllers/
│   ├── Admin/        # Back-office COMILOG
│   ├── Pme/          # Espace PME
│   └── Public/       # Landing, inscription
├── Models/           # Eloquent (Pme, Opportunity, Training, News, BusinessCategory)
└── Http/Middleware/  # EnsureUserHasRole (RBAC)

resources/views/
├── layouts/          # public, portal (PME+Admin), guest (auth)
├── public/           # Pages publiques
├── pme/              # Espace PME
└── admin/            # Back-office
```

## Tests

```bash
php artisan test
```

## Workflow git

- `main` : production
- `develop` : staging / intégration
- `feat/*`, `fix/*`, `chore/*` : branches de travail

Commits conventionnels : `feat(scope): description`.

## Licence

Propriété de **COMILOG — Groupe ERAMET**. Tous droits réservés.
