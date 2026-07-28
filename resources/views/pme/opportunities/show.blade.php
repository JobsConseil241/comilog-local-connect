@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Opportunité')
@section('page-title', $opportunity->titre)
@section('title', $opportunity->titre)

@section('content')
<a href="{{ route('pme.opportunities.index') }}" class="btn-ghost mb-4 -ml-3"><x-icon name="arrow-left" :size="14" /> Retour aux opportunités</a>

<div class="grid lg:grid-cols-3 gap-6">
    <article class="lg:col-span-2 card-feature p-8">
        <div class="flex flex-wrap gap-1.5 mb-4">
            <span class="badge bg-stone-100 text-stone-600 font-mono text-[11px]">{{ $opportunity->reference }}</span>
            @foreach($opportunity->categories as $cat)
                <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
            @endforeach
        </div>
        <h1 class="font-display font-bold text-3xl text-navy tracking-tighter2 leading-tight">{{ $opportunity->titre }}</h1>
        <div class="text-xs text-stone-500 mt-2.5 flex items-center gap-1.5">
            <x-icon name="calendar" :size="12" /> Publié le {{ $opportunity->published_at?->translatedFormat('d F Y') }}
        </div>

        <div class="prose prose-stone max-w-none mt-8 text-[15px] leading-relaxed text-stone-700 whitespace-pre-line">{{ $opportunity->description }}</div>
    </article>

    <aside class="space-y-4">
        {{-- Interest signal --}}
        @if($alreadyInterested)
            <div class="card-glass border-forest/20 flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-forest/10 text-forest flex items-center justify-center shrink-0"><x-icon name="check-circle" :size="20" /></div>
                <div class="min-w-0">
                    <div class="font-display font-semibold text-navy text-sm">Intérêt transmis</div>
                    <p class="text-xs text-stone-600 mt-1 leading-relaxed">Le service Achats COMILOG a été notifié. Vous serez recontacté par les canaux habituels.</p>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('pme.opportunities.interested', $opportunity) }}">
                @csrf
                <button type="submit" class="btn-primary w-full h-12">
                    Je suis intéressé
                    <x-icon name="arrow-right" :size="16" />
                </button>
            </form>
            @if(! $matchesMetier)
                <div class="text-xs text-stone-500 flex items-start gap-2 px-1 leading-relaxed">
                    <x-icon name="shield" :size="14" class="text-bronze-700 mt-0.5 shrink-0" />
                    <span>Cette opportunité ne recoupe pas les métiers déclarés par votre PME. Vous pouvez tout de même manifester votre intérêt.</span>
                </div>
            @endif
        @endif

        <div class="card">
            <h3 class="font-display font-semibold text-navy text-sm mb-4">Informations clés</h3>
            <dl class="space-y-4 text-sm">
                <div>
                    <dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Type</dt>
                    <dd class="text-navy font-medium mt-1">{{ \App\Models\Opportunity::TYPES[$opportunity->type] }}</dd>
                </div>
                @if($opportunity->deadline)
                    <div>
                        <dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Date limite</dt>
                        <dd class="text-navy font-medium mt-1 flex items-center gap-1.5"><x-icon name="calendar" :size="14" class="text-bronze-700" /> {{ $opportunity->deadline->translatedFormat('d F Y') }}</dd>
                    </div>
                @endif
                @if($opportunity->budget_estime)
                    <div>
                        <dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Budget estimé</dt>
                        <dd class="text-navy font-medium mt-1">{{ $opportunity->budget_estime }}</dd>
                    </div>
                @endif
                @if($opportunity->lieu_execution)
                    <div>
                        <dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Lieu d'exécution</dt>
                        <dd class="text-navy font-medium mt-1 flex items-center gap-1.5"><x-icon name="map-pin" :size="14" class="text-stone-500" /> {{ $opportunity->lieu_execution }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        @if($opportunity->contact_email)
        <div class="card-glass">
            <h3 class="font-display font-semibold text-navy text-sm mb-3">Contact</h3>
            @if($opportunity->contact_nom)<div class="text-sm text-navy font-medium">{{ $opportunity->contact_nom }}</div>@endif
            <a href="mailto:{{ $opportunity->contact_email }}" class="mt-2 btn-primary w-full text-xs h-10 px-4">
                <x-icon name="mail" :size="14" /> Contacter
            </a>
        </div>
        @endif
    </aside>
</div>
@endsection
