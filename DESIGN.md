---
name: COMILOG Local Connect
description: Institutional Local Content platform for Gabonese SMEs — COMILOG × Groupe ERAMET.
colors:
  moanda-midnight: "#0A2240"
  midnight-deep: "#061833"
  midnight-mid: "#1B3358"
  compliance-forest: "#0F5132"
  compliance-forest-mid: "#15803D"
  assay-bronze: "#B45309"
  assay-bronze-cast: "#D97706"
  assay-bronze-lit: "#F59E0B"
  cool-paper: "#FAFAF9"
  paper-rule: "#E7E5E4"
  ledger-graphite: "#78716C"
  ledger-ink: "#0C0A09"
  success: "#15803D"
  danger: "#B91C1C"
  warning: "#CA8A04"
typography:
  display:
    fontFamily: "Geist, 'SF Pro Display', system-ui, sans-serif"
    fontSize: "clamp(1.875rem, 4.5vw, 3rem)"
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: "-0.025em"
  headline:
    fontFamily: "Geist, 'SF Pro Display', system-ui, sans-serif"
    fontSize: "1.5rem"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "-0.02em"
  title:
    fontFamily: "Geist, 'SF Pro Display', system-ui, sans-serif"
    fontSize: "1.125rem"
    fontWeight: 600
    lineHeight: 1.3
    letterSpacing: "-0.015em"
  body:
    fontFamily: "Inter, system-ui, sans-serif"
    fontSize: "0.9375rem"
    fontWeight: 400
    lineHeight: 1.55
    letterSpacing: "normal"
  label:
    fontFamily: "Geist, 'SF Pro Display', system-ui, sans-serif"
    fontSize: "0.6875rem"
    fontWeight: 600
    lineHeight: 1
    letterSpacing: "0.2em"
rounded:
  soft: "6px"
  sharp: "10px"
  lg: "12px"
  xl: "16px"
  hero: "24px"
  pill: "9999px"
spacing:
  gutter-sm: "16px"
  gutter-md: "24px"
  gutter-lg: "32px"
  section-y: "clamp(4rem, 8vw, 8rem)"
components:
  button-primary:
    backgroundColor: "linear-gradient(135deg, {colors.assay-bronze-cast} 0%, {colors.assay-bronze} 100%)"
    textColor: "#FFFFFF"
    typography: "{typography.title}"
    rounded: "{rounded.sharp}"
    height: "44px"
    padding: "0 20px"
  button-secondary:
    backgroundColor: "rgba(255,255,255,0.7)"
    textColor: "{colors.moanda-midnight}"
    typography: "{typography.title}"
    rounded: "{rounded.sharp}"
    height: "44px"
    padding: "0 20px"
  button-ghost:
    backgroundColor: "transparent"
    textColor: "{colors.ledger-graphite}"
    typography: "{typography.title}"
    rounded: "8px"
    height: "36px"
    padding: "0 12px"
  button-dark:
    backgroundColor: "{colors.moanda-midnight}"
    textColor: "#FFFFFF"
    typography: "{typography.title}"
    rounded: "{rounded.sharp}"
    height: "44px"
    padding: "0 20px"
  card:
    backgroundColor: "#FFFFFF"
    textColor: "{colors.ledger-ink}"
    rounded: "{rounded.xl}"
    padding: "24px"
  card-glass:
    backgroundColor: "rgba(255,255,255,0.65)"
    textColor: "{colors.ledger-ink}"
    rounded: "{rounded.xl}"
    padding: "24px"
  card-feature:
    backgroundColor: "#FFFFFF"
    textColor: "{colors.ledger-ink}"
    rounded: "{rounded.xl}"
    padding: "32px"
  input:
    backgroundColor: "#FFFFFF"
    textColor: "{colors.ledger-ink}"
    typography: "{typography.body}"
    rounded: "{rounded.sharp}"
    height: "44px"
    padding: "0 14px"
  badge:
    backgroundColor: "rgba(10,34,64,0.10)"
    textColor: "{colors.moanda-midnight}"
    typography: "{typography.label}"
    rounded: "{rounded.pill}"
    height: "24px"
    padding: "0 10px"
  eyebrow:
    backgroundColor: "transparent"
    textColor: "{colors.assay-bronze}"
    typography: "{typography.label}"
    padding: "0"
