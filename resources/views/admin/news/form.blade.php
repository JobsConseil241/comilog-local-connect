@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Actualités')
@section('page-title', $article->exists ? "Éditer l'article" : 'Nouvel article')
@section('title', $article->exists ? 'Éditer article' : 'Nouvel article')

@section('content')
<form method="POST" action="{{ $article->exists ? route('admin.news.update', $article) : route('admin.news.store') }}" class="space-y-6 max-w-3xl">
    @csrf
    @if($article->exists) @method('PUT') @endif

    @if ($errors->any())
        <div class="card border-red-200 bg-red-50/80">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card-feature space-y-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="newspaper" :size="20" /></div>
            <h2 class="font-display font-semibold text-lg text-navy">Article SMI</h2>
        </div>

        <div><x-input-label value="Titre *" /><x-text-input name="titre" :value="old('titre', $article->titre)" required /></div>
        <div><x-input-label value="Extrait" /><textarea name="extrait" rows="2">{{ old('extrait', $article->extrait) }}</textarea></div>
        <div><x-input-label value="Contenu *" /><textarea name="contenu" rows="12" required>{{ old('contenu', $article->contenu) }}</textarea></div>
        <div>
            <x-input-label value="Tags (séparés par des virgules)" />
            <x-text-input name="tags" :value="old('tags', is_array($article->tags) ? implode(', ', $article->tags) : '')" placeholder="SMI, HSE, Qualification" />
        </div>

        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-stone-200 hover:border-bronze-400 hover:bg-bronze-50/50 cursor-pointer transition-colors">
            <input type="checkbox" name="publish_now" value="1" @checked(old('publish_now', $article->published_at !== null)) class="rounded border-stone-300 text-bronze-700 focus:ring-bronze-700 w-4 h-4">
            <span class="text-sm font-medium text-stone-700">Publier maintenant</span>
        </label>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.news.index') }}" class="btn-ghost"><x-icon name="arrow-left" :size="14" /> Annuler</a>
        <button type="submit" class="btn-primary">{{ $article->exists ? 'Mettre à jour' : "Créer l'article" }} <x-icon name="check" :size="16" stroke="2.5" /></button>
    </div>
</form>
@endsection
