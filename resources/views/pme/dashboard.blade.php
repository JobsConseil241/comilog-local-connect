@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Espace PME')
@section('page-title', 'Tableau de bord')
@section('title', 'Tableau de bord')

@section('content')
@if($pme && $pme->status !== \App\Models\Pme::STATUS_ACTIVE)
    <div class="card border-bronze-200 bg-bronze-50/60 mb-6">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-bronze-100 text-bronze-700 flex items-center justify-center shrink-0"><x-icon name="shield" :size="20" /></div>
            <div>
                <div class="font-display font-semibold text-bronze-700">Compte en attente de validation</div>
                <p class="text-sm text-stone-600 mt-0.5">Votre PME a le statut « <strong>{{ $pme->status }}</strong> ». L'accès complet aux opportunités sera ouvert dès validation par notre équipe (sous 48h ouvrées).</p>
            </div>
        </div>
    </div>
@endif

{{-- HERO greeting --}}
<div class="mb-8">
    <div class="font-display text-3xl font-bold text-navy tracking-tighter2">Bonjour {{ explode(' ', auth()->user()->name)[0] }}.</div>
    <p class="text-stone-600 mt-1">Voici les dernières opportunités correspondant à vos métiers.</p>
</div>

{{-- KPI cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php
        $tiles = [
            ['label' => 'Opportunités', 'value' => $stats['opportunities'], 'sub' => 'Pour vos métiers', 'icon' => 'briefcase', 'color' => 'bronze'],
            ['label' => 'Formations',   'value' => $stats['trainings'],     'sub' => 'À venir',         'icon' => 'graduation','color' => 'forest'],
            ['label' => 'Actualités',   'value' => $stats['news'],          'sub' => 'Publiées',        'icon' => 'newspaper', 'color' => 'navy'],
            ['label' => 'Vos métiers',  'value' => $stats['categories'],    'sub' => 'Catégories',      'icon' => 'tag',       'color' => 'navy'],
        ];
    @endphp
    @foreach($tiles as $t)
        <div class="card-feature">
            <div class="flex items-center justify-between">
                <span class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">{{ $t['label'] }}</span>
                <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    @if($t['color']==='bronze') bg-bronze-100 text-bronze-700
                    @elseif($t['color']==='forest') bg-forest/10 text-forest
                    @else bg-navy/5 text-navy
                    @endif"><x-icon :name="$t['icon']" :size="18" /></span>
            </div>
            <div class="font-display text-4xl font-bold text-navy mt-3 tabular-nums tracking-tighter2">{{ $t['value'] }}</div>
            <div class="text-xs text-stone-500 mt-1">{{ $t['sub'] }}</div>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Latest opportunities --}}
    <div class="lg:col-span-2 card overflow-hidden p-0">
        <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
            <div>
                <h3 class="font-display font-semibold text-navy">Dernières opportunités</h3>
                <p class="text-xs text-stone-500 mt-0.5">Filtrées sur vos métiers actifs</p>
            </div>
            <a href="{{ route('pme.opportunities.index') }}" class="btn-ghost text-xs">Tout voir <x-icon name="arrow-right" :size="14" /></a>
        </div>
        <div class="divide-y divide-stone-100">
            @forelse($opportunities as $opp)
                <a href="{{ route('pme.opportunities.show', $opp) }}" class="group block px-6 py-4 hover:bg-stone-50/60 transition-colors">
                    <div class="flex flex-wrap gap-1.5 mb-2">
                        @foreach($opp->categories as $cat)
                            <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                    <div class="font-display font-semibold text-navy group-hover:text-bronze-700 transition-colors">{{ $opp->titre }}</div>
                    <div class="text-xs text-stone-500 mt-1.5 flex items-center gap-3 flex-wrap">
                        <span>{{ \App\Models\Opportunity::TYPES[$opp->type] }}</span>
                        @if($opp->deadline)
                            <span class="flex items-center gap-1"><x-icon name="calendar" :size="12" /> {{ $opp->deadline->translatedFormat('d M Y') }}</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="px-6 py-16 text-center">
                    <div class="mx-auto w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-3"><x-icon name="briefcase" :size="20" /></div>
                    <p class="text-sm text-stone-500">Aucune opportunité ne correspond actuellement à vos métiers.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Side cards --}}
    <div class="space-y-6">
        <div class="card overflow-hidden p-0">
            <div class="px-5 py-3 border-b border-stone-100 flex items-center gap-2">
                <x-icon name="graduation" :size="16" class="text-forest" />
                <h3 class="font-display font-semibold text-navy text-sm">Prochaines formations</h3>
            </div>
            <div class="divide-y divide-stone-100">
                @forelse($trainings as $t)
                    <div class="px-5 py-3">
                        <div class="font-display font-semibold text-sm text-navy leading-snug">{{ $t->titre }}</div>
                        <div class="text-xs text-stone-500 mt-1 flex items-center gap-2">
                            <x-icon name="calendar" :size="12" />
                            {{ $t->date_debut->translatedFormat('d M') }}
                            @if($t->lieu) · {{ $t->lieu }} @endif
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-6 text-center text-xs text-stone-500">Aucune formation à venir.</div>
                @endforelse
            </div>
        </div>

        <div class="card overflow-hidden p-0">
            <div class="px-5 py-3 border-b border-stone-100 flex items-center gap-2">
                <x-icon name="newspaper" :size="16" class="text-navy" />
                <h3 class="font-display font-semibold text-navy text-sm">Actualités récentes</h3>
            </div>
            <div class="divide-y divide-stone-100">
                @forelse($news as $n)
                    <a href="{{ route('pme.news.show', $n) }}" class="block px-5 py-3 hover:bg-stone-50/60 transition-colors">
                        <div class="font-display font-semibold text-sm text-navy leading-snug">{{ $n->titre }}</div>
                        <div class="text-xs text-stone-500 mt-1">{{ $n->published_at->diffForHumans() }}</div>
                    </a>
                @empty
                    <div class="px-5 py-6 text-center text-xs text-stone-500">Aucune actualité.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
