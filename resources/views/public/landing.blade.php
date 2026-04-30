@extends('layouts.public')
@section('title', 'Connecter, Faire Grandir, Innover')
@section('meta-description', 'COMILOG Local Connect — la plateforme dédiée aux PME Local Content gabonaises. Opportunités, formations, communauté.')

@section('content')

{{-- ════════════ HERO ════════════ --}}
<section class="relative bg-hero-navy-forest text-white overflow-hidden noise-overlay">
    <div class="absolute -top-40 -right-40 w-[640px] h-[640px] bg-soft-glow-bronze rounded-full animate-glow-pulse pointer-events-none"></div>
    <div class="absolute top-40 -left-40 w-[520px] h-[520px] bg-soft-glow-forest rounded-full animate-float-slow pointer-events-none"></div>
    <div class="absolute inset-0 bg-grid-stone bg-grid opacity-[0.03] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-32 lg:pt-32 lg:pb-40">
        <div class="max-w-4xl">
            <div class="inline-flex items-center gap-2.5 mb-8 animate-fade-up text-xs font-semibold uppercase tracking-widest2 text-bronze-300 font-display">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-bronze-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-bronze-500"></span>
                </span>
                COMILOG · Local Content Gabon
            </div>

            <h1 class="font-display font-bold text-5xl sm:text-6xl lg:text-7xl tracking-tighter2 leading-[1.05] animate-fade-up" style="animation-delay: 80ms;">
                Connecter, faire grandir,<br>
                <span class="text-gradient-hero">innover.</span>
            </h1>

            <p class="mt-7 max-w-2xl text-lg lg:text-xl text-stone-300 leading-relaxed animate-fade-up" style="animation-delay: 160ms;">
                Le hub des PME Local Content gabonaises.
                Recevez les opportunités d'affaires, montez en compétences et collaborez
                avec l'écosystème COMILOG en temps réel.
            </p>

            <div class="mt-10 flex flex-wrap gap-3 animate-fade-up" style="animation-delay: 240ms;">
                <a href="{{ route('inscription.create') }}" class="btn-primary h-12 px-6 text-base">
                    Rejoindre le réseau
                    <x-icon name="arrow-right" :size="18" />
                </a>
                <a href="#sme-showcase" class="inline-flex items-center justify-center gap-2 h-12 px-6 rounded-[10px] text-base font-semibold text-white border border-white/20 bg-white/5 backdrop-blur transition hover:bg-white/10 hover:border-white/30 font-display">
                    Découvrir les PME
                </a>
            </div>

            <div class="mt-14 grid grid-cols-2 sm:grid-cols-4 gap-px bg-white/10 rounded-2xl overflow-hidden border border-white/10 animate-fade-up" style="animation-delay: 320ms;">
                <div class="bg-navy-800/60 backdrop-blur p-5">
                    <div class="font-display text-3xl font-bold text-white tabular-nums">{{ $stats['pmes'] }}</div>
                    <div class="text-xs uppercase tracking-widest2 text-stone-400 mt-1">PME inscrites</div>
                </div>
                <div class="bg-navy-800/60 backdrop-blur p-5">
                    <div class="font-display text-3xl font-bold text-white tabular-nums">{{ $stats['opportunities'] }}</div>
                    <div class="text-xs uppercase tracking-widest2 text-stone-400 mt-1">Opportunités</div>
                </div>
                <div class="bg-navy-800/60 backdrop-blur p-5">
                    <div class="font-display text-3xl font-bold text-white tabular-nums">{{ $stats['trainings'] }}</div>
                    <div class="text-xs uppercase tracking-widest2 text-stone-400 mt-1">Formations</div>
                </div>
                <div class="bg-navy-800/60 backdrop-blur p-5">
                    <div class="font-display text-3xl font-bold text-white tabular-nums">{{ $stats['categories'] }}</div>
                    <div class="text-xs uppercase tracking-widest2 text-stone-400 mt-1">Métiers</div>
                </div>
            </div>
        </div>
    </div>

</section>

