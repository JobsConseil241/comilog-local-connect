@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Communauté')
@section('page-title', 'PME inscrites')
@section('title', 'PME — Admin')

@section('content')
<div class="card mb-4 p-0">
    <form method="GET" class="p-4 flex flex-wrap gap-3 items-end">
        <div class="min-w-[160px]">
            <label class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold block mb-1.5">Statut</label>
            <select name="status">
                <option value="">Tous</option>
                <option value="pending" @selected($currentStatus === 'pending')>En attente</option>
                <option value="active" @selected($currentStatus === 'active')>Actives</option>
                <option value="suspended" @selected($currentStatus === 'suspended')>Suspendues</option>
                <option value="rejected" @selected($currentStatus === 'rejected')>Rejetées</option>
            </select>
        </div>
        <div class="flex-1 min-w-[240px]">
            <label class="text-[11px] uppercase tracking-widest2 text-stone-500 font-display font-semibold block mb-1.5">Recherche</label>
            <div class="relative">
                <x-icon name="search" :size="16" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400" />
                <input type="text" name="q" value="{{ $searchTerm }}" placeholder="Raison sociale, RCCM, email..." class="!pl-10">
            </div>
        </div>
        <button class="btn-primary">Filtrer <x-icon name="search" :size="14" /></button>
    </form>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Raison sociale</th>
                <th>Ville</th>
                <th>Métiers</th>
                <th>Statut</th>
                <th>Inscrite le</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($pmes as $pme)
                <tr>
                    <td><div class="font-display font-semibold text-navy">{{ $pme->raison_sociale }}</div></td>
                    <td class="text-stone-600">{{ $pme->ville }}</td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @foreach($pme->categories->take(2) as $cat)
                                <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                            @endforeach
                            @if($pme->categories->count() > 2)<span class="text-xs text-stone-500">+{{ $pme->categories->count() - 2 }}</span>@endif
                        </div>
                    </td>
                    <td><span class="badge-{{ $pme->status === 'active' ? 'success' : ($pme->status === 'pending' ? 'warning' : 'danger') }}">{{ $pme->status }}</span></td>
                    <td class="text-stone-500 text-xs">{{ $pme->created_at->translatedFormat('d M Y') }}</td>
                    <td class="text-right"><a href="{{ route('admin.pmes.show', $pme) }}" class="btn-ghost text-xs"><x-icon name="eye" :size="14" /> Voir</a></td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-16">
                    <div class="mx-auto w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-3"><x-icon name="users" :size="20" /></div>
                    <p class="text-stone-500">Aucune PME ne correspond à vos critères.</p>
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $pmes->links() }}</div>
@endsection
