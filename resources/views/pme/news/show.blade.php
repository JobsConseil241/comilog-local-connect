@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Actualité SMI')
@section('page-title', $article->titre)
@section('title', $article->titre)

@section('content')
<a href="{{ route('pme.news.index') }}" class="btn-ghost mb-4 -ml-3"><x-icon name="arrow-left" :size="14" /> Retour aux actualités</a>

<article class="card-feature p-10 max-w-3xl">
    <div class="flex flex-wrap gap-1.5 mb-4">
        @foreach(($article->tags ?? []) as $tag)
            <span class="badge-bronze">{{ $tag }}</span>
        @endforeach
    </div>
    <h1 class="font-display font-bold text-4xl text-navy tracking-tighter2 leading-tight">{{ $article->titre }}</h1>
    <div class="text-xs text-stone-500 mt-3 flex items-center gap-1.5"><x-icon name="calendar" :size="12" /> Publié le {{ $article->published_at->translatedFormat('d F Y') }}</div>
    @if($article->extrait)
        <p class="text-lg text-stone-600 mt-7 italic leading-relaxed pl-4 border-l-2 border-bronze-400">{{ $article->extrait }}</p>
    @endif
    <div class="prose prose-stone max-w-none mt-7 text-[15px] leading-relaxed text-stone-700 whitespace-pre-line">{{ $article->contenu }}</div>
</article>
@endsection
