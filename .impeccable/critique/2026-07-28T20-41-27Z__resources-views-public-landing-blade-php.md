---
target: resources/views/public/landing.blade.php
total_score: 13
max_score: 20
na_heuristics: 3,5,7,9,10
p0_count: 2
p1_count: 2
timestamp: 2026-07-28T20-41-27Z
slug: resources-views-public-landing-blade-php
---
# Critique — resources/views/public/landing.blade.php

**Method: dual-agent (A: a5e1a289d787c191f · B: acae9c54238d3a8aa)**

## Design Health Score

Mode : Persuade. Heuristiques 3, 5, 7, 9, 10 marquées n/a (pas de forms, pas de flux de tâche, pas d'états d'erreur sur cette surface).

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | 3 | Nav sticky + pulse-dot hero suggèrent le "live" ; pas d'état actif sur les liens d'ancre. |
| 2 | Match System / Real World | 3 | Ton institutionnel français bien calibré. Trois verbes concurrents pour l'action primaire. |
| 3 | User Control and Freedom | n/a | Surface statique, back-to-top couvre l'escape. |
| 4 | Consistency and Standards | 2 | CTA secondaire hero hand-rollé hors du token system ; nav « Ressources » → `#resources` qui titre « Comment ça marche » ; « PME à l'honneur » liste des catégories, pas des PMEs. |
| 5 | Error Prevention | n/a | Pas de forms sur la landing. |
| 6 | Recognition Rather Than Recall | 3 | Icônes + labels partout, ancres cohérentes avec la nav. |
| 7 | Flexibility and Efficiency | n/a | Persuade, chemin unique. |
| 8 | Aesthetic and Minimalist Design | 2 | 8 sections pour une Persuade, hero avec 5 ancres visuelles concurrentes, feature grid promet 6 modules dont 3 non-shippés. |
| 9 | Error Recovery | n/a | Pas d'états d'erreur. |
| 10 | Help and Documentation | n/a | Pas une surface tâche. |
| Total | | 13/20 | 65 % — Acceptable (bord de Good) |

## Design Specificity Verdict

Nuanced blend — institutionnellement spécifique en atmosphère et copy (Moanda, ERAMET, IRMA, Loi 037/2018, manganèse, gradient navy→forest, eyebrow bronze), SaaS-generic en structure et promesses. Trois des six tiles vantent des modules qui n'existent pas au MVP.

Deterministic scan : 6 findings, tous `design-system-font-size` (advisory, quality). Hero H1 (l.24) et H2 du CTA final (l.314) `clamp()` dépassent le palier display (max 3rem). 4 labels KPI hero (l.48/52/56/60) `text-[10px]` sous le plancher label 11 px — enfreint The Mobile Is Not Degraded Rule. Zéro faux positif — le détecteur confirme indépendamment deux points relevés par Assessment A.

Visual overlays non-injectés : hero desktop 1440 et mobile 375 capturés ; frames mid-page blanches (limitation pane, DOM OK). Aucune erreur console. Deux blobs `bg-soft-glow-*` dépassent le viewport mobile (edges 535 / 503 px vs innerWidth 439) mais clippés par overflow-hidden parent.

## Overall Impression

Squelette du "Manganese Ledger" solide sur hero, About/Partners et Final CTA. Milieu de page (Features → PME Showcase → Testimonials) = passif de confiance : 3 modules promis non-shippés, section titrée mal, 3 témoignages nommés fictifs. Un visiteur IRMA repère les 3 en 90 s. Plus grande opportunité : retirer plus qu'ajouter, passer de 8 à 5 sections.

## What's Working

1. Le Final CTA est le peak de la page. rounded-3xl + gradient navy→forest + soft-glow bronze/forest + noise overlay + text-gradient-hero. Respecte The Assay Mark Rule et The Warm Paper Rule. C'est la signature.
2. Le couple eyebrow / display est discipliné et constant. Chaque section : .eyebrow bronze-700 uppercase + Geist display clamp(). The Fluid Display Rule et The Two-Voice Rule appliquées honnêtement.
3. L'About/Partners split-panel est le bloc le plus impossible-à-copier. IRMA, Loi 037/2018, ERAMET nommés dans une check-list ; double glass card avec logo COMILOG et icône feuille Local Content.

## Priority Issues

### [P0] La grille Features promet 3 modules qui ne shippent pas

- What. Lignes 134-142 : `$features` avance « Forums communautaires », « Événements networking », « Messagerie sécurisée ». PRODUCT.md §Capabilities exclut explicitement forum / messagerie / événements du MVP.
- Why it matters. Plus grande dette de confiance de la page. Représentant PME s'inscrit, découvre le vide, crédibilité brûlée. Viole Product Principle #5.
- Fix. Reconstruire l'array avec 6 capabilities livrées : Annuaire PME · Opportunités ciblées par métier · Formations HSE/IRMA · Actualités SMI · Notifications email par métier · Validation humaine COMILOG 48 h.
- Suggested command. `/impeccable harden`

### [P0] « PME à l'honneur » affiche des catégories, pas des PMEs

