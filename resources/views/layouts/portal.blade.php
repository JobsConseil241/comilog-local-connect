<!DOCTYPE html>
<html lang="fr" class="h-full bg-stone-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0A2240">
    <title>@yield('title', 'Mon espace') · {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full antialiased text-stone-700">
<div class="min-h-screen flex">

    {{-- SIDEBAR DARK GLASS --}}
    <aside class="hidden lg:flex lg:flex-col w-64 sidebar-dark relative noise-overlay">
        <div class="h-[72px] px-5 flex items-center border-b border-white/5 bg-white/[0.03] backdrop-blur">
            <a href="{{ route('home') }}" class="bg-white/95 rounded-lg px-2.5 py-1.5"><x-application-logo /></a>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto">
            @stack('sidebar')
        </nav>
        <div class="px-5 py-4 border-t border-white/5 text-[11px] text-stone-500 uppercase tracking-widest2 font-display">
            v0.1 MVP · COMILOG
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="nav-glass">
            <div class="h-full flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="min-w-0">
                    <div class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">@yield('section', 'Espace')</div>
                    <h1 class="font-display font-bold text-lg text-navy tracking-tightish truncate">@yield('page-title', 'Tableau de bord')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" class="btn-ghost relative" aria-label="Notifications">
                        <x-icon name="bell" :size="18" />
                    </button>
                    <div class="text-right hidden sm:block pl-2 border-l border-stone-200">
                        <div class="font-display text-sm font-semibold text-navy leading-tight">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] text-stone-500 mt-0.5">
                            @if(auth()->user()->isAdmin()) Admin COMILOG
                            @else Représentant PME
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-ghost" aria-label="Déconnexion" title="Déconnexion">
                            <x-icon name="logout" :size="18" />
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-[1600px] w-full">
            @if (session('success'))
                <div class="mb-6 card-glass border-forest/20 text-forest text-sm flex items-center gap-3">
                    <x-icon name="check-circle" :size="18" />
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 card border-red-200 bg-red-50/80 text-red-800 text-sm flex items-center gap-3">
                    <x-icon name="x" :size="18" />
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
