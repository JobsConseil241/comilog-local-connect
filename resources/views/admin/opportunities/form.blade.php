@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Opportunités')
@section('page-title', $opportunity->exists ? "Éditer l'opportunité" : 'Nouvelle opportunité')
@section('title', $opportunity->exists ? 'Éditer' : 'Nouvelle opportunité')

@section('content')
<form method="POST" action="{{ $opportunity->exists ? route('admin.opportunities.update', $opportunity) : route('admin.opportunities.store') }}" class="space-y-6 max-w-4xl">
    @csrf
    @if($opportunity->exists) @method('PUT') @endif

    @if ($errors->any())
        <div class="card border-red-200 bg-red-50/80">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card-feature space-y-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-bronze-100 text-bronze-700 flex items-center justify-center"><x-icon name="briefcase" :size="20" /></div>
            <h2 class="font-display font-semibold text-lg text-navy">Détails de l'opportunité</h2>
        </div>

        <div><x-input-label value="Titre *" /><x-text-input name="titre" :value="old('titre', $opportunity->titre)" required /></div>
        <div><x-input-label value="Description *" /><textarea name="description" rows="8" required>{{ old('description', $opportunity->description) }}</textarea></div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <x-input-label value="Type *" />
                <select name="type" required>
                    @foreach(\App\Models\Opportunity::TYPES as $key => $label)
                        <option value="{{ $key }}" @selected(old('type', $opportunity->type) === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-input-label value="Statut *" />
                <select name="status" required>
                    <option value="draft" @selected(old('status', $opportunity->status) === 'draft')>Brouillon</option>
                    <option value="published" @selected(old('status', $opportunity->status) === 'published')>Publié</option>
                    <option value="closed" @selected(old('status', $opportunity->status) === 'closed')>Clos</option>
                </select>
            </div>
            <div><x-input-label value="Date limite" /><x-text-input type="date" name="deadline" :value="old('deadline', $opportunity->deadline?->toDateString())" /></div>
            <div><x-input-label value="Budget estimé" /><x-text-input name="budget_estime" :value="old('budget_estime', $opportunity->budget_estime)" /></div>
            <div><x-input-label value="Lieu d'exécution" /><x-text-input name="lieu_execution" :value="old('lieu_execution', $opportunity->lieu_execution)" /></div>
            <div><x-input-label value="Contact (nom)" /><x-text-input name="contact_nom" :value="old('contact_nom', $opportunity->contact_nom)" /></div>
            <div class="md:col-span-2"><x-input-label value="Contact (email)" /><x-text-input type="email" name="contact_email" :value="old('contact_email', $opportunity->contact_email)" /></div>
        </div>
    </div>

    <div class="card-feature">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="tag" :size="20" /></div>
            <div>
                <h2 class="font-display font-semibold text-lg text-navy">Métiers ciblés *</h2>
                <p class="text-xs text-stone-500">Seules les PME ayant au moins un de ces métiers verront cette opportunité.</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-2">
            @foreach($categories as $cat)
                <label class="group flex items-center gap-3 p-3.5 rounded-xl border border-stone-200 hover:border-bronze-400 hover:bg-bronze-50/50 cursor-pointer transition-colors">
                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                           {{ in_array($cat->id, old('categories', $selectedCategoryIds)) ? 'checked' : '' }}
                           class="rounded border-stone-300 text-bronze-700 focus:ring-bronze-700 w-4 h-4">
                    <span class="w-2 h-2 rounded-full" style="background: {{ $cat->color }};"></span>
                    <span class="text-sm font-medium text-stone-700 group-hover:text-navy">{{ $cat->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.opportunities.index') }}" class="btn-ghost"><x-icon name="arrow-left" :size="14" /> Annuler</a>
        <button type="submit" class="btn-primary">{{ $opportunity->exists ? 'Mettre à jour' : "Créer l'opportunité" }} <x-icon name="check" :size="16" stroke="2.5" /></button>
    </div>
</form>
@endsection