- What. Lignes 173-200 : titre « PME à l'honneur » puis boucle sur $categories avec cartes « PME du secteur {name} ». Taxonomies ≠ PMEs vedettes.
- Why it matters. Mismatch titre/contenu → valley émotionnel identifié juste avant Latest Opportunities. Aggrave Riley red flag.
- Fix. Renommer « Un écosystème par métier ». Réécrire copy. Injecter $cat->pmes_count. Garder la grille visuelle.
- Suggested command. `/impeccable clarify`

### [P1] Témoignages nommés fabriqués — exposition audit/juridique

- What. Lignes 253-258 : trois témoignages signés Marie-Claire OBAME etc. PRODUCT.md §Absences avertit explicitement de leur nature démo.
- Why it matters. Sur plateforme adossée à ERAMET/IRMA/loi minière, citations attribuées à noms fabriqués = exposition légale dès la prod. Riley les détecte en 30 s.
- Fix. Supprimer la section pour le MVP. Remplacer par un bloc « Notre engagement Local Content » — une phrase signée COMILOG.
- Suggested command. `/impeccable distill`

### [P1] Le mur KPI hero concurrence le CTA primaire et affiche des chiffres démo faibles

- What. Lignes 45-62 : 4 tuiles KPI sous le CTA bronze. En MVP la seed donne 5 PMEs / 5 opps / 2 formations / 8 catégories — chiffres qui nuisent à la crédibilité.
- Why it matters. Enfreint The Glow-Costs-Attention Rule. « 5 PMEs inscrites » se lit « plateforme vide ». Le détecteur confirme des labels sous le plancher 11 px.
- Fix. Remplacer par 4 ancres de confiance institutionnelle : Groupe ERAMET · IRMA · Loi 037/2018 · Moanda, Haut-Ogooué. Zéro chiffre. KPI dynamiques migrent post-Login OU visibles seulement si pmes ≥ 25.
- Suggested command. `/impeccable distill`

### [P2] Nav « Ressources » mal étiquetée et dupliquée en footer

- What. public.blade.php:25 : nav « Ressources » ancre #resources qui titre « Comment ça marche ». Footer a aussi colonne « Ressources » (l.149) avec 3 liens href="#" morts.
- Why it matters. Même mot, deux sens, liens morts. Riley catche en 20 s.
- Fix. Renommer lien header « Démarrer ». Retirer colonne footer jusqu'à ce que les pages existent.
- Suggested command. `/impeccable clarify`

### [P3] CTA secondaire hero hors design system

- What. Lignes 40 et 326 : hand-rollé h-12 vs système h-11, opacité et bordure différentes.
- Why it matters. Deux variantes ad-hoc → theming futur fragile.
- Fix. Ajouter .btn-secondary-dark à app.css (fond white/5 + bordure white/20).
- Suggested command. `/impeccable polish`

## Persona Red Flags

Jordan (Confused First-Timer). Ne sait pas ce qu'est le « Local Content ». Voit « 5 PME inscrites » lit « plateforme vide ». Voit 6 tiles présume produit riche découvrira le vide au signup. « PME à l'honneur » puis « Toutes les PME de cette catégorie… » conclusion « il n'y en a pas encore ». Deux CTAs hero tirent également.

Riley (Deliberate Stress Tester). Clic « Découvrir les PME » cartes taxonomie ≠ PMEs bait detected. Cherche Marie-Claire OBAME externe 0 résultat testimonials fabriqués. Nav « Ressources » → « Comment ça marche » mislabel. Footer contact@comilog.local domaine invalide. Feature cards « En savoir plus → » sans href link theatre.

Casey (Distracted Mobile User 375 px). 8 sections empilées 6-8 hauteurs d'écran risque d'abandon élevé. Hover reveals invisibles sur touch. Latest Opportunities cards rien à taper. Testimonials 3 cartes × 1 hauteur de citations non-utiles. Deux blobs 640/480 px dépassent viewport 439 clippés OK mais fragile.

## Minor Observations

- Hover reveal "En savoir plus →" feature cards l.157 sans href et invisible sur touch.
- Latest Opportunities cards sans CTA per-card et sans href.
- Hero pulse dot l.16-19 sémantiquement creux.
- Footer contact@comilog.local placeholder qui casse.
- Session flash mt-4 public.blade.php:111 risque collision nav sticky en sm.
- Noise overlay sur CTA final rounded-3xl : ::after sans border-radius: inherit vérifier Safari.
- SME Showcase header row l.170 flex justify-between flex-wrap sur 375 px CTA wrappe sous titre.
- Détecteur : hero H1 et CTA H2 clamp() dépassent le palier display. Volontaire pour signature mais mérite un palier « hero-display » dans DESIGN.md.

## Questions to Consider

1. La landing a-t-elle besoin d'une section Testimonials avant qu'une vraie PME ait dit oui ?
2. Et si le mur KPI hero était des credentials institutionnels au lieu de compteurs ?
3. Six modules à demi-vrais ou quatre honnêtement livrés + un « V1.1 en préparation » ?
4. « PME à l'honneur » doit-il exister au launch, ou fusionner dans About ?
