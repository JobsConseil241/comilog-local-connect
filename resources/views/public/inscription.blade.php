@extends('layouts.public')
@section('title', 'Inscription PME')

@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.1/build/css/intlTelInput.min.css">
    <style>
        .iti { width: 100%; }
        .iti__tel-input { padding-left: 96px !important; }
        .iti--inline-dropdown .iti__country-list { border-radius: 12px; box-shadow: 0 12px 24px -6px rgba(12,10,9,.10), 0 4px 8px -2px rgba(12,10,9,.06); border: 1px solid #E7E5E4; }
        .iti__selected-country { background: transparent !important; border-right: 1px solid #E7E5E4; }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.1/build/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.querySelector('#telephone');
            if (!input) return;

            const iti = window.intlTelInput(input, {
                initialCountry: 'ga',
                preferredCountries: ['ga', 'cm', 'cg', 'cd', 'fr'],
                separateDialCode: true,
                nationalMode: false,
                formatOnDisplay: true,
                loadUtilsOnInit: 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.1/build/js/utils.js',
            });

            // Format value to E.164 on submit
            const form = input.closest('form');
            if (form) {
                form.addEventListener('submit', function () {
                    if (input.value.trim()) {
                        const fullNumber = iti.getNumber();
                        if (fullNumber) input.value = fullNumber;
                    }
                });
            }
        });
    </script>
@endpush

@section('content')

<section class="relative bg-hero-navy-forest text-white overflow-hidden noise-overlay">
    <div class="absolute -top-20 right-0 w-96 h-96 bg-soft-glow-bronze rounded-full pointer-events-none"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm text-stone-300 hover:text-white transition-colors">
            <x-icon name="arrow-left" :size="14" /> Retour à l'accueil
        </a>
        <span class="badge-glass mt-6">Demande d'inscription</span>
        <h1 class="mt-5 font-display font-bold text-4xl lg:text-5xl tracking-tighter2">Inscrire ma PME sur la plateforme</h1>
        <p class="mt-4 text-stone-300 text-lg max-w-2xl">
            Renseignez les informations de votre entreprise. Votre demande est vérifiée
            par l'équipe COMILOG sous 48h ouvrées.
        </p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-24 relative">
    <form method="POST" action="{{ route('inscription.store') }}" class="space-y-6">
        @csrf

        @if ($errors->any())
            <div class="card border-red-200 bg-red-50/80">
                <h3 class="text-sm font-semibold text-red-800 mb-2 flex items-center gap-2">
                    <x-icon name="x" :size="16" /> Veuillez corriger les erreurs suivantes
                </h3>
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <fieldset class="card-feature">
            <legend class="sr-only">Identité de l'entreprise</legend>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="building" :size="20" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-navy">Identité de l'entreprise</h2>
                    <p class="text-xs text-stone-500">Informations légales et de contact.</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="md:col-span-2"><x-input-label for="raison_sociale" value="Raison sociale *" /><x-text-input id="raison_sociale" name="raison_sociale" type="text" :value="old('raison_sociale')" required /></div>
                <div><x-input-label for="rccm" value="N° RCCM" /><x-text-input id="rccm" name="rccm" type="text" :value="old('rccm')" /></div>
                <div><x-input-label for="nif" value="N° NIF" /><x-text-input id="nif" name="nif" type="text" :value="old('nif')" /></div>
                <div><x-input-label for="ville" value="Ville *" /><x-text-input id="ville" name="ville" type="text" :value="old('ville', 'Moanda')" required /></div>
                <div>
                    <x-input-label for="telephone" value="Téléphone *" />
                    <input id="telephone" name="telephone" type="tel" value="{{ old('telephone') }}" required autocomplete="tel">
                </div>
                <div class="md:col-span-2"><x-input-label for="email_contact" value="Email de contact (entreprise) *" /><x-text-input id="email_contact" name="email_contact" type="email" :value="old('email_contact')" required /></div>
                <div class="md:col-span-2"><x-input-label for="description" value="Brève description de l'activité" /><textarea id="description" name="description" rows="3">{{ old('description') }}</textarea></div>
            </div>
        </fieldset>

        <fieldset class="card-feature">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-forest/10 text-forest flex items-center justify-center"><x-icon name="users" :size="20" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-navy">Représentant légal</h2>
                    <p class="text-xs text-stone-500">Personne en charge du compte.</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div><x-input-label for="representant_nom" value="Nom complet *" /><x-text-input id="representant_nom" name="representant_nom" type="text" :value="old('representant_nom')" required /></div>
                <div><x-input-label for="representant_fonction" value="Fonction *" /><x-text-input id="representant_fonction" name="representant_fonction" type="text" :value="old('representant_fonction', 'Gérant')" required /></div>
            </div>
        </fieldset>

        <fieldset class="card-feature">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-bronze-100 text-bronze-700 flex items-center justify-center"><x-icon name="tag" :size="20" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-navy">Métiers de votre PME *</h2>
                    <p class="text-xs text-stone-500">Vous ne recevrez que les opportunités correspondant à au moins un de vos métiers.</p>
                </div>
            </div>
            <div class="mt-5 grid sm:grid-cols-2 gap-2">
                @foreach($categories as $cat)
                    <label class="group flex items-center gap-3 p-3.5 rounded-xl border border-stone-200 hover:border-bronze-400 hover:bg-bronze-50/50 cursor-pointer transition-colors">
                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                               {{ in_array($cat->id, old('categories', [])) ? 'checked' : '' }}
                               class="rounded border-stone-300 text-bronze-700 focus:ring-bronze-700 w-4 h-4">
                        <span class="w-2 h-2 rounded-full" style="background: {{ $cat->color }};"></span>
                        <span class="text-sm font-medium text-stone-700 group-hover:text-navy">{{ $cat->name }}</span>
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="card-feature">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-navy/5 text-navy flex items-center justify-center"><x-icon name="shield" :size="20" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-navy">Compte d'accès</h2>
                    <p class="text-xs text-stone-500">Identifiants pour vous connecter à votre espace.</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="md:col-span-2"><x-input-label for="user_email" value="Email de connexion *" /><x-text-input id="user_email" name="user_email" type="email" :value="old('user_email')" required /></div>
                <div><x-input-label for="user_password" value="Mot de passe *" /><x-text-input id="user_password" name="user_password" type="password" required /><p class="text-xs text-stone-500 mt-1.5">8 caractères minimum.</p></div>
                <div><x-input-label for="user_password_confirmation" value="Confirmation *" /><x-text-input id="user_password_confirmation" name="user_password_confirmation" type="password" required /></div>
            </div>
        </fieldset>

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('home') }}" class="btn-ghost"><x-icon name="arrow-left" :size="16" /> Annuler</a>
            <button type="submit" class="btn-primary h-12 px-7 text-base">
                Envoyer ma demande
                <x-icon name="arrow-right" :size="18" />
            </button>
        </div>
    </form>
</section>

@endsection
