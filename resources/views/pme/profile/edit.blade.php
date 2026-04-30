@extends('layouts.portal')
@include('pme._sidebar')

@section('section', 'Espace PME')
@section('page-title', "Profil de l'entreprise")
@section('title', 'Profil PME')

@section('content')
@if(! $pme)
    <div class="card text-stone-500">Aucune PME associée à votre compte.</div>
@else
<form method="POST" action="{{ route('pme.profile.update') }}" class="space-y-6 max-w-4xl">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="card border-red-200 bg-red-50/80">
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card-feature">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="building" :size="20" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-navy">Informations entreprise</h2>
                    <p class="text-xs text-stone-500">Statut actuel de votre PME.</p>
                </div>
            </div>
            <span class="badge-{{ $pme->status === 'active' ? 'success' : ($pme->status === 'pending' ? 'warning' : 'danger') }}">{{ $pme->status }}</span>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="md:col-span-2"><x-input-label value="Raison sociale *" /><x-text-input name="raison_sociale" :value="old('raison_sociale', $pme->raison_sociale)" required /></div>
            <div><x-input-label value="N° RCCM" /><x-text-input name="rccm" :value="old('rccm', $pme->rccm)" /></div>
            <div><x-input-label value="N° NIF" /><x-text-input name="nif" :value="old('nif', $pme->nif)" /></div>
            <div><x-input-label value="Ville *" /><x-text-input name="ville" :value="old('ville', $pme->ville)" required /></div>
            <div><x-input-label value="Téléphone *" /><x-text-input name="telephone" :value="old('telephone', $pme->telephone)" required /></div>
            <div class="md:col-span-2"><x-input-label value="Email contact *" /><x-text-input name="email_contact" type="email" :value="old('email_contact', $pme->email_contact)" required /></div>
            <div class="md:col-span-2"><x-input-label value="Description" /><textarea name="description" rows="3">{{ old('description', $pme->description) }}</textarea></div>
        </div>
    </div>

    <div class="card-feature">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-forest/10 text-forest flex items-center justify-center"><x-icon name="users" :size="20" /></div>
            <div>
                <h2 class="font-display font-semibold text-lg text-navy">Représentant légal</h2>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div><x-input-label value="Nom complet *" /><x-text-input name="representant_nom" :value="old('representant_nom', $pme->representant_nom)" required /></div>
            <div><x-input-label value="Fonction *" /><x-text-input name="representant_fonction" :value="old('representant_fonction', $pme->representant_fonction)" required /></div>
        </div>
    </div>

    <div class="card-feature">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-bronze-100 text-bronze-700 flex items-center justify-center"><x-icon name="tag" :size="20" /></div>
            <div>
                <h2 class="font-display font-semibold text-lg text-navy">Métiers *</h2>
                <p class="text-xs text-stone-500">Catégories qui détermineront les opportunités reçues.</p>
            </div>
        </div>
        <div class="mt-5 grid sm:grid-cols-2 gap-2">
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

    <div class="flex justify-end">
        <button type="submit" class="btn-primary">Enregistrer les modifications <x-icon name="check" :size="16" /></button>
    </div>
</form>
@endif
@endsection