{{-- ════════════ ABOUT / PARTNERS ════════════ --}}
<section id="about" class="py-24 lg:py-32 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="eyebrow">Mission &amp; Vision</span>
                <h2 class="mt-3 font-display font-bold text-3xl lg:text-5xl tracking-tighter2 text-navy">
                    Réduire l'asymétrie d'information.<br>
                    <span class="text-forest">Renforcer le tissu local.</span>
                </h2>
                <p class="mt-6 text-stone-600 leading-relaxed text-lg">
                    COMILOG, acteur minier de premier plan au Gabon, décline la politique d'achats responsables
                    du Groupe ERAMET. Cette plateforme structure les échanges entre les PME Local Content
                    et les opportunités du groupe.
                </p>
                <ul class="mt-8 space-y-3">
                    <li class="flex items-start gap-3"><span class="mt-0.5 shrink-0 w-6 h-6 rounded-full bg-forest/10 text-forest flex items-center justify-center"><x-icon name="check" :size="14" stroke="2.5" /></span><span class="text-stone-700">Conformité IRMA &amp; standards internationaux</span></li>
                    <li class="flex items-start gap-3"><span class="mt-0.5 shrink-0 w-6 h-6 rounded-full bg-forest/10 text-forest flex items-center justify-center"><x-icon name="check" :size="14" stroke="2.5" /></span><span class="text-stone-700">Loi gabonaise n°037/2018 sur le secteur minier</span></li>
                    <li class="flex items-start gap-3"><span class="mt-0.5 shrink-0 w-6 h-6 rounded-full bg-forest/10 text-forest flex items-center justify-center"><x-icon name="check" :size="14" stroke="2.5" /></span><span class="text-stone-700">Politique d'achats responsables Groupe ERAMET</span></li>
                </ul>
            </div>

            <div class="relative">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-soft-glow-bronze rounded-full pointer-events-none"></div>
                <div class="relative grid gap-4">
                    <div class="card-glass border-stone-200/80">
                        <div class="flex items-center gap-4">
                            <div class="bg-white rounded-xl p-3 shadow-soft"><img src="{{ asset('images/comilog-logo.png') }}" alt="COMILOG" class="h-10 w-auto"></div>
                            <div>
                                <div class="font-display font-bold text-navy">COMILOG</div>
                                <div class="text-xs text-stone-500">Groupe ERAMET · Acteur minier de référence</div>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-stone-600">Exploitation responsable du manganèse à Moanda, Haut-Ogooué.</p>
                    </div>

                    <div class="card-glass border-stone-200/80">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-forest/10 text-forest flex items-center justify-center shadow-soft"><x-icon name="leaf" :size="26" /></div>
                            <div>
                                <div class="font-display font-bold text-navy">Local Content</div>
                                <div class="text-xs text-stone-500">Politique d'achats responsables ERAMET</div>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-stone-600">Renforcer le tissu industriel et commercial gabonais autour de la chaîne de valeur minière.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════ FEATURES ════════════ --}}
<section id="features" class="py-24 lg:py-32 relative bg-stone-100/60">
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-bronze-400/40 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="eyebrow">Six modules · une plateforme</span>
            <h2 class="mt-3 font-display font-bold text-3xl lg:text-5xl tracking-tighter2 text-navy">
                Tout ce dont votre PME a besoin pour <span class="text-gradient-bronze">grandir</span>.
            </h2>
            <p class="mt-4 text-stone-600 text-lg">Conçu pour la réalité opérationnelle des PME du Haut-Ogooué et du Gabon.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @php
                $features = [
                    ['icon' => 'building',     'color' => 'navy',    'title' => 'Annuaire PME',           'desc' => 'Découvrez les entreprises locales par secteur, services et localisation.'],
                    ['icon' => 'briefcase',    'color' => 'bronze',  'title' => "Opportunités d'affaires", 'desc' => "Appels d'offres, consultations, demandes de devis ciblés par votre métier."],
                    ['icon' => 'graduation',   'color' => 'forest',  'title' => 'Centre de formation',     'desc' => 'HSE, IRMA, qualification fournisseur et accompagnement business management.'],
                    ['icon' => 'message-square','color' => 'navy',   'title' => 'Forums communautaires',   'desc' => 'Échangez, posez vos questions, partagez vos retours d\'expérience.'],
                    ['icon' => 'calendar',     'color' => 'bronze',  'title' => 'Événements networking',   'desc' => 'Rencontres physiques et virtuelles avec les acheteurs COMILOG.'],
                    ['icon' => 'mail',         'color' => 'forest',  'title' => 'Messagerie sécurisée',   'desc' => 'Communication directe entre PME et référents de la plateforme.'],
                ];
            @endphp

            @foreach($features as $i => $f)
                <div class="card-feature group animate-fade-up" style="animation-delay: {{ $i * 60 }}ms;">
                    <div class="relative">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5
                            @if($f['color']==='navy') bg-navy text-white shadow-glow-navy
                            @elseif($f['color']==='bronze') bg-cta-bronze text-white shadow-glow-bronze
                            @else bg-forest text-white shadow-glow-forest
                            @endif">
                            <x-icon :name="$f['icon']" :size="22" stroke="2" />
                        </div>
                        <h3 class="font-display font-semibold text-lg text-navy">{{ $f['title'] }}</h3>
                        <p class="mt-2 text-sm text-stone-600 leading-relaxed">{{ $f['desc'] }}</p>
                        <div class="mt-5 flex items-center gap-1 text-xs font-semibold text-bronze-700 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition-all duration-300">
                            En savoir plus <x-icon name="arrow-right" :size="14" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════ SME SHOWCASE ════════════ --}}
