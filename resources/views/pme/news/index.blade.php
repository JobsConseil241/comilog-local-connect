@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Espace PME')
@section('page-title', 'Actualités SMI')
@section('title', 'Actualités')

@section('content')
<div class="space-y-4 max-w-4xl">
    @forelse($news as $n)
        <a href="{{ route('pme.news.show', $n) }}" class="block card-feature group">
            <div class="flex flex-wrap gap-1.5 mb-3">
                @foreach(($n->tags ?? []) as $tag)
                    <span class="badge-bronze">{{ $tag }}</span>
                @endforeach
            </div>
            <h3 class="font-display font-semibold text-xl text-navy group-hover:text-bronze-700 transition-colors leading-snug">{{ $n->titre }}</h3>
            @if($n->extrait)
                <p class="text-sm text-stone-600 mt-2.5 leading-relaxed">{{ $n->extrait }}</p>
            @endif
            <div class="text-xs text-stone-500 mt-4 flex items-center justify-between">
                <span class="flex items-center gap-1.5"><x-icon name="calendar" :size="12" /> {{ $n->published_at->translatedFormat('d F Y') }}</span>
                <span class="text-bronze-700 font-semibold opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">Lire <x-icon name="arrow-right" :size="12" /></span>
            </div>
        </a>
    @empty
        <div class="card text-center py-16">
            <div class="mx-auto w-14 h-14 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-4"><x-icon name="newspaper" :size="22" /></div>
            <p class="text-stone-600">Aucune actualité publiée.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $news->links() }}</div>
@endsection
