@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Publications')
@section('page-title', "Opportunités d'affaires")
@section('title', 'Opportunités — Admin')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <form method="GET">
        <select name="status" onchange="this.form.submit()" class="!w-auto">
            <option value="">Tous statuts</option>
            <option value="draft" @selected($currentStatus === 'draft')>Brouillon</option>
            <option value="published" @selected($currentStatus === 'published')>Publiées</option>
            <option value="closed" @selected($currentStatus === 'closed')>Closes</option>
        </select>
    </form>
    <a href="{{ route('admin.opportunities.create') }}" class="btn-primary"><x-icon name="plus" :size="16" /> Nouvelle opportunité</a>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Titre</th>
                <th>Métiers</th>
                <th>Statut</th>
                <th>Date limite</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($opportunities as $opp)
                <tr>
                    <td class="font-mono text-xs text-stone-600">{{ $opp->reference }}</td>
                    <td><div class="font-display font-semibold text-navy">{{ $opp->titre }}</div></td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @foreach($opp->categories->take(2) as $cat)
                                <span class="badge" style="background: {{ $cat->color }}1A; color: {{ $cat->color }};">{{ $cat->name }}</span>
                            @endforeach
                            @if($opp->categories->count() > 2)<span class="text-xs text-stone-500">+{{ $opp->categories->count() - 2 }}</span>@endif
                        </div>
                    </td>
                    <td><span class="badge-{{ $opp->status === 'published' ? 'success' : ($opp->status === 'draft' ? 'warning' : 'danger') }}">{{ $opp->status }}</span></td>
                    <td class="text-stone-500 text-xs">{{ $opp->deadline?->translatedFormat('d M Y') ?: '—' }}</td>
                    <td class="text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.opportunities.edit', $opp) }}" class="btn-ghost text-xs"><x-icon name="edit" :size="14" /></a>
                            <form method="POST" action="{{ route('admin.opportunities.destroy', $opp) }}" onsubmit="return confirm('Supprimer cette opportunité ?')">
                                @csrf @method('DELETE')
                                <button class="btn-ghost text-xs hover:!text-red-700 hover:!bg-red-50"><x-icon name="trash" :size="14" /></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-16">
                    <div class="mx-auto w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-3"><x-icon name="briefcase" :size="20" /></div>
                    <p class="text-stone-500">Aucune opportunité.</p>
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $opportunities->links() }}</div>
@endsection