<section id="sme-showcase" class="py-24 lg:py-32 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12 flex-wrap gap-4">
            <div>
                <span class="eyebrow">Communauté</span>
                <h2 class="mt-3 font-display font-bold text-3xl lg:text-5xl tracking-tighter2 text-navy">PME à l'honneur</h2>
                <p class="mt-3 text-stone-600 text-lg max-w-xl">Quelques-unes des PME locales qui font vivre l'écosystème.</p>
            </div>
            <a href="{{ route('inscription.create') }}" class="btn-secondary">
                Faire partie du réseau
                <x-icon name="arrow-right" :size="16" />
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($categories->take(6) as $cat)
                <article class="card group">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center font-display font-bold text-lg" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">
                            {{ collect(explode(' ', $cat->name))->take(2)->map(fn($w) => mb_substr($w, 0, 1))->implode('') }}
                        </div>
                        <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                    </div>
                    <h3 class="mt-5 font-display font-semibold text-navy">PME du secteur {{ Str::lower($cat->name) }}</h3>
                    <p class="mt-1 text-sm text-stone-600">Toutes les PME de cette catégorie reçoivent automatiquement les opportunités correspondantes.</p>
                    <div class="mt-4 flex items-center justify-between text-xs text-stone-500">
                        <span class="flex items-center gap-1.5"><x-icon name="users" :size="14" /> Réseau actif</span>
                        <span class="text-bronze-700 font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Voir →</span>
                    </div>
                </article>
            @empty
                <p class="col-span-3 text-center text-stone-500 py-12">Aucune catégorie disponible.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ════════════ LATEST OPPORTUNITIES ════════════ --}}
@if($latestOpportunities->isNotEmpty())
<section id="opportunities-preview" class="py-24 lg:py-32 bg-stone-100/60 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12 flex-wrap gap-4">
            <div>
                <span class="eyebrow">Aperçu en direct</span>
                <h2 class="mt-3 font-display font-bold text-3xl lg:text-5xl tracking-tighter2 text-navy">Dernières opportunités</h2>
            </div>
            <a href="{{ route('login') }}" class="btn-ghost text-sm">
                Se connecter pour tout voir
                <x-icon name="arrow-right" :size="14" />
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-5">
            @foreach($latestOpportunities as $opp)
                <article class="card group">
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach($opp->categories as $cat)
                            <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                    <h3 class="font-display font-semibold text-navy text-lg leading-snug">{{ $opp->titre }}</h3>
                    @if($opp->deadline)
                        <div class="mt-4 pt-4 border-t border-stone-100 flex items-center gap-2 text-xs text-stone-500">
                            <x-icon name="calendar" :size="14" />
                            Date limite : <span class="text-stone-700 font-medium">{{ $opp->deadline->translatedFormat('d F Y') }}</span>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════ TESTIMONIALS ════════════ --}}
