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
<body class="min-h-full antialiased text-stone-700">

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
                <a href="{{ route('dashboard') }}" class="btn-secondary">
                    Mon espace
                    <x-icon name="arrow-right" :size="16" />
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost hidden sm:inline-flex">Connexion</a>
                <a href="{{ route('inscription.create') }}" class="btn-primary">
                    Rejoindre
                    <x-icon name="arrow-right" :size="16" />
                </a>
            @endauth
        </div>
    </div>
</header>

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

@stack('scripts')
</body>
</html>
