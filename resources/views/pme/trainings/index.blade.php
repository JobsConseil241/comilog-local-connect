@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Espace PME')
@section('page-title', 'Formations')
@section('title', 'Formations')

@section('content')
<div class="grid md:grid-cols-2 gap-5">
    @forelse($trainings as $t)
        <article class="card-feature">
            <div class="flex items-start justify-between gap-4">
                <span class="badge-bronze">
                    <x-icon name="calendar" :size="12" />
                    {{ $t->date_debut->translatedFormat('d M Y') }}
                    @if($t->date_fin && !$t->date_fin->equalTo($t->date_debut)) → {{ $t->date_fin->translatedFormat('d M') }} @endif
                </span>
                @if($t->places_disponibles)
                    <span class="badge bg-stone-100 text-stone-600">{{ $t->places_disponibles }} places</span>
                @endif
            </div>
            <h3 class="font-display font-semibold text-xl text-navy mt-4 leading-snug">{{ $t->titre }}</h3>
            <p class="text-sm text-stone-600 mt-2 line-clamp-3">{{ $t->description }}</p>
            <div class="mt-5 pt-5 border-t border-stone-100 space-y-2 text-xs text-stone-600">
                @if($t->lieu)<div class="flex items-center gap-2"><x-icon name="map-pin" :size="14" class="text-stone-400" /> {{ $t->lieu }}</div>@endif
                @if($t->contact_email)
                    <div class="flex items-center gap-2"><x-icon name="mail" :size="14" class="text-stone-400" />
                        <a href="mailto:{{ $t->contact_email }}" class="text-navy hover:text-bronze-700 font-medium transition-colors">{{ $t->contact_email }}</a>
                    </div>
                @endif
            </div>
        </article>
    @empty
        <div class="md:col-span-2 card text-center py-16">
            <div class="mx-auto w-14 h-14 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-4"><x-icon name="graduation" :size="22" /></div>
            <p class="text-stone-600">Aucune formation à venir pour le moment.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $trainings->links() }}</div>
@endsection
