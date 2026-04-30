<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0A2240">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-stone-700 bg-stone-50">
<div class="min-h-screen grid lg:grid-cols-5">

    {{-- LEFT — Brand panel (lg+) --}}
    <aside class="hidden lg:flex lg:col-span-2 flex-col justify-between bg-hero-navy-forest text-white p-12 relative overflow-hidden noise-overlay">
        <div class="absolute -top-32 -right-32 w-[480px] h-[480px] bg-soft-glow-bronze rounded-full animate-glow-pulse pointer-events-none"></div>
        <div class="absolute bottom-0 -left-32 w-80 h-80 bg-soft-glow-forest rounded-full pointer-events-none"></div>

        <a href="{{ route('home') }}" class="relative z-10 inline-block bg-white rounded-xl px-3 py-2 self-start">
            <x-application-logo />
        </a>

        <div class="relative z-10 max-w-md">
            <span class="badge-glass">Local Content · Gabon</span>
            <h2 class="mt-6 font-display font-bold text-4xl tracking-tighter2 leading-[1.1]">
                Connecter,<br>faire grandir,<br>
                <span class="text-gradient-hero">innover.</span>
            </h2>
            <p class="mt-5 text-stone-300 leading-relaxed">
                Plateforme dédiée aux PME local content gabonaises.
                Recevez en avant-première les opportunités d'affaires de COMILOG.
            </p>
            <div class="mt-10 flex items-center gap-4">
                <div class="bg-white rounded-lg p-2"><img src="{{ asset('images/comilog-logo.png') }}" alt="COMILOG" class="h-7 w-auto"></div>
            </div>
        </div>

        <div class="relative z-10 text-xs text-stone-500">
            © {{ date('Y') }} COMILOG · Groupe ERAMET
        </div>
    </aside>

    {{-- RIGHT — Form panel --}}
    <div class="lg:col-span-3 flex flex-col justify-center px-6 py-12 lg:px-16 relative">
        <div class="lg:hidden mb-8">
            <a href="{{ route('home') }}"><x-application-logo /></a>
        </div>
        <div class="w-full max-w-md mx-auto">
            {{ $slot }}
        </div>
    </div>
</div>
</body>
</html>
