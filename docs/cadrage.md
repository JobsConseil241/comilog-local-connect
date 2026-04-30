# Plateforme COMILOG × ANPI — Document de cadrage

**Version :** 0.1 (MVP)
**Date :** 2026-04-26
**Maître d'ouvrage :** COMILOG (Groupe ERAMET) en partenariat avec l'ANPI Gabon
**Cible :** PME Local Content gabonaises cartographiées par l'ANPI

---

## 1. Vision produit

Une plateforme numérique simple, sécurisée et accessible, dédiée à la mise en relation entre **COMILOG** et les **PME locales** :
- centraliser les **opportunités d'affaires**, **formations** et **actualités SMI** ;
- segmenter l'information par **métier** (le BTP ne voit que le BTP) ;
- favoriser l'**accès aux marchés** et la **montée en compétences** des PME locales ;
- mesurer l'impact via des **KPI** consolidés.

> *Slogan de travail : « COMILOG Local Connect — Ensemble, faisons grandir le tissu local. »*

---

## 2. Personas

| Persona | Description | Besoins clés |
|---|---|---|
| **Admin COMILOG** | Acheteur / chargé Local Content COMILOG | Publier opportunités, formations, actualités SMI ; modérer ; consulter KPI |
| **Admin ANPI** | Référent ANPI | Valider les inscriptions PME ; consulter le registre ; exporter |
| **Représentant PME** | Dirigeant ou contact PME local content | S'inscrire, recevoir les opportunités de son métier, candidater, échanger |
| **Visiteur** | Public, autres acteurs | Découvrir le dispositif, demander une inscription |

---

## 3. Périmètre fonctionnel

### 3.1 MVP (V1.0 — livrable initial)

#### Module Public
- Landing page COMILOG/ANPI (présentation du dispositif Local Content)
- Formulaire de **demande d'inscription PME** (validation par admin)
- Authentification (login / mot de passe oublié)

#### Module PME (espace privé)
- Tableau de bord personnel : opportunités récentes filtrées par métier
- Profil entreprise (raison sociale, RCCM, NIF, métiers, contacts, documents)
- Liste des opportunités d'affaires (filtrées par métier inscrit)
- Liste des formations disponibles
- Fil d'actualités SMI
- Notifications email à chaque nouvelle opportunité ciblée

#### Module Admin (back-office)
- Validation / rejet des inscriptions PME
- CRUD opportunités d'affaires (titre, description, métiers ciblés, deadline, pièces jointes)
- CRUD formations (titre, description, dates, places, lieu)
- CRUD actualités SMI
- Gestion des catégories métier
- Dashboard KPI

#### Module KPI
- Nb PME inscrites (total + sur période)
- Nb opportunités publiées (total + sur période + par métier)
- Nb formations publiées
- Nb candidatures déposées
- Taux de PME actives (connexion < 30j)

### 3.2 V1.1 (post-MVP — non bloquant)
- Espace de discussion / forum par communauté métier
- Notifications push / SMS
- Candidature en ligne avec dépôt de dossier
- Export PDF / Excel des KPI
- Multi-langue (FR / EN)

### 3.3 V2 (évolution)
- API ouverte ANPI ↔ COMILOG (synchronisation registre PME)
- Intégration avec le SI achats COMILOG
- Module évaluation fournisseur

---

## 4. Modèle de données (MVP)

```
┌─────────────────┐         ┌──────────────────────┐
│      users      │         │  business_categories │
├─────────────────┤         ├──────────────────────┤
│ id              │         │ id                   │
│ name            │         │ name (BTP, IT, ...)  │
│ email           │         │ slug                 │
│ password        │         │ description          │
│ role (admin/    │         └──────────────────────┘
│  pme/anpi)      │                    │
│ pme_id (FK)     │                    │ M:N
└────────┬────────┘                    │
         │ 1:1 (si role=pme)           │
         ▼                             ▼
┌──────────────────────────┐    ┌────────────────────────┐
│          pmes            │◄──►│ pme_business_category  │
├──────────────────────────┤    │       (pivot)          │
│ id                       │    └────────────────────────┘
│ raison_sociale           │
│ rccm                     │           ┌──────────────────────────┐
│ nif                      │           │     opportunities        │
│ ville                    │           ├──────────────────────────┤
│ telephone                │           │ id                       │
│ email_contact            │           │ titre                    │
│ status (pending/active/  │           │ description              │
│   suspended)             │           │ type (marche/AO/devis)   │
│ created_by_anpi (bool)   │           │ deadline                 │
│ validated_at             │           │ budget_estime            │
│ validated_by (FK users)  │           │ contact_email            │
└──────────────────────────┘           │ piece_jointe (path)      │
                                       │ status (draft/published/ │
                                       │  closed)                 │
                                       │ published_at             │
                                       │ created_by (FK users)    │
                                       └────────────┬─────────────┘
                                                    │ M:N
                                                    ▼
                                       ┌────────────────────────────┐
                                       │ opportunity_business_cat   │
                                       │         (pivot)            │
                                       └────────────────────────────┘

┌────────────────────────┐    ┌─────────────────────────┐    ┌────────────────────────┐
│      trainings         │    │      news (SMI)         │    │     notifications      │
├────────────────────────┤    ├─────────────────────────┤    ├────────────────────────┤
│ id                     │    │ id                      │    │ id (uuid)              │
│ titre                  │    │ titre                   │    │ user_id (FK)           │
│ description            │    │ contenu                 │    │ type (opp/training/    │
│ date_debut             │    │ couverture (path)       │    │  news)                 │
│ date_fin               │    │ tags (json)             │    │ data (json)            │
│ lieu                   │    │ published_at            │    │ read_at                │
│ places_disponibles     │    │ created_by (FK users)   │    │ created_at             │
│ status                 │    └─────────────────────────┘    └────────────────────────┘
│ created_by (FK users)  │
└────────────────────────┘
```

