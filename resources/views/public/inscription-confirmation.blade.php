@extends('layouts.public')
@section('title', 'Demande envoyée')

@section('content')
<section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
    <div class="relative inline-flex">
        <div class="absolute inset-0 bg-soft-glow-forest rounded-full"></div>
        <div class="relative mx-auto w-20 h-20 rounded-full bg-forest text-white flex items-center justify-center shadow-glow-forest">
            <x-icon name="check" :size="36" stroke="2.5" />
        </div>
    </div>
    <h1 class="mt-8 font-display font-bold text-4xl tracking-tighter2 text-navy">Demande bien envoyée</h1>
    <p class="mt-4 text-stone-600 leading-relaxed text-lg">
        L'équipe COMILOG examine votre dossier sous <strong class="text-navy font-medium">48h ouvrées</strong>.
        Vous recevrez un email à l'adresse renseignée dès l'activation de votre compte.
    </p>
    <div class="mt-10 flex flex-wrap justify-center gap-3">
        <a href="{{ route('home') }}" class="btn-primary">
            Retour à l'accueil
            <x-icon name="arrow-right" :size="16" />
        </a>
        <a href="{{ route('login') }}" class="btn-secondary">Se connecter</a>
    </div>
</section>
@endsection
