<x-guest-layout>
    <div class="mb-8">
        <a href="{{ route('login') }}" class="btn-ghost -ml-3 mb-4"><x-icon name="arrow-left" :size="14" /> Retour</a>
        <span class="eyebrow">Mot de passe</span>
        <h1 class="mt-2 font-display font-bold text-3xl tracking-tighter2 text-navy">Réinitialiser mon mot de passe</h1>
        <p class="text-stone-600 mt-3 text-sm leading-relaxed">
            Saisissez votre email. Nous vous enverrons un lien sécurisé pour définir un nouveau mot de passe.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="vous@entreprise.local" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full h-12 text-base">
            Envoyer le lien
            <x-icon name="mail" :size="18" />
        </button>
    </form>
</x-guest-layout>