---

# Design System: COMILOG Local Connect

## Overview

**Creative North Star: "The Manganese Ledger"**

Le système visuel se comporte comme un registre institutionnel du minerai : navy profond pour la matière brute (surfaces sombres, headers, sidebar), forest pour la conformité et le tissu vivant (badges succès, gradient hero, bordures d'accents secondaires), et bronze rare pour la marque de garantie — l'estampille officielle qu'on ne pose que là où une décision engage un cycle. Le papier `stone-50` est la feuille du registre : mat, tactile, jamais éclatant. Une texture noise à 4 % en overlay rappelle le grain d'un document imprimé sans jamais devenir décorative.

Ce n'est ni un dashboard SaaS ni un site corporate consulting. L'implémentation refuse deux dérives que la catégorie encourage : le glassmorphisme plastique du dashboard-of-the-week (des cartes flottantes bleu-clair sans intention), et le corporate neutre bleu-gris-Helvetica qui pourrait servir n'importe quel groupe industriel. Ici tout signale COMILOG spécifiquement : la ville de Moanda dans le nom de la couleur signature, le bronze qui évoque le manganèse raffiné, la forêt équatoriale sur les états de conformité, la sobriété francophone institutionnelle dans la copy.

La densité vise le poste de travail admin (desktop, longues sessions) sans jamais rendre la surface PME (mobile, terrain, connexion variable) illisible. Le typographie est double : Geist en display et étiquettes pour la précision géométrique moderne, Inter en corps pour la neutralité de lecture. Les mouvements sont lents et amortis (`cubic-bezier(0.16, 1, 0.3, 1)`), jamais nerveux.

**Key Characteristics:**
- Palette navy dominante, forest secondaire, bronze rare et décisif
- Typographie Geist + Inter en couple précision/lecture
- Élévation par ombres douces multi-couches + glows colorés uniquement aux moments décisifs
- Textures fines (noise 4 %, grid 32 px) pour l'ancrage matériel — jamais décoratives
- Glass surfaces subtiles (nav sticky à 75 % opacité, sidebar interne dark à 55 %)
- Coins arrondis mesurés : 10 px pour les contrôles, 16 px pour les cartes, 24 px pour les blocs héroïques
- Voice institutionnelle française — zéro emoji dans les surfaces produit

## Colors

Palette de deux teintes profondes (navy + forest) et d'un unique accent chaud (bronze), posées sur un papier neutre chaud (`cool-paper` #FAFAF9). L'ensemble parle mine responsable, registre officiel, forêt équatoriale.

### Primary

- **Moanda Midnight** (`#0A2240`) : la couleur signature. Header sidebar, boutons dark, titres corps de texte, tous les éléments qui doivent tenir la structure. Rappelle la ville-siège du site minier COMILOG.
- **Midnight Deep** (`#061833`) : le pas plus sombre. Hover des boutons dark et fond footer. Toujours en pair avec Moanda Midnight, jamais seul.
- **Midnight Mid** (`#1B3358`) : le pas plus clair. Utilisé dans les gradients hero (transition vers le forest) et pour les bordures de séparation dans la sidebar dark.

### Secondary

- **Compliance Forest** (`#0F5132`) : deuxième teinte structurelle, sur les états de conformité (validation PME, statut actif, "compte validé"). Termine le gradient hero navy→forest. Évoque la forêt gabonaise et la conformité IRMA.
- **Compliance Forest Mid** (`#15803D`) : version plus vive utilisée dans les badges succès et sur les icônes forest sur fond clair. Alias direct de `success`.

### Tertiary — accent chaud

- **Assay Bronze** (`#B45309`) : l'unique accent chaud du système. C'est la marque de garantie. Voir **The Assay Mark Rule** ci-dessous.
- **Assay Bronze Cast** (`#D97706`) : point de départ du gradient CTA bronze (`btn-primary`). L'or fondu qui coule dans le moule.
- **Assay Bronze Lit** (`#F59E0B`) : la lumière du bronze. Utilisé dans les glows radiaux et le gradient hero du texte gradient. Jamais sur un texte de corps.

### Neutral

- **Cool Paper** (`#FAFAF9`) : le papier du registre. Fond de body, section headers, thead des tables. Chaud (base beige), pas gris.
- **Paper Rule** (`#E7E5E4`) : la règle tracée. Bordures de cartes, séparateurs, contours d'inputs au repos.
- **Ledger Graphite** (`#78716C`) : le crayon des annotations. Texte secondaire, labels, tips.
- **Ledger Ink** (`#0C0A09`) : l'encre du corps du texte. Toujours sur `cool-paper`, jamais sur pur blanc.

### Named Rules

**The Assay Mark Rule.** Le bronze est la marque de garantie — il n'apparaît qu'à côté de ce qui engage un cycle d'action : CTA primaire, deadline critique, état « en attente de validation », focus d'un input, chevron de call-to-action au hover. Jamais décoratif. Sa rareté est le point : quand le bronze parle, on sait qu'il y a une décision à prendre. Test concret : sur une capture d'écran donnée, si on retire toutes les zones bronze et qu'il ne reste plus aucune action utilisateur claire, la règle est respectée.

**The Warm Paper Rule.** Le fond `cool-paper` (#FAFAF9) est un beige chaud, pas un blanc pur. Ne jamais utiliser `#FFFFFF` en fond de body ou de section large. Le blanc pur reste réservé aux surfaces qui doivent trancher : cartes (`card`), inputs, badges. Cette hiérarchie carte-sur-papier est ce qui fait « registre » plutôt que « app générique ».

## Typography

**Display Font:** Geist (avec SF Pro Display, system-ui, sans-serif)
**Body Font:** Inter (avec system-ui, sans-serif)
**Label Font:** Geist (identique au display)
**Mono Font:** Geist Mono (utilisé uniquement pour les références opportunités type `COM-2026-0001`)

**Character:** Le couple Geist + Inter donne une voix double : Geist porte la précision géométrique moderne (headings, boutons, labels uppercase) et Inter porte la neutralité de lecture confortable (paragraphes, formulaires longs, descriptions d'opportunités). Geist n'est jamais utilisé pour du corps de texte ; Inter n'est jamais utilisé pour un heading.

### Hierarchy

- **Display** (Geist 700, `clamp(1.875rem, 4.5vw, 3rem)`, line-height 1.1, letter-spacing -0.025em) : titres de section marketing sur la landing (`## Réduire l'asymétrie d'information`, `## PME à l'honneur`) et titre hero. Fluide par `clamp()` — jamais figé en px.
- **Headline** (Geist 700, 1.5rem, line-height 1.2, letter-spacing -0.02em) : titre H1 des vues portail (`{{ page-title }}`), titre des cartes-vedettes, titre d'article détail.
- **Title** (Geist 600, 1.125rem, line-height 1.3, letter-spacing -0.015em) : titres de cartes (`h3.font-display`), titres d'items dans les listes.
- **Body** (Inter 400, 0.9375rem soit 15 px, line-height 1.55) : paragraphes courants, descriptions, textarea. Longueur de ligne cible : 60-72 caractères.
- **Label** (Geist 600, 0.6875rem soit 11 px, letter-spacing 0.2em, UPPERCASE) : eyebrows de section, en-têtes de table, `<dt>` de listes de définition, meta info dans les cartes. Toujours en majuscules.

### Named Rules

**The Two-Voice Rule.** Geist pour la structure, Inter pour la lecture. Ne jamais mélanger : un paragraphe en Geist devient froid, un heading en Inter perd sa précision. Les inputs sont en Inter par héritage body ; les boutons et badges sont en Geist par affirmation.

**The Fluid Display Rule.** Tout heading de niveau display (hero, section marketing) utilise `clamp()` — jamais une taille fixe. Le pattern canonique est `clamp(1.875rem, 4.5vw, 3rem)`. Ceci garantit la lisibilité à 375 px (mobile terrain) sans casser la présence à 1440 px+.

## Layout

Le grid est fluide, contenu dans `max-w-7xl` (1280 px) pour la landing et `max-w-[1600px]` pour le portail. Padding horizontal : `px-4` (16 px) au mobile, `sm:px-6` (24 px), `lg:px-8` (32 px). Espacement vertical de section : `py-16 sm:py-20 lg:py-32` — jamais serré sur mobile.

Le rythme d'espacement suit l'échelle Tailwind par pas de 4/8, avec trois gutters récurrents nommés : `gutter-sm` (16 px, entre items d'une liste), `gutter-md` (24 px, entre cartes d'une grille), `gutter-lg` (32 px, entre blocs de section).

Breakpoints (Tailwind par défaut) :
- **sm** 640 px : passage tablet portrait, empilement des CTA hero vers side-by-side, apparition des colonnes de KPI 4 par ligne
- **md** 768 px : disparition du burger public au profit des nav-links inline
- **lg** 1024 px : sidebar portail devient fixe (avant : off-canvas), grid 3-col pour les features
- **xl** 1280 px : max-width atteinte pour le container landing

Le portail conserve une sidebar fixe 256 px à gauche à partir de `lg`. Sous `lg`, la sidebar bascule en off-canvas (Alpine drawer) et un burger apparaît dans le header. Le header lui-même reste sticky à 72 px de hauteur sur toute surface — le `scroll-margin-top: 88px` sur les sections avec id est calibré pour cette hauteur.

**The Mobile Is Not Degraded Rule.** Les surfaces PME doivent être aussi lisibles à 375 px qu'à 1440 px. Cela signifie : jamais de scroll horizontal, jamais de contenu caché derrière une action introuvable, taille de police minimale 15 px sur les paragraphes, taille de police 11 px seulement pour les labels UPPERCASE. Un design qui « marche presque » sur mobile ne marche pas — les PME consultent depuis le terrain.

## Elevation & Depth

Layered soft avec glows colorés accentués. La hiérarchie normale se fait par une échelle d'ombres douces multi-couches ; les glows colorés (bronze, navy, forest) sont réservés aux moments qui doivent être remarqués immédiatement (CTA primaire, back-to-top, KPI à valider). Rien ne flotte gratuitement.

### Shadow Vocabulary

- **xs** (`box-shadow: 0 1px 2px rgba(12,10,9,0.04)`) : minimalement décollé, utilisé pour les micro-éléments (badges en état actif, ring de focus discret).
- **soft** (`0 1px 2px rgba(12,10,9,0.04), 0 1px 3px rgba(12,10,9,0.06)`) : élévation standard des cartes au repos. C'est la ligne de base.
- **elevated** (`0 4px 8px -2px rgba(12,10,9,0.08), 0 2px 4px -1px rgba(12,10,9,0.04)`) : cartes-glass, dropdowns légers, cartes de contact.
- **lifted** (`0 12px 24px -6px rgba(12,10,9,0.10), 0 4px 8px -2px rgba(12,10,9,0.06)`) : hover state des cartes normales, boutons dark en hover, modals petits.
- **floating** (`0 24px 48px -12px rgba(12,10,9,0.18), 0 8px 16px -4px rgba(12,10,9,0.08)`) : drawers off-canvas, popovers importants. Réservé aux surfaces qui interrompent temporairement le flux.

### Colored Glows (accent)

- **glow-bronze** (`0 0 0 1px rgba(180,83,9,0.10), 0 8px 24px -8px rgba(180,83,9,0.45)`) : état repos du CTA primaire et du back-to-top. Le bronze halo signale « ceci est l'action ».
- **glow-bronze-lg** (`0 0 0 1px rgba(180,83,9,0.20), 0 16px 40px -8px rgba(180,83,9,0.55), 0 0 80px -20px rgba(245,158,11,0.40)`) : hover du CTA primaire. Amplifie le halo, ajoute la couche externe diffuse.
- **glow-navy** (`0 0 60px -12px rgba(27,51,88,0.35)`) : icônes-conteneurs navy sur fond clair (cartes features), pour affirmer sans dominer.
- **glow-forest** (`0 0 50px -10px rgba(21,128,61,0.30)`) : icônes-conteneurs forest et bouton de validation PME (état positif décisif).

### Named Rules

**The Glow-Costs-Attention Rule.** Un glow coloré signifie « regarde ici ». Il ne peut pas y avoir plus d'un `glow-bronze` visible dans un même viewport (le CTA primaire OU le back-to-top, jamais les deux quand back-to-top est visible). Le CTA primaire mobile devient donc `btn-primary` sans halo si le back-to-top est actif — dans la version actuelle, ce cas ne se produit pas grâce au comportement scroll du back-to-top.

**The Ambient-First Rule.** L'élévation normale (cartes, sections) utilise les ombres neutres (`soft`, `lifted`). Un glow coloré n'est jamais ambient — il annonce toujours une action ou un état décisif.

## Shapes

Rayons mesurés, jamais brutaux ni gonflés. Deux familles de rayon :

- **Contrôles** : `rounded-sharp` (10 px) pour les boutons `btn-primary/secondary/dark` et pour les inputs. Un peu plus doux que la valeur Tailwind `rounded-lg` (8 px), un peu plus dur que `rounded-xl` (12 px) — c'est ce léger décalage qui donne le feel « pièce de mobilier institutionnel » plutôt que « chip mac ».
- **Surfaces** : `rounded-xl` (16 px) pour les cartes normales, `rounded-hero` (24 px) pour les blocs héroïques (CTA final, cartes de mise en situation), `rounded-full` pour les badges, le back-to-top, les avatars circulaires.

Bordures : toujours à 1 px, jamais plus épaisses. La couleur par défaut est `paper-rule` (#E7E5E4) au repos ; le focus la remplace par `assay-bronze` (#B45309) accompagné d'un ring bronze `0 0 0 4px rgba(180,83,9,0.12)`.

Aucune forme géométrique décorative (chevrons, triangles, patterns brutalistes). Les seules formes décoratives récurrentes sont :
- Le **grid-stone** (32 px × 32 px) à 3 % d'opacité en fond hero — évoque le papier millimétré du registre.
- La **noise-overlay** à 4 % d'opacité avec `mix-blend-mode: overlay` sur les surfaces sombres (footer, hero) — texture papier imprimé.
- Les **soft-glow radial-gradient** (bronze, navy, forest) qui « respirent » derrière le hero — jamais nets, toujours diffus.

## Components

### Buttons

- **Shape:** rayon sharp (10 px), hauteur 44 px pour les variantes principales, 36 px pour `btn-ghost`. Padding horizontal 20 px (16 px pour ghost). Gap interne 8 px entre icône et texte.
- **Primary (`btn-primary`):** gradient bronze `135deg #D97706 → #B45309`, texte blanc Geist 600 14 px, halo `glow-bronze` au repos. Au hover : translation Y -2 px + halo amplifié `glow-bronze-lg`. Actif : retour à Y 0.
- **Secondary (`btn-secondary`):** background frosted white 70 % opacité avec `backdrop-blur(12px)`, bordure 1 px `rgba(10,34,64,0.15)`, texte navy Geist 600 14 px. Au hover : background pur blanc, bordure `rgba(10,34,64,0.25)`.
- **Ghost (`btn-ghost`):** transparent, texte `ledger-graphite`, hauteur 36 px. Au hover : texte devient navy et background devient `bg-navy/5`. Utilisé pour les actions secondaires en header, les breadcrumbs, les liens « Voir tout →ê ».
- **Dark (`btn-dark`):** solide navy, texte blanc Geist 600. Au hover : `navy-dark` + translation Y -2 px + `shadow-lifted`. Rarement utilisé (contexte : boutons secondaires sur surfaces claires quand le glass est trop léger).

### Cards / Containers

- **Corner Style:** `rounded-xl` (16 px) pour les cartes standard, `rounded-hero` (24 px) pour les blocs marketing signature.
- **Background:** pur blanc pour `card`, `rgba(255,255,255,0.65)` frosted pour `card-glass`, `rgba(10,34,64,0.55)` frosted pour `card-glass-dark` (sur surfaces sombres).
- **Shadow Strategy:** `soft` au repos, `lifted` au hover avec translation Y -2 px (`card`) ou Y -4 px (`card-feature`). Voir Elevation.
- **Border:** 1 px `paper-rule` (#E7E5E4) sur `card` et `card-feature`. `card-glass` a une bordure blanche translucide 40 % pour la définition sur fond photo/gradient.
- **Internal Padding:** 24 px pour `card`, 32 px pour `card-feature` (généreux — plus une carte a d'autorité, plus elle respire).

### Card Feature (signature)

Variante distinctive : carte blanche avec pseudo-élément `::before` qui pose un radial-gradient `rgba(245,158,11,0.08)` en coin haut-droit. C'est le « sceau bronze » discret qui suggère « cet élément vaut qu'on s'y arrête », sans jamais crier. Utilisée pour les 6 tuiles de la section Features et pour les KPI cards du portail. La lumière bronze augmente à ~14 % au hover.

### Inputs / Fields

- **Style:** background pur blanc, bordure 1 px `paper-rule`, rayon sharp (10 px), hauteur 44 px, padding horizontal 14 px, typographie body 15 px `ledger-ink`.
- **Focus:** bordure devient `assay-bronze` (#B45309), ring bronze `0 0 0 4px rgba(180,83,9,0.12)`, `outline: none`. C'est le seul contexte où le bronze apparaît sans engager une action utilisateur — ici il confirme « je t'écoute ».
- **Placeholder:** `ledger-graphite` (#78716C).
- **Textarea:** identique aux inputs mais hauteur min 88 px, padding vertical 10 px. Redimensionnable.
- **Erreur:** bordure rouge `border-red-200`, texte de l'erreur `text-red-700` en dessous.

### Badges

Pills en `rounded-full` hauteur 24 px, padding horizontal 10 px, typographie `label` (Geist 600 11 px letter-spacing 0.2em) mais **sans uppercase** (l'uppercase est réservé à l'eyebrow — le badge lit un statut, il ne crie pas). Variantes :

- `badge-navy` : fond `navy/10`, texte navy — statuts neutres, référence opportunité
- `badge-forest` : fond `forest/10`, texte forest — statuts positifs (compte activé)
- `badge-bronze` : fond `bronze/10`, texte `bronze-700` — statuts en attente (validation, deadline)
- `badge-glass` : fond `rgba(245,158,11,0.10)` + bordure bronze + `backdrop-blur(8px)` — utilisé en overlay sur les surfaces sombres (hero, footer)
- `badge-success` / `badge-warning` / `badge-danger` : mêmes patterns avec les couleurs sémantiques

Les métiers ont des couleurs personnalisées par catégorie (`business_categories.color`), affichées en inline-style `background: {color}1A; color: {color};` — c'est la seule dérogation aux badges système.

### Eyebrow

Label Geist 600 11 px letter-spacing 0.2em, **uppercase**, couleur `assay-bronze-700`. Précède chaque titre de section marketing (« Mission & Vision », « Six modules · une plateforme », « Communauté »). Signe visuel constant qui dit « ce qui suit est une nouvelle section importante ». Jamais réutilisé pour un statut ou un badge.

### Navigation

- **Public sticky (`nav-glass`):** hauteur 72 px, background `rgba(250,250,249,0.75)` + `backdrop-blur(20px) saturate(180%)`, bordure basse 1 px `paper-rule`. Les liens sont des `btn-ghost` (36 px, texte `ledger-graphite`, hover → navy).
- **Portail dark (`sidebar-dark`):** largeur 256 px, gradient vertical `180deg #061833 → #0A2240`, bordure droite 1 px `rgba(255,255,255,0.06)`, `noise-overlay` à 4 %. Les liens actifs ont une barre bronze 2 px à gauche + fond `bg-white/[0.08]` + `shadow-inner-glow` (highlight top subtil).
- **Mobile drawer:** slide depuis la gauche (portail) ou la droite (public), 80-85 vw largeur, `shadow-floating`, backdrop navy 60-70 % `backdrop-blur-sm`, fermé par Escape / click backdrop / click sur lien.

### Back-to-top (signature)

Bouton rond 48 × 48 px, gradient bronze `135deg #D97706 → #B45309`, halo `glow-bronze`, icône flèche haut Lucide inline (20 px stroke 2.25). Position fixe `bottom: 16px right: 16px` (24 px en `sm+`), z-index 40. Apparaît via Alpine.js quand `window.scrollY > 480`, s'anime en opacité 300 ms. Cliquer déclenche `window.scrollTo({ top: 0, behavior: 'smooth' })`.

## Do's and Don'ts

### Do:

- **Do** utiliser `cool-paper` (#FAFAF9) comme fond de body et de section large. Le blanc pur reste aux cartes.
- **Do** poser le bronze uniquement sur les actions décisives (CTA primaire, deadline, statut « en attente », focus input, back-to-top).
- **Do** utiliser `clamp()` pour tout heading display — le pattern canonique est `clamp(1.875rem, 4.5vw, 3rem)`.
- **Do** appliquer `noise-overlay` à 4 % sur les surfaces sombres (footer navy, hero, cartes-glass-dark) pour l'ancrage matériel.
- **Do** faire lever les cartes de `-translate-y-0.5` (`card`) à `-translate-y-1` (`card-feature`) au hover avec transition `duration-300 ease-expo-out`.
- **Do** utiliser `badge-glass` (bronze translucide) pour les eyebrows/labels sur les surfaces sombres, jamais un `badge-navy` (illisible).
- **Do** garder `nav-glass` sticky à 72 px sur toutes les pages et compenser via `scroll-margin-top: 88px` sur les sections ancrées.
- **Do** appliquer `-webkit-backdrop-filter` en pair de `backdrop-filter` sur Safari (chaque `card-glass`, `nav-glass`, `sidebar-dark`, `badge-glass` le fait déjà).

### Don't:

- **Don't** mélanger Geist et Inter dans un même bloc. Geist = structure/labels, Inter = lecture. Un paragraphe en Geist devient froid ; un heading en Inter perd sa précision.
- **Don't** utiliser un `text-gradient-*` sur autre chose qu'un mot signature d'un heading hero. Jamais sur du corps de texte, jamais sur un metric KPI. Deux instances suffisent : le mot « innover » du hero et l'accent du CTA final.
- **Don't** poser un `glow-bronze` sur deux éléments visibles simultanément. Un halo bronze veut dire « ceci est l'action » — deux halos annulent la règle.
- **Don't** utiliser d'emoji dans les surfaces produit (landing, portail PME, portail admin). Les emojis restent réservés aux messages transactionnels courts et au code source.
- **Don't** ajouter de nouvelle couleur au système sans passer par une des trois familles (navy, forest, bronze) ou par une couleur sémantique (success/danger/warning). Une couleur métier PME est une exception cadrée (`business_categories.color`).
- **Don't** cacher la navigation sur mobile sans la remplacer par un burger accessible. La sidebar portail `hidden lg:flex` sans drawer mobile a été un incident de responsive corrigé.
- **Don't** utiliser d'ombres portées dramatiques (`box-shadow` > `floating`) pour styliser un contenu au repos. `floating` est le plafond, réservé aux surfaces interruptives (drawers, modals lourds).
- **Don't** styliser un contrôle avec `rounded-3xl` (24 px) — ce rayon est réservé aux blocs héroïques. Les boutons/inputs restent à 10 px, les cartes à 16 px.
