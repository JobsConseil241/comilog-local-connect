@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Espace PME')
@section('page-title', "Opportunités d'affaires")
@section('title', "Opportunités d'affaires")

@section('content')
<div class="card overflow-hidden p-0">
    <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between">
        <div>
            <h2 class="font-display font-semibold text-navy">{{ $opportunities->total() }} opportunité{{ $opportunities->total() > 1 ? 's' : '' }} ouverte{{ $opportunities->total() > 1 ? 's' : '' }}</h2>
            <p class="text-xs text-stone-500 mt-0.5">Filtrées sur les métiers de votre PME</p>
        </div>
    </div>
    <div class="divide-y divide-stone-100">
        @forelse($opportunities as $opp)
            <a href="{{ route('pme.opportunities.show', $opp) }}" class="group block px-6 py-5 hover:bg-stone-50/60 transition-colors">
                <div class="flex items-start gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap gap-1.5 mb-2">
                            <span class="badge bg-stone-100 text-stone-600 font-mono text-[11px]">{{ $opp->reference }}</span>
                            @foreach($opp->categories as $cat)
                                <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                        <div class="font-display font-semibold text-navy text-lg group-hover:text-bronze-700 transition-colors">{{ $opp->titre }}</div>
                        <p class="text-sm text-stone-600 mt-1.5 line-clamp-2">{{ Str::limit(strip_tags($opp->description), 200) }}</p>
                        <div class="text-xs text-stone-500 mt-3.5 flex flex-wrap gap-x-5 gap-y-1.5">
                            <span class="flex items-center gap-1.5"><x-icon name="tag" :size="12" /> {{ \App\Models\Opportunity::TYPES[$opp->type] }}</span>
                            @if($opp->deadline)<span class="flex items-center gap-1.5"><x-icon name="calendar" :size="12" /> Limite : <strong class="text-stone-700">{{ $opp->deadline->translatedFormat('d F Y') }}</strong></span>@endif
                            @if($opp->lieu_execution)<span class="flex items-center gap-1.5"><x-icon name="map-pin" :size="12" /> {{ $opp->lieu_execution }}</span>@endif
                        </div>
                    </div>
                    <x-icon name="chevron-right" :size="20" class="text-stone-300 group-hover:text-bronze-700 group-hover:translate-x-1 transition-all" />
                </div>
            </a>
        @empty
            <div class="px-6 py-20 text-center">
                <div class="mx-auto w-14 h-14 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-4"><x-icon name="briefcase" :size="22" /></div>
                <p class="text-stone-600">Aucune opportunité ne correspond actuellement à vos métiers.</p>
                <a href="{{ route('pme.profile.edit') }}" class="btn-secondary mt-5">Mettre à jour mes métiers</a>
            </div>
        @endforelse
    </div>
</div>

<div class="mt-6">{{ $opportunities->links() }}</div>
@endsection