<section class="py-24 lg:py-32 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="eyebrow">Témoignages</span>
            <h2 class="mt-3 font-display font-bold text-3xl lg:text-5xl tracking-tighter2 text-navy">
                Ils font grandir <span class="text-forest">le local content</span>.
            </h2>
        </div>

        <div class="grid lg:grid-cols-3 gap-5">
            @php
                $testimonials = [
                    ['quote' => "Grâce à la plateforme, nous accédons aux opportunités COMILOG sans intermédiaire. Notre carnet de commandes a doublé en 6 mois.", 'name' => 'Marie-Claire OBAME', 'role' => 'Gérante, BTP Moanda Construction'],
                    ['quote' => "Le filtrage par métier est un gain de temps énorme. On reçoit uniquement ce qui nous concerne, plus de bruit.", 'name' => 'Jean-Pierre NGUEMA', 'role' => 'Directeur, TransLog Haut-Ogooué'],
                    ['quote' => "Les formations HSE et IRMA nous ont permis de nous qualifier durablement comme fournisseur référencé.", 'name' => 'Aïcha BOUKINDA', 'role' => 'CEO, Gabon Tech Services'],
                ];
            @endphp
            @foreach($testimonials as $t)
                <figure class="card relative">
                    <x-icon name="quote" :size="32" class="text-bronze-300 mb-4" stroke="1.25" />
                    <blockquote class="text-stone-700 leading-relaxed text-[15px]">« {{ $t['quote'] }} »</blockquote>
                    <figcaption class="mt-6 pt-6 border-t border-stone-100">
                        <div class="font-display font-semibold text-navy">{{ $t['name'] }}</div>
                        <div class="text-xs text-stone-500 mt-0.5">{{ $t['role'] }}</div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════ HOW IT WORKS ════════════ --}}
<section id="resources" class="py-24 lg:py-32 bg-stone-100/60 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="eyebrow">Comment ça marche</span>
            <h2 class="mt-3 font-display font-bold text-3xl lg:text-5xl tracking-tighter2 text-navy">Trois étapes pour démarrer</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-5 relative">
            <div class="hidden md:block absolute top-12 left-[16.66%] right-[16.66%] h-px bg-gradient-to-r from-transparent via-bronze-400/40 to-transparent"></div>

            @foreach([
                ['n' => '01', 'title' => 'Inscription', 'desc' => 'Créez le compte de votre PME en sélectionnant vos métiers en quelques minutes.'],
                ['n' => '02', 'title' => 'Validation', 'desc' => 'L\'équipe COMILOG vérifie votre dossier sous 48h ouvrées.'],
                ['n' => '03', 'title' => 'Activité', 'desc' => 'Recevez opportunités, formations et actualités ciblées par votre métier.'],
            ] as $i => $step)
                <div class="card-glass text-center relative animate-fade-up" style="animation-delay: {{ $i * 100 }}ms;">
                    <div class="mx-auto w-24 h-24 rounded-full bg-white flex items-center justify-center mb-6 shadow-lifted relative">
                        @if($i === 2)
                            <span class="absolute inset-0 rounded-full bg-soft-glow-bronze"></span>
                        @endif
                        <span class="relative font-display font-bold text-2xl {{ $i === 2 ? 'text-bronze-700' : 'text-navy' }}">{{ $step['n'] }}</span>
                    </div>
                    <h3 class="font-display font-semibold text-xl text-navy">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-sm text-stone-600">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════ FINAL CTA ════════════ --}}
<section class="py-24 lg:py-32 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-hero-navy-forest p-10 lg:p-20 text-center noise-overlay">
            <div class="absolute -top-20 -right-20 w-96 h-96 bg-soft-glow-bronze rounded-full animate-glow-pulse pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-soft-glow-forest rounded-full pointer-events-none"></div>

            <div class="relative z-10">
                <span class="badge-glass">Prêt à démarrer ?</span>
                <h2 class="mt-6 font-display font-bold text-4xl lg:text-6xl tracking-tighter2 text-white leading-[1.1]">
                    Faites grandir votre PME<br>
                    <span class="text-gradient-hero">au cœur du Gabon.</span>
                </h2>
                <p class="mt-6 max-w-xl mx-auto text-stone-300 text-lg">
                    Rejoignez la communauté des PME local content déjà connectées à COMILOG.
                </p>
                <div class="mt-10 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('inscription.create') }}" class="btn-primary h-12 px-7 text-base">
                        Inscrire ma PME
                        <x-icon name="arrow-right" :size="18" />
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 h-12 px-7 rounded-[10px] text-base font-semibold text-white border border-white/20 bg-white/5 backdrop-blur transition hover:bg-white/10 font-display">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
