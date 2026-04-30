@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Publications')
@section('page-title', 'Formations')
@section('title', 'Formations — Admin')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.trainings.create') }}" class="btn-primary"><x-icon name="plus" :size="16" /> Nouvelle formation</a>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date début</th>
                <th>Lieu</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($trainings as $t)
                <tr>
                    <td><div class="font-display font-semibold text-navy">{{ $t->titre }}</div></td>
                    <td class="text-stone-600 text-xs">{{ $t->date_debut->translatedFormat('d M Y') }}</td>
                    <td class="text-stone-600">{{ $t->lieu }}</td>
                    <td><span class="badge-{{ $t->status === 'published' ? 'success' : ($t->status === 'draft' ? 'warning' : 'danger') }}">{{ $t->status }}</span></td>
                    <td class="text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.trainings.edit', $t) }}" class="btn-ghost text-xs"><x-icon name="edit" :size="14" /></a>
                            <form method="POST" action="{{ route('admin.trainings.destroy', $t) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="btn-ghost text-xs hover:!text-red-700 hover:!bg-red-50"><x-icon name="trash" :size="14" /></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-16">
                    <div class="mx-auto w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-3"><x-icon name="graduation" :size="20" /></div>
                    <p class="text-stone-500">Aucune formation.</p>
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $trainings->links() }}</div>
@endsection
