@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Pilotage')
@section('page-title', 'Tableau de bord — KPI')
@section('title', 'KPI Admin')

@section('content')
{{-- KPI grid --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="card-feature">
        <div class="flex items-center justify-between">
            <span class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">PME actives</span>
            <span class="w-9 h-9 rounded-xl bg-forest/10 text-forest flex items-center justify-center"><x-icon name="users" :size="18" /></span>
        </div>
        <div class="font-display text-4xl font-bold text-navy mt-3 tabular-nums tracking-tighter2">{{ $kpis['pmes_total'] }}</div>
        <div class="text-xs text-forest mt-1.5 flex items-center gap-1"><x-icon name="trending-up" :size="12" /> +{{ $kpis['pmes_30d'] }} sur 30j</div>
    </div>

    <div class="card-feature relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-soft-glow-bronze rounded-full"></div>
        <div class="relative">
            <div class="flex items-center justify-between">
                <span class="text-[11px] uppercase tracking-widest2 text-bronze-700 font-display font-semibold">À valider</span>
                <span class="w-9 h-9 rounded-xl bg-bronze-100 text-bronze-700 flex items-center justify-center"><x-icon name="shield" :size="18" /></span>
            </div>
            <div class="font-display text-4xl font-bold text-bronze-700 mt-3 tabular-nums tracking-tighter2">{{ $kpis['pmes_pending'] }}</div>
            <a href="{{ route('admin.pmes.index', ['status' => 'pending']) }}" class="text-xs text-bronze-700 hover:underline mt-1.5 inline-flex items-center gap-1 font-semibold">Voir <x-icon name="arrow-right" :size="12" /></a>
        </div>
    </div>

    <div class="card-feature">
        <div class="flex items-center justify-between">
            <span class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Opportunités</span>
            <span class="w-9 h-9 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="briefcase" :size="18" /></span>
        </div>
        <div class="font-display text-4xl font-bold text-navy mt-3 tabular-nums tracking-tighter2">{{ $kpis['opportunities_total'] }}</div>
        <div class="text-xs text-stone-500 mt-1.5">+{{ $kpis['opportunities_30d'] }} sur 30j</div>
    </div>

    <div class="card-feature">
        <div class="flex items-center justify-between">
            <span class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Formations</span>
            <span class="w-9 h-9 rounded-xl bg-forest/10 text-forest flex items-center justify-center"><x-icon name="graduation" :size="18" /></span>
        </div>
        <div class="font-display text-4xl font-bold text-navy mt-3 tabular-nums tracking-tighter2">{{ $kpis['trainings_total'] }}</div>
        <div class="text-xs text-stone-500 mt-1.5">À venir</div>
    </div>
</div>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="card text-center">
        <div class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Actualités</div>
        <div class="font-display text-3xl font-bold text-navy mt-2 tabular-nums">{{ $kpis['news_total'] }}</div>
    </div>
    <div class="card text-center">
        <div class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Métiers actifs</div>
        <div class="font-display text-3xl font-bold text-navy mt-2 tabular-nums">{{ $kpis['categories_total'] }}</div>
    </div>
    <div class="card text-center">
        <div class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">PME actives 30j</div>
        <div class="font-display text-3xl font-bold text-navy mt-2 tabular-nums">{{ $kpis['active_users_30d'] }}</div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    {{-- PME par catégorie --}}
    <div class="card overflow-hidden p-0">
        <div class="px-6 py-4 border-b border-stone-100 flex items-center gap-2">
            <x-icon name="tag" :size="16" class="text-stone-500" />
            <h3 class="font-display font-semibold text-navy">Répartition PME par métier</h3>
        </div>
        <div class="p-6 space-y-4">
            @forelse($pmesByCategory as $row)
                @php $max = $pmesByCategory->max('total'); $pct = $max > 0 ? ($row->total / $max * 100) : 0; @endphp
                <div>
                    <div class="flex items-center justify-between text-sm mb-1.5">
                        <span class="font-medium text-stone-700 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full" style="background: {{ $row->color }};"></span>
                            {{ $row->name }}
                        </span>
                        <span class="text-stone-500 tabular-nums font-display font-semibold">{{ $row->total }}</span>
                    </div>
                    <div class="h-1.5 rounded-full bg-stone-100 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500" style="width: {{ $pct }}%; background: linear-gradient(90deg, {{ $row->color }}, {{ $row->color }}cc);"></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-stone-500 text-center py-6">Aucune PME inscrite par catégorie.</p>
            @endforelse
        </div>
    </div>

    {{-- Recent PMEs --}}
    <div class="card overflow-hidden p-0">
        <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-icon name="users" :size="16" class="text-stone-500" />
                <h3 class="font-display font-semibold text-navy">Dernières PME</h3>
            </div>
            <a href="{{ route('admin.pmes.index') }}" class="btn-ghost text-xs">Voir tout <x-icon name="arrow-right" :size="12" /></a>
        </div>
        <div class="divide-y divide-stone-100">
            @foreach($recentPmes as $p)
                <a href="{{ route('admin.pmes.show', $p) }}" class="group flex items-center justify-between px-6 py-3 hover:bg-stone-50/60 transition-colors">
                    <div class="min-w-0">
                        <div class="font-display font-semibold text-stone-800 group-hover:text-navy transition-colors truncate">{{ $p->raison_sociale }}</div>
                        <div class="text-xs text-stone-500 mt-0.5">{{ $p->ville }} · {{ $p->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="badge-{{ $p->status === 'active' ? 'success' : ($p->status === 'pending' ? 'warning' : 'danger') }}">{{ $p->status }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="card overflow-hidden p-0 mt-6">
    <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <x-icon name="briefcase" :size="16" class="text-stone-500" />
            <h3 class="font-display font-semibold text-navy">Dernières opportunités créées</h3>
        </div>
        <a href="{{ route('admin.opportunities.index') }}" class="btn-ghost text-xs">Voir tout <x-icon name="arrow-right" :size="12" /></a>
    </div>
    <div class="divide-y divide-stone-100">
        @foreach($recentOpportunities as $o)
            <div class="px-6 py-3.5 flex items-center justify-between gap-4">
                <div class="min-w-0">
                    <div class="font-display font-semibold text-stone-800 truncate">{{ $o->titre }}</div>
                    <div class="text-xs text-stone-500 mt-1 flex items-center gap-2 flex-wrap">
                        <span class="font-mono">{{ $o->reference }}</span>
                        <span>· {{ $o->created_at->diffForHumans() }}</span>
                        @foreach($o->categories as $cat)
                            <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                </div>
                <span class="badge-{{ $o->status === 'published' ? 'success' : ($o->status === 'draft' ? 'warning' : 'danger') }}">{{ $o->status }}</span>
            </div>
        @endforeach
    </div>
</div>
@endsection
