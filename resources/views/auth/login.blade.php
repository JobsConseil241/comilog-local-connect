<x-guest-layout>
    <div class="mb-8">
        <span class="eyebrow">Connexion</span>
        <h1 class="mt-2 font-display font-bold text-3xl tracking-tighter2 text-navy">Bienvenue sur Local Connect</h1>
        <p class="text-stone-600 mt-2 text-sm">Accédez à votre espace PME ou Admin.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="vous@entreprise.local" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-stone-300 text-bronze-700 focus:ring-bronze-700">
                <span class="ms-2 text-sm text-stone-600">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-stone-600 hover:text-bronze-700 transition-colors" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full h-12 text-base">
            Se connecter
            <x-icon name="arrow-right" :size="18" />
        </button>

        <div class="text-center text-sm text-stone-600 pt-4 border-t border-stone-100">
            Pas encore inscrit ?
            <a href="{{ route('inscription.create') }}" class="text-bronze-700 hover:text-bronze-800 font-semibold">Inscrire ma PME</a>
        </div>
    </form>
</x-guest-layout>
