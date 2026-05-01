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
<body class="min-h-full antialiased text-stone-700" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
<div class="min-h-screen flex">

    {{-- DESKTOP SIDEBAR (lg+) --}}
    <aside class="hidden lg:flex lg:flex-col w-64 sidebar-dark relative noise-overlay">
        <div class="h-[72px] px-5 flex items-center border-b border-white/5 bg-white/[0.03] backdrop-blur">
            <a href="{{ route('home') }}" class="bg-white/95 rounded-lg px-2.5 py-1.5"><x-application-logo /></a>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto" aria-label="Navigation principale">
            @stack('sidebar')
        </nav>
        <div class="px-5 py-4 border-t border-white/5 text-[11px] text-stone-500 uppercase tracking-widest2 font-display">
            v0.1 MVP · COMILOG
        </div>
    </aside>

    {{-- MOBILE SIDEBAR (off-canvas) --}}
    <div x-show="sidebarOpen"
         x-transition.opacity
         @click="sidebarOpen = false"
         class="fixed inset-0 z-[60] bg-navy-900/70 backdrop-blur-sm lg:hidden"
         style="display: none;"
         aria-hidden="true"></div>

    <aside x-show="sidebarOpen"
           x-transition:enter="transition ease-expo-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed top-0 left-0 bottom-0 z-[70] w-[80vw] max-w-xs sidebar-dark noise-overlay flex flex-col lg:hidden shadow-floating"
           style="display: none;"
           role="dialog"
           aria-modal="true"
           aria-label="Menu de navigation">
        <div class="h-[72px] px-5 flex items-center justify-between border-b border-white/5 bg-white/[0.03] backdrop-blur">
            <a href="{{ route('home') }}" class="bg-white/95 rounded-lg px-2.5 py-1.5"><x-application-logo /></a>
            <button type="button" @click="sidebarOpen = false" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-stone-300 hover:bg-white/10 transition-colors" aria-label="Fermer le menu">
                <x-icon name="x" :size="20" />
            </button>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto" aria-label="Navigation mobile">
            @stack('sidebar')
        </nav>
        <div class="px-5 py-4 border-t border-white/5 text-[11px] text-stone-500 uppercase tracking-widest2 font-display">
            v0.1 MVP · COMILOG
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="nav-glass">
            <div class="h-full flex items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 min-w-0">
                    {{-- Mobile burger --}}
                    <button type="button" @click="sidebarOpen = true" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-navy hover:bg-navy/5 transition-colors shrink-0" aria-label="Ouvrir le menu" :aria-expanded="sidebarOpen">
                        <x-icon name="menu" :size="22" />
                    </button>
                    <div class="min-w-0">
                        <div class="text-[10px] sm:text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">@yield('section', 'Espace')</div>
                        <h1 class="font-display font-bold text-base sm:text-lg text-navy tracking-tightish truncate">@yield('page-title', 'Tableau de bord')</h1>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <button type="button" class="btn-ghost relative !w-10 !px-0 justify-center" aria-label="Notifications">
                        <x-icon name="bell" :size="18" />
                    </button>
                    <div class="text-right hidden md:block pl-2 border-l border-stone-200">
                        <div class="font-display text-sm font-semibold text-navy leading-tight max-w-[140px] truncate">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] text-stone-500 mt-0.5">
                            @if(auth()->user()->isAdmin()) Admin COMILOG
                            @else Représentant PME
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-ghost !w-10 !px-0 justify-center" aria-label="Déconnexion" title="Déconnexion">
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