### Tables MVP
1. `users` (admin COMILOG, admin ANPI, représentant PME)
2. `pmes`
3. `business_categories` (BTP, IT, Logistique, Restauration, Sécurité, Maintenance, ...)
4. `pme_business_category` (pivot)
5. `opportunities`
6. `opportunity_business_category` (pivot)
7. `trainings`
8. `news`
9. `notifications` (table standard Laravel)

---

## 5. Sitemap

```
/                         → Landing publique
/inscription              → Formulaire de demande PME
/login                    → Connexion
/forgot-password          → Reset

[PME — préfixe /pme]
/pme/dashboard            → Dashboard personnel
/pme/profil               → Profil entreprise (édition)
/pme/opportunites         → Liste des opportunités (filtrées métier)
/pme/opportunites/{id}    → Détail opportunité
/pme/formations           → Liste des formations
/pme/actualites           → Fil SMI
/pme/notifications        → Centre de notifications

[Admin — préfixe /admin]
/admin/dashboard          → KPI
/admin/pmes               → Gestion PME (validation, listing)
/admin/opportunites       → CRUD opportunités
/admin/formations         → CRUD formations
/admin/actualites         → CRUD actualités
/admin/categories         → Gestion catégories métier
/admin/utilisateurs       → Gestion utilisateurs
```

---

## 6. Wireframes textuels (clé)

### 6.1 Landing publique
```
┌────────────────────────────────────────────────────────────┐
│  [LOGO COMILOG]  COMILOG Local Connect    [Connexion] [+] │
├────────────────────────────────────────────────────────────┤
│  ┌──────────────────────────────────────────────────────┐ │
│  │   HERO — Deep Navy fond, texte blanc                 │ │
│  │   "Ensemble, faisons grandir le Local Content"       │ │
│  │   [ Demander mon inscription PME ]                   │ │
│  └──────────────────────────────────────────────────────┘ │
│                                                            │
│  3 colonnes :                                              │
│  [Opportunités d'affaires] [Formations] [Actualités SMI]   │
│                                                            │
│  Section "Comment ça marche ?" (3 étapes)                  │
│  Section "Partenaire ANPI"                                 │
│  Footer COMILOG / ANPI / Mentions                          │
└────────────────────────────────────────────────────────────┘
```

### 6.2 Dashboard PME
```
┌────────────────────────────────────────────────────────────┐
│  [LOGO]   PME : Sté X                  [🔔 3] [Profil ⌄]  │
├──────────┬─────────────────────────────────────────────────┤
│ Sidebar  │  Bonjour {prénom} 👋                            │
│ ▸ Dash   │  ┌──────────────────┐ ┌──────────────────────┐ │
│ ▸ Opp    │  │ 5 nouvelles opp  │ │ 2 formations à venir │ │
│ ▸ Form   │  │ pour BTP / Logi  │ │                      │ │
│ ▸ News   │  └──────────────────┘ └──────────────────────┘ │
│ ▸ Profil │                                                 │
│          │  Dernières opportunités (filtrées métier)       │
│          │  ─────────────────────────────────────────      │
│          │  • Construction hangar Moanda — deadline 15/05  │
│          │  • Maintenance véhicules — deadline 20/05       │
│          │  ...                                            │
└──────────┴─────────────────────────────────────────────────┘
```

