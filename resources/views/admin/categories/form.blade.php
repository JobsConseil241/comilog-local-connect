@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Catégories')
@section('page-title', $category->exists ? 'Éditer la catégorie' : 'Nouvelle catégorie')
@section('title', 'Catégorie — Admin')

@section('content')
<form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="space-y-6 max-w-xl">
    @csrf
    @if($category->exists) @method('PUT') @endif

    @if ($errors->any())
        <div class="card border-red-200 bg-red-50/80">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card-feature space-y-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="tag" :size="20" /></div>
            <h2 class="font-display font-semibold text-lg text-navy">Catégorie métier</h2>
        </div>

        <div><x-input-label value="Nom *" /><x-text-input name="name" :value="old('name', $category->name)" required /></div>
        <div><x-input-label value="Description" /><textarea name="description" rows="3">{{ old('description', $category->description) }}</textarea></div>

        <div>
            <x-input-label value="Couleur (hex)" />
            <div class="flex items-center gap-3 mt-1.5">
                <input type="color" name="color" value="{{ old('color', $category->color ?: '#0A2240') }}" class="!h-11 !w-16 !p-1 cursor-pointer">
                <span class="text-xs text-stone-500">Utilisée pour les badges et graphiques.</span>
            </div>
        </div>

        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-stone-200 hover:border-bronze-400 hover:bg-bronze-50/50 cursor-pointer transition-colors">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true)) class="rounded border-stone-300 text-bronze-700 focus:ring-bronze-700 w-4 h-4">
            <span class="text-sm font-medium text-stone-700">Catégorie active</span>
        </label>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.categories.index') }}" class="btn-ghost"><x-icon name="arrow-left" :size="14" /> Annuler</a>
        <button type="submit" class="btn-primary">{{ $category->exists ? 'Mettre à jour' : 'Créer la catégorie' }} <x-icon name="check" :size="16" stroke="2.5" /></button>
    </div>
</form>
@endsection
