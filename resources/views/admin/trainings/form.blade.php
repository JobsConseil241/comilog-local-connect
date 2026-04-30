@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Formations')
@section('page-title', $training->exists ? 'Éditer la formation' : 'Nouvelle formation')
@section('title', $training->exists ? 'Éditer formation' : 'Nouvelle formation')

@section('content')
<form method="POST" action="{{ $training->exists ? route('admin.trainings.update', $training) : route('admin.trainings.store') }}" class="space-y-6 max-w-3xl">
    @csrf
    @if($training->exists) @method('PUT') @endif

    @if ($errors->any())
        <div class="card border-red-200 bg-red-50/80">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card-feature space-y-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-forest/10 text-forest flex items-center justify-center"><x-icon name="graduation" :size="20" /></div>
            <h2 class="font-display font-semibold text-lg text-navy">Détails de la formation</h2>
        </div>

        <div><x-input-label value="Titre *" /><x-text-input name="titre" :value="old('titre', $training->titre)" required /></div>
        <div><x-input-label value="Description *" /><textarea name="description" rows="6" required>{{ old('description', $training->description) }}</textarea></div>

        <div class="grid md:grid-cols-2 gap-4">
            <div><x-input-label value="Date début *" /><x-text-input type="date" name="date_debut" :value="old('date_debut', $training->date_debut?->toDateString())" required /></div>
            <div><x-input-label value="Date fin" /><x-text-input type="date" name="date_fin" :value="old('date_fin', $training->date_fin?->toDateString())" /></div>
            <div><x-input-label value="Lieu" /><x-text-input name="lieu" :value="old('lieu', $training->lieu)" /></div>
            <div><x-input-label value="Places disponibles" /><x-text-input type="number" min="0" name="places_disponibles" :value="old('places_disponibles', $training->places_disponibles)" /></div>
            <div><x-input-label value="Email d'inscription" /><x-text-input type="email" name="contact_email" :value="old('contact_email', $training->contact_email)" /></div>
            <div>
                <x-input-label value="Statut *" />
                <select name="status" required>
                    <option value="draft" @selected(old('status', $training->status) === 'draft')>Brouillon</option>
                    <option value="published" @selected(old('status', $training->status) === 'published')>Publié</option>
                    <option value="closed" @selected(old('status', $training->status) === 'closed')>Clos</option>
                </select>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.trainings.index') }}" class="btn-ghost"><x-icon name="arrow-left" :size="14" /> Annuler</a>
        <button type="submit" class="btn-primary">{{ $training->exists ? 'Mettre à jour' : 'Créer la formation' }} <x-icon name="check" :size="16" stroke="2.5" /></button>
    </div>
</form>
@endsection