### 6.3 Back-office Admin — Liste opportunités
```
┌────────────────────────────────────────────────────────────┐
│  [Admin COMILOG]                       [+ Nouvelle opp.]  │
├────────────────────────────────────────────────────────────┤
│  Filtres : [Métier ▾] [Statut ▾] [Période ▾] [🔍 Recherche]│
├────────────────────────────────────────────────────────────┤
│  TITRE              │ MÉTIERS    │ STATUT   │ DEADLINE │ . │
│  ─────────────────────────────────────────────────────────  │
│  Construction hangar│ BTP        │ Publié   │ 15/05    │⋮ │
│  Maintenance véhic. │ Auto, Méca │ Brouillon│ —        │⋮ │
└────────────────────────────────────────────────────────────┘
```

---

## 7. Identité visuelle — Design System

### 7.1 Couleurs
- **Primaire (Deep Navy COMILOG)** : `#0A2240`
- **Primaire foncé (hover)** : `#061833`
- **Primaire clair (surfaces)** : `#1B3358`
- **Accent (Manganèse)** : `#D97706` (orange terre, rappel du minerai)
- **Succès** : `#15803D`
- **Erreur** : `#B91C1C`
- **Neutres** : gris Tailwind (slate)
- **Fond** : `#F8FAFC` (slate-50)

### 7.2 Typographie
- **Titres** : Inter (700)
- **Corps** : Inter (400 / 500)
- **Système** : sans-serif fallback

### 7.3 Composants
- Boutons : `rounded-md`, ombre douce, primaire navy
- Cartes : `rounded-xl`, bordure `slate-200`, ombre `sm`
- Badges métier : pastilles colorées par catégorie

---

## 8. Stack technique

| Couche | Choix | Justification |
|---|---|---|
| Backend | **Laravel 11** (PHP 8.2) | Mature, écosystème riche, productivité |
| Auth | **Laravel Breeze (Blade)** | Simple, rapide, brandable |
| Front | **Blade + Tailwind CSS 3 + Alpine.js** | SSR, léger, pas de SPA inutile pour MVP |
| DB | **MySQL 5.7 (MAMP)** → MySQL 8 en prod | Local DEV via MAMP, prod managée |
| Notifications | Mail (SMTP) + base de données | Simple, traçable |
| Stockage fichiers | `storage/app/public` + symlink | OK MVP, S3 plus tard |
| Tests | PHPUnit (Laravel) | Standard |
| Versionning | Git Flow (cf. CLAUDE.md global) | `feat/`, `fix/`, `develop`, `main` |

---

## 9. Sécurité (par design)

- HTTPS obligatoire en prod
- CSRF activé (Laravel par défaut)
- Hash bcrypt mots de passe
- RBAC strict (middleware `role:admin`, `role:pme`)
- Validation serveur systématique
- Rate limiting sur `/login`, `/inscription`
- Logs d'audit (création / suppression entités sensibles)
- RGPD-friendly : consentement, droit à l'effacement (V1.1)

---

## 10. KPI suivis (Dashboard Admin)

| KPI | Source | Fréquence |
|---|---|---|
| Nb PME inscrites total | `pmes WHERE status=active` | Live |
| Nb PME inscrites (période) | `pmes WHERE created_at BETWEEN` | Filtre |
| Nb opportunités publiées (période) | `opportunities WHERE status=published` | Filtre |
| Nb formations publiées (période) | `trainings` | Filtre |
| Répartition PME par métier | `pme_business_category` | Live |
| Top 5 métiers les plus ciblés | `opportunity_business_category` | Live |
| Taux PME actives 30j | `users WHERE last_login_at > now-30d` | Live |

---

## 11. Roadmap MVP — 6 sprints

| Sprint | Durée | Livrables |
|---|---|---|
| S1 | 1 sem | Bootstrap Laravel, design system, auth, layouts |
| S2 | 1 sem | Modèles + migrations + seeders + back-office PME (validation) |
| S3 | 1 sem | CRUD opportunités + filtrage par métier côté PME |
| S4 | 1 sem | Formations + actualités SMI |
| S5 | 1 sem | Notifications email + KPI dashboard |
| S6 | 1 sem | Tests, durcissement sécurité, déploiement staging |

---

## 12. Hypothèses & risques

- **H1** : Volume initial < 500 PME — pas de besoin scalabilité forte (MVP).
- **H2** : Connexion internet variable côté PME → optimiser poids des pages, pas de SPA lourde.
- **R1** : Adoption faible si parcours d'inscription trop complexe → simplifier au max.
- **R2** : Dépendance ANPI pour cartographie initiale → prévoir import CSV en V1.

---

## 13. Annexes

- Charte graphique COMILOG (à fournir par le client)
- Procédure achats responsables ERAMET
- Référentiel IRMA pertinent pour le Local Content
