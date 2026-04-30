# Design System Master — COMILOG Local Connect

> **LOGIC :** Avant de construire une page, vérifier `design-system/comilog-local-connect/pages/[page-name].md`.
> Si le fichier existe, ses règles **surchargent** ce Master. Sinon, suivre ce fichier strictement.

**Project :** COMILOG Local Connect
**Generated :** 2026-04-27
**Pattern de référence :** Trust & Authority + Marketplace/Directory (B2B institutionnel)
**Inspirations :** Apple, Linear, Vercel — premium, minimaliste, élégant
**Skill base output :** [voir bas du fichier]

---

## 1. Direction artistique

| Dimension | Choix |
|---|---|
| Mood | Premium institutionnel, sobre, technique, africain contemporain |
| Tonalité | Confiance, autorité, partenariat, croissance économique locale |
| Inspirations | apple.com (clarté), linear.app (typographie & rythme), vercel.com (gradient + glow), stripe.com (densité d'info) |
| Anti-patterns | playful, AI purple/pink gradients, emojis comme icônes, neon, brutalism |

---

## 2. Palette couleurs (RÉCONCILIÉE — override skill output)

Référence visuelle : **deep navy COMILOG** (existant) + **vert forêt gabonaise** + **or/bronze manganèse** (ressources naturelles).

| Rôle | Hex | Token Tailwind | Usage |
|---|---|---|---|
| **Primary (Deep Navy COMILOG)** | `#0A2240` | `navy.700` | Header, titres clés, surfaces sombres |
| Primary dark | `#061833` | `navy.800` | Hover boutons primaires |
| Primary light | `#1B3358` | `navy.600` | Surfaces alternatives |
| **Forest (vert gabonais)** | `#0F5132` | `forest.700` | Accent secondaire, succès, badges institutionnels |
| Forest light | `#15803D` | `forest.600` | Hover, états positifs |
| **Bronze/Or (manganèse)** | `#B45309` | `bronze.700` | **CTA principaux**, highlights, glow |
| Bronze light | `#D97706` | `bronze.600` | Hover CTA, accents soft |
| Bronze glow | `#F59E0B` | `bronze.500` | Lueurs, halos |
| Background base | `#FAFAF9` | `stone.50` | Fond off-white tactile |
| Surface | `#FFFFFF` | `white` | Cartes |
| Surface elevated | `rgba(255,255,255,0.7)` | — | Cartes glassmorphism |
| Foreground | `#0C0A09` | `stone.950` | Texte principal |
| Foreground muted | `#57534E` | `stone.600` | Texte secondaire |
| Border | `#E7E5E4` | `stone.200` | Séparateurs subtils |
| Border glass | `rgba(255,255,255,0.3)` | — | Bordures cartes glass |
| Destructive | `#B91C1C` | `red.700` | Erreurs |
| Ring focus | `#B45309` | `bronze.700` | Anneau focus accessible |

**Gradients de référence :**
- Hero : `linear-gradient(135deg, #0A2240 0%, #1B3358 50%, #0F5132 100%)` (navy → forest)
- CTA bronze : `linear-gradient(135deg, #D97706 0%, #B45309 100%)`
- Soft glow : `radial-gradient(closest-side, rgba(245,158,11,0.25), transparent 70%)`

---

## 3. Typographie (RÉCONCILIÉE — override skill output)

Brief explicite utilisateur : **Geist** (titres / UI) + **Inter** (corps).

```css
@import url('https://fonts.bunny.net/css?family=geist:400,500,600,700,800|inter:400,500,600,700&display=swap');

:root {
  --font-display: 'Geist', 'SF Pro Display', system-ui, sans-serif;
  --font-body: 'Inter', system-ui, sans-serif;
  --font-mono: 'Geist Mono', 'SF Mono', monospace;
}
```

| Rôle | Police | Poids | Tailwind |
|---|---|---|---|
| Display (h1 hero) | Geist | 700 | `text-5xl lg:text-7xl tracking-tight` |
| H1 page | Geist | 700 | `text-3xl lg:text-4xl tracking-tight` |
| H2 section | Geist | 600 | `text-2xl tracking-tight` |
| H3 | Geist | 600 | `text-xl` |
| Eyebrow / overline | Geist | 600 | `text-xs uppercase tracking-[0.2em]` |
| Body | Inter | 400 | `text-base leading-relaxed` |
| Body small | Inter | 400 | `text-sm` |
| Label / form | Inter | 500 | `text-sm` |
| Caption | Inter | 400 | `text-xs` |
| Metric / chiffre | Geist | 700 | `text-4xl tabular-nums` |

Règles : line-height 1.6 corps, 1.1 hero, tracking légèrement négatif (-0.02em) sur titres pour le feel Linear/Vercel.

---

## 4. Effets visuels (Apple / Linear / Vercel)

### 4.1 Glassmorphism (cartes, modales, navigation)
```css
.glass {
  background: rgba(255, 255, 255, 0.65);
  backdrop-filter: blur(16px) saturate(180%);
  -webkit-backdrop-filter: blur(16px) saturate(180%);
  border: 1px solid rgba(255, 255, 255, 0.3);
}
.glass-dark {
  background: rgba(10, 34, 64, 0.65);
  backdrop-filter: blur(20px) saturate(180%);
  border: 1px solid rgba(255, 255, 255, 0.08);
}
```
Usage : header sticky, cards SME spotlight, modales, sidebar admin.

### 4.2 Soft glows (hero, CTA, focus)
```css
.glow-bronze   { box-shadow: 0 0 40px -8px rgba(245, 158, 11, 0.45), 0 0 80px -16px rgba(217, 119, 6, 0.25); }
.glow-navy     { box-shadow: 0 0 60px -12px rgba(27, 51, 88, 0.35); }
.glow-forest   { box-shadow: 0 0 50px -10px rgba(21, 128, 61, 0.30); }
```

### 4.3 Layered shadows (élévation premium, multi-couches)
```css
--shadow-xs:  0 1px 2px rgba(12, 10, 9, 0.04);
--shadow-sm:  0 1px 2px rgba(12, 10, 9, 0.04), 0 1px 3px rgba(12, 10, 9, 0.06);
--shadow-md:  0 4px 8px -2px rgba(12, 10, 9, 0.08), 0 2px 4px -1px rgba(12, 10, 9, 0.04);
--shadow-lg:  0 12px 24px -6px rgba(12, 10, 9, 0.10), 0 4px 8px -2px rgba(12, 10, 9, 0.06);
--shadow-xl:  0 24px 48px -12px rgba(12, 10, 9, 0.18), 0 8px 16px -4px rgba(12, 10, 9, 0.08);
--shadow-glow: 0 0 0 1px rgba(180, 83, 9, 0.10), 0 8px 24px -8px rgba(180, 83, 9, 0.30);
```

### 4.4 Gradient accents subtils
- Hero background : navy → forest (135°)
- CTA : bronze 600 → bronze 700
- Section dividers : ligne `border-image: linear-gradient(90deg, transparent, rgba(180,83,9,0.4), transparent) 1;`

### 4.5 Noise texture (tactile, <5% opacity)
SVG noise overlay sur backgrounds sombres pour casser les aplats :
```html
<div class="absolute inset-0 opacity-[0.04] mix-blend-overlay pointer-events-none"
     style="background-image: url('data:image/svg+xml;...noise...');"></div>
```

### 4.6 Iconographie
- **Lucide** uniquement (`lucide-react` ou inline SVG)
- Style : outline, stroke 1.5 px, taille tokens 16/20/24
- **JAMAIS** d'emoji comme icône (interdit)

---

## 5. Spacing & Layout (modular scale 4 / 8)

| Token | Valeur | Usage |
|---|---|---|
| `--space-1` | 4px | Tight |
| `--space-2` | 8px | Inline |
| `--space-3` | 12px | Compact |
| `--space-4` | 16px | Standard |
| `--space-6` | 24px | Section padding |
| `--space-8` | 32px | Card gap |
| `--space-12` | 48px | Section gap mobile |
| `--space-16` | 64px | Section gap desktop |
| `--space-24` | 96px | Hero padding desktop |
| `--space-32` | 128px | Section spacing premium |

Containers : `max-w-7xl` (1280px) pour pages standard, `max-w-6xl` pour contenu de lecture.
Breakpoints : 375 / 640 / 768 / 1024 / 1280 / 1536.

---

## 6. Composants — specs

### 6.1 Boutons
```css
/* CTA principal — bronze gradient + glow */
.btn-primary {
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  height: 44px; padding: 0 20px;
  background: linear-gradient(135deg, #D97706 0%, #B45309 100%);
  color: #fff; font-family: var(--font-display); font-weight: 600; font-size: 14px;
  border-radius: 10px;
  box-shadow: 0 0 0 1px rgba(180,83,9,.2), 0 8px 24px -8px rgba(180,83,9,.45);
  transition: transform 200ms cubic-bezier(0.16, 1, 0.3, 1), box-shadow 200ms;
}
.btn-primary:hover { transform: translateY(-1px); box-shadow: 0 0 0 1px rgba(180,83,9,.3), 0 12px 32px -8px rgba(180,83,9,.55); }
.btn-primary:active { transform: translateY(0); }
.btn-primary:focus-visible { outline: 2px solid #B45309; outline-offset: 2px; }

/* Secondary — glass */
.btn-secondary {
  height: 44px; padding: 0 20px;
  background: rgba(255,255,255,.7); backdrop-filter: blur(12px);
  border: 1px solid rgba(10,34,64,.15);
  color: #0A2240; font-weight: 600; font-size: 14px;
  border-radius: 10px;
}
.btn-secondary:hover { background: #fff; border-color: rgba(10,34,64,.25); }

/* Ghost (nav) */
.btn-ghost {
  color: #57534E; font-size: 14px; font-weight: 500;
  padding: 8px 12px; border-radius: 8px;
}
.btn-ghost:hover { color: #0A2240; background: rgba(10,34,64,.04); }
```

### 6.2 Cards (3 variants)
```css
.card           { background: #fff; border: 1px solid #E7E5E4; border-radius: 16px; padding: 24px; box-shadow: var(--shadow-sm); transition: all 250ms cubic-bezier(0.16,1,0.3,1); }
.card:hover     { box-shadow: var(--shadow-lg); transform: translateY(-2px); }
.card-glass     { background: rgba(255,255,255,.65); backdrop-filter: blur(16px) saturate(180%); border: 1px solid rgba(255,255,255,.4); border-radius: 16px; padding: 24px; box-shadow: var(--shadow-md); }
.card-feature   { background: #fff; border: 1px solid #E7E5E4; border-radius: 20px; padding: 32px; position: relative; overflow: hidden; }
.card-feature::before { content: ""; position: absolute; inset: 0; background: radial-gradient(closest-side at top right, rgba(245,158,11,.08), transparent 70%); pointer-events: none; }
```

### 6.3 Inputs
```css
.input {
  height: 44px; padding: 0 14px;
  background: #fff; border: 1px solid #E7E5E4; border-radius: 10px;
  font-family: var(--font-body); font-size: 15px; color: #0C0A09;
  transition: border-color 150ms, box-shadow 150ms;
}
.input::placeholder { color: #A8A29E; }
.input:focus { outline: none; border-color: #B45309; box-shadow: 0 0 0 4px rgba(180,83,9,.12); }
.input:disabled { background: #FAFAF9; opacity: .6; cursor: not-allowed; }
```

### 6.4 Navigation header (sticky glass)
```css
.nav-header {
  position: sticky; top: 0; z-index: 50;
  background: rgba(255,255,255,.75); backdrop-filter: blur(20px) saturate(180%);
  border-bottom: 1px solid rgba(231,229,228,.6);
  height: 72px;
}
```

### 6.5 Modal
```css
.modal-overlay { position: fixed; inset: 0; background: rgba(10,34,64,.55); backdrop-filter: blur(8px); z-index: 100; }
.modal { background: #fff; border-radius: 20px; padding: 32px; max-width: 540px; width: 92vw; box-shadow: var(--shadow-xl); }
```

### 6.6 Badges institutionnels
```css
.badge        { display: inline-flex; align-items: center; gap: 6px; height: 24px; padding: 0 10px; border-radius: 999px; font-size: 12px; font-weight: 600; font-family: var(--font-display); }
.badge-navy   { background: rgba(10,34,64,.08);  color: #0A2240; }
.badge-forest { background: rgba(15,81,50,.08);  color: #0F5132; }
.badge-bronze { background: rgba(180,83,9,.10);  color: #B45309; }
.badge-success{ background: rgba(21,128,61,.10); color: #15803D; }
```

---

## 7. Animations & Micro-interactions

| Type | Duration | Easing | Détail |
|---|---|---|---|
| Hover (button, card) | 200ms | `cubic-bezier(0.16, 1, 0.3, 1)` | translate Y -1px, shadow lift |
| Focus ring | 150ms | `ease-out` | scale 1.02 + glow |
| Modal in | 240ms | `cubic-bezier(0.16, 1, 0.3, 1)` | scale 0.96 → 1 + opacity 0 → 1 |
| Modal out | 160ms | `ease-in` | reverse |
| Page transition | 300ms | `ease-out` | translateY 8px → 0 + opacity |
| Stagger list | 50ms par item | `ease-out` | utiliser `style="animation-delay"` |
| Hero glow | 6s infinite | `ease-in-out` | pulse opacity 0.6 → 1 |

**Toujours respecter `prefers-reduced-motion`.**

---

## 8. Accessibilité (WCAG 2.1 AA)

- Contraste texte/fond ≥ 4.5:1 (corps), ≥ 3:1 (texte large)
- Focus ring visible en bronze 700 (≥ 2px, offset 2px)
- Tab order = ordre visuel
- Aria-label sur icônes seules
- `prefers-reduced-motion` désactive les pulse/parallax
- Touch target ≥ 44×44 px
- Tester landing à 375 px et 1440 px

---

## 9. Anti-patterns interdits

- Emojis comme icônes (utiliser Lucide)
- AI purple/pink gradients
- Playful design, neon
- Bodoni Moda / serif décoratives (override du skill)
- Bleu CTA `#0369A1` (override du skill — le CTA est BRONZE)
- Layout shift au hover (toujours `transform`)
- Hover-only (mobile-friendly)
- Pure black `#000` (préférer `#0C0A09`)

---

## 10. Pre-Delivery Checklist

- [ ] Aucune emoji, icônes Lucide uniquement
- [ ] Geist titres + Inter corps chargés
- [ ] CTA principal en gradient bronze + glow
- [ ] Glass cards utilisent `backdrop-filter: blur(16px) saturate(180%)`
- [ ] Layered shadows multi-couches sur élévation
- [ ] Contraste vérifié 4.5:1
- [ ] Focus rings bronze visibles
- [ ] `prefers-reduced-motion` géré
- [ ] Responsive 375 / 768 / 1024 / 1440 testé
- [ ] No horizontal scroll mobile
- [ ] Hero gradient navy → forest avec noise overlay subtil

---

## Annexe — sortie brute du skill (référence)

- **Pattern recommandé :** Marketplace / Directory + Trust & Authority style
- **Couleurs proposées :** Primary `#0F172A`, Accent `#0369A1` — *override appliqué : navy COMILOG `#0A2240` + bronze `#B45309`*
- **Typographie proposée :** Bodoni Moda + Jost — *override appliqué : Geist + Inter (brief utilisateur)*
- **Anti-patterns conservés :** Playful, hidden credentials, AI purple/pink gradients
