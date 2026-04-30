@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'PME')
@section('page-title', $pme->raison_sociale)
@section('title', $pme->raison_sociale)

@section('content')
<a href="{{ route('admin.pmes.index') }}" class="btn-ghost mb-4 -ml-3"><x-icon name="arrow-left" :size="14" /> Liste des PME</a>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="card-feature">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="font-display font-bold text-2xl text-navy tracking-tighter2">{{ $pme->raison_sociale }}</h2>
                    <div class="text-sm text-stone-500 mt-1.5 flex items-center gap-3 flex-wrap">
                        <span class="flex items-center gap-1.5"><x-icon name="map-pin" :size="14" /> {{ $pme->ville }}</span>
                        @if($pme->rccm)<span>·</span><span>RCCM <span class="font-mono">{{ $pme->rccm }}</span></span>@endif
                    </div>
                </div>
                <span class="badge-{{ $pme->status === 'active' ? 'success' : ($pme->status === 'pending' ? 'warning' : 'danger') }}">{{ $pme->status }}</span>
            </div>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-7 pt-6 border-t border-stone-100 text-sm">
                <div><dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">RCCM</dt><dd class="text-navy font-medium mt-1">{{ $pme->rccm ?: '—' }}</dd></div>
                <div><dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">NIF</dt><dd class="text-navy font-medium mt-1">{{ $pme->nif ?: '—' }}</dd></div>
                <div><dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Téléphone</dt><dd class="text-navy font-medium mt-1">{{ $pme->telephone ?: '—' }}</dd></div>
                <div><dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Email</dt><dd class="text-navy font-medium mt-1">{{ $pme->email_contact ?: '—' }}</dd></div>
                <div><dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Représentant</dt><dd class="text-navy font-medium mt-1">{{ $pme->representant_nom }} <span class="text-stone-500 font-normal">({{ $pme->representant_fonction }})</span></dd></div>
                <div><dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold">Source</dt><dd class="text-navy font-medium mt-1">{{ $pme->imported_from_anpi ? 'Import administratif' : 'Inscription en ligne' }}</dd></div>
            </dl>

            @if($pme->description)
                <div class="mt-6 pt-6 border-t border-stone-100">
                    <dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold mb-2">Description</dt>
                    <p class="text-sm text-stone-700 leading-relaxed">{{ $pme->description }}</p>
                </div>
            @endif

            <div class="mt-6 pt-6 border-t border-stone-100">
                <dt class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold mb-3">Métiers</dt>
                <div class="flex flex-wrap gap-1.5">
                    @foreach($pme->categories as $cat)
                        <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        @if($pme->users->isNotEmpty())
        <div class="card overflow-hidden p-0">
            <div class="px-6 py-4 border-b border-stone-100 flex items-center gap-2">
                <x-icon name="users" :size="16" class="text-stone-500" />
                <h3 class="font-display font-semibold text-navy">Comptes utilisateurs liés</h3>
            </div>
            <ul class="divide-y divide-stone-100">
                @foreach($pme->users as $u)
                    <li class="px-6 py-3.5 flex items-center justify-between text-sm">
                        <div>
                            <div class="font-display font-semibold text-navy">{{ $u->name }}</div>
                            <div class="text-xs text-stone-500 mt-0.5">{{ $u->email }}</div>
                        </div>
                        <div class="text-xs text-stone-500">Dernière connexion : {{ $u->last_login_at?->diffForHumans() ?? 'jamais' }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <aside class="space-y-4">
        @if($pme->status === \App\Models\Pme::STATUS_PENDING)
            <form method="POST" action="{{ route('admin.pmes.validate', $pme) }}">
                @csrf
                <button class="w-full inline-flex items-center justify-center gap-2 h-12 rounded-[10px] text-sm font-semibold text-white shadow-glow-forest transition-all hover:-translate-y-0.5 font-display" style="background: linear-gradient(135deg, #15803D 0%, #0F5132 100%);">
                    <x-icon name="check" :size="16" stroke="2.5" /> Valider cette PME
                </button>
            </form>

            <form method="POST" action="{{ route('admin.pmes.reject', $pme) }}" class="card space-y-3">
                @csrf
                <label class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold block">Rejeter avec motif</label>
                <textarea name="rejection_reason" rows="3" required placeholder="Motif de rejet..." style="border-color: #FECACA;"></textarea>
                <button class="w-full inline-flex items-center justify-center gap-2 h-10 rounded-[10px] text-sm font-semibold text-red-700 border border-red-200 hover:bg-red-50 transition-colors font-display">
                    <x-icon name="x" :size="16" /> Rejeter
                </button>
            </form>
        @elseif($pme->status === \App\Models\Pme::STATUS_ACTIVE)
            <form method="POST" action="{{ route('admin.pmes.suspend', $pme) }}">
                @csrf
                <button class="btn-secondary w-full h-12">Suspendre cette PME</button>
            </form>
        @endif

        @if($pme->validated_at)
            <div class="card-glass text-xs text-stone-600 flex items-start gap-2">
                <x-icon name="check-circle" :size="14" class="text-forest mt-0.5 shrink-0" />
                <span>Validée le {{ $pme->validated_at->translatedFormat('d F Y') }}@if($pme->validator) par {{ $pme->validator->name }}@endif.</span>
            </div>
        @endif

        @if($pme->rejection_reason)
            <div class="card border-red-200 bg-red-50/80 text-sm text-red-800">
                <div class="font-display font-semibold mb-1.5 flex items-center gap-1.5"><x-icon name="x" :size="14" /> Motif de rejet</div>
                {{ $pme->rejection_reason }}
            </div>
        @endif
    </aside>
</div>
@endsection
