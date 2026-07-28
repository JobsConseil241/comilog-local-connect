<!DOCTYPE html>
<html lang="fr" class="h-full bg-stone-50 scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta-description', 'Plateforme COMILOG (Groupe ERAMET) dédiée aux PME Local Content gabonaises. Opportunités d\'affaires, formations, actualités SMI.')">
    <meta name="theme-color" content="#0A2240">
    <title>@yield('title', 'COMILOG Local Connect') · {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-full antialiased text-stone-700" x-data="{ mobileOpen: false }" @keydown.escape.window="mobileOpen = false">

<header class="nav-glass">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center" aria-label="Accueil COMILOG Local Connect">
            <x-application-logo />
        </a>

        <nav class="hidden md:flex items-center gap-1" aria-label="Navigation principale">
            <a href="{{ route('home') }}#about" class="btn-ghost">À propos</a>
            <a href="{{ route('home') }}#features" class="btn-ghost">Plateforme</a>
            <a href="{{ route('home') }}#sme-showcase" class="btn-ghost">PME</a>
            <a href="{{ route('home') }}#resources" class="btn-ghost">Ressources</a>
        </nav>

        <div class="flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-secondary hidden sm:inline-flex">
                    Mon espace
                    <x-icon name="arrow-right" :size="16" />
                </a>
                <a href="{{ route('dashboard') }}" class="btn-secondary sm:hidden !h-10 !px-3" aria-label="Mon espace">
                    <x-icon name="arrow-right" :size="16" />
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost hidden sm:inline-flex">Connexion</a>
                <a href="{{ route('inscription.create') }}" class="btn-primary hidden sm:inline-flex">
                    Rejoindre
                    <x-icon name="arrow-right" :size="16" />
                </a>
                <a href="{{ route('inscription.create') }}" class="btn-primary sm:hidden !h-10 !px-3.5 text-xs">
                    Rejoindre
                </a>
            @endauth

            {{-- Mobile burger --}}
            <button type="button" @click="mobileOpen = true" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-navy hover:bg-navy/5 transition-colors" aria-label="Ouvrir le menu" :aria-expanded="mobileOpen">
                <x-icon name="menu" :size="22" />
            </button>
        </div>
    </div>
</header>

{{-- Mobile drawer — sibling of <header> to escape the header's backdrop-filter containing block --}}
<div x-show="mobileOpen"
     x-transition.opacity
     @click="mobileOpen = false"
     class="fixed inset-0 z-[60] bg-navy-900/60 backdrop-blur-sm md:hidden"
     style="display: none;"
     aria-hidden="true"></div>

<aside x-show="mobileOpen"
       x-transition:enter="transition ease-expo-out duration-300"
       x-transition:enter-start="translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="translate-x-full"
       class="fixed top-0 right-0 bottom-0 z-[70] w-[85vw] max-w-sm bg-stone-50 shadow-floating md:hidden flex flex-col"
       style="display: none;"
       role="dialog"
       aria-modal="true"
       aria-label="Menu de navigation">
    <div class="h-[72px] px-5 flex items-center justify-between border-b border-stone-200 bg-white shrink-0">
        <x-application-logo />
        <button type="button" @click="mobileOpen = false" class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-stone-600 hover:bg-stone-100 transition-colors" aria-label="Fermer le menu">
            <x-icon name="x" :size="22" />
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1" aria-label="Navigation mobile">
        <a href="{{ route('home') }}#about" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-3 rounded-lg text-base font-medium text-navy hover:bg-navy/5 transition-colors">
            <x-icon name="building" :size="18" class="text-stone-400" /> À propos
        </a>
        <a href="{{ route('home') }}#features" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-3 rounded-lg text-base font-medium text-navy hover:bg-navy/5 transition-colors">
            <x-icon name="layout-grid" :size="18" class="text-stone-400" /> Plateforme
        </a>
        <a href="{{ route('home') }}#sme-showcase" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-3 rounded-lg text-base font-medium text-navy hover:bg-navy/5 transition-colors">
            <x-icon name="users" :size="18" class="text-stone-400" /> PME
        </a>
        <a href="{{ route('home') }}#resources" @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-3 rounded-lg text-base font-medium text-navy hover:bg-navy/5 transition-colors">
            <x-icon name="graduation" :size="18" class="text-stone-400" /> Ressources
        </a>
    </nav>

    <div class="p-4 border-t border-stone-200 space-y-2 shrink-0">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-primary w-full">Mon espace <x-icon name="arrow-right" :size="16" /></a>
        @else
            <a href="{{ route('inscription.create') }}" class="btn-primary w-full">Rejoindre <x-icon name="arrow-right" :size="16" /></a>
            <a href="{{ route('login') }}" class="btn-secondary w-full">Connexion</a>
        @endauth
    </div>
</aside>

<main>
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="card-glass border-forest/20 text-forest text-sm flex items-center gap-3">
                <x-icon name="check-circle" :size="18" />
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @yield('content')
</main>

<footer class="relative mt-32 bg-navy-800 text-stone-300 noise-overlay overflow-hidden">
    <div class="absolute -top-32 -right-32 w-[480px] h-[480px] bg-soft-glow-forest rounded-full pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-[480px] h-[480px] bg-soft-glow-bronze rounded-full pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-5">
                <div class="bg-white inline-block rounded-xl px-3 py-2 mb-5">
                    <x-application-logo />
                </div>
                <p class="text-sm leading-relaxed text-stone-400 max-w-md">
                    Plateforme numérique dédiée aux PME Local Content gabonaises,
                    portée par <strong class="text-white font-medium">COMILOG (Groupe ERAMET)</strong>.
                    Connecter, faire grandir, innover ensemble.
                </p>
                <div class="mt-6 flex items-center gap-4">
                    <div class="bg-white rounded-lg p-2"><img src="{{ asset('images/comilog-logo.png') }}" alt="COMILOG" class="h-7 w-auto"></div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="font-display text-white font-semibold text-sm mb-4">Plateforme</div>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-bronze-400 transition-colors">Accueil</a></li>
                    <li><a href="{{ route('inscription.create') }}" class="hover:text-bronze-400 transition-colors">Inscription PME</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-bronze-400 transition-colors">Connexion</a></li>
                </ul>
            </div>

            <div class="lg:col-span-2">
                <div class="font-display text-white font-semibold text-sm mb-4">Ressources</div>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#" class="hover:text-bronze-400 transition-colors">Centre de formation</a></li>
                    <li><a href="#" class="hover:text-bronze-400 transition-colors">Standard IRMA</a></li>
                    <li><a href="#" class="hover:text-bronze-400 transition-colors">Procédure achats</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <div class="font-display text-white font-semibold text-sm mb-4">Contact</div>
                <ul class="space-y-2.5 text-sm">
                    <li class="flex items-start gap-2"><x-icon name="map-pin" :size="16" class="mt-0.5 text-stone-500 shrink-0" /><span>Moanda, Haut-Ogooué — Gabon</span></li>
                    <li class="flex items-center gap-2"><x-icon name="mail" :size="16" class="text-stone-500" /><a href="mailto:contact@comilog.local" class="hover:text-bronze-400 transition-colors">contact@comilog.local</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-white/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 text-xs text-stone-500">
            <div>© {{ date('Y') }} COMILOG · Groupe ERAMET. Tous droits réservés.</div>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-stone-300 transition-colors">Mentions légales</a>
                <span class="w-px h-3 bg-stone-700"></span>
                <a href="#" class="hover:text-stone-300 transition-colors">Confidentialité</a>
                <span class="w-px h-3 bg-stone-700"></span>
                <a href="#" class="hover:text-stone-300 transition-colors">Cookies</a>
            </div>
        </div>
    </div>
</footer>

{{-- Back to top --}}
<button type="button"
        x-data="{ visible: false }"
        x-init="window.addEventListener('scroll', () => visible = window.scrollY > 480, { passive: true })"
        x-show="visible"
        x-transition.opacity.duration.300ms
        @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="btn-back-top"
        style="display: none;"
        aria-label="Retour en haut de la page"
        title="Retour en haut">
    <x-icon name="arrow-up" :size="20" stroke="2.25" />
</button>

@stack('scripts')
</body>
</html>
