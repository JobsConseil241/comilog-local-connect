@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Communauté')
@section('page-title', 'Catégories métier')
@section('title', 'Catégories — Admin')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.categories.create') }}" class="btn-primary"><x-icon name="plus" :size="16" /> Nouvelle catégorie</a>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>PME</th>
                <th>Opportunités</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td><span class="inline-block w-4 h-4 rounded ring-2 ring-white shadow-soft" style="background: {{ $cat->color }};"></span></td>
                    <td><div class="font-display font-semibold text-navy">{{ $cat->name }}</div></td>
                    <td class="text-stone-700 tabular-nums">{{ $cat->pmes_count }}</td>
                    <td class="text-stone-700 tabular-nums">{{ $cat->opportunities_count }}</td>
                    <td>
                        @if($cat->is_active) <span class="badge-success">Actif</span> @else <span class="badge-warning">Inactif</span> @endif
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="btn-ghost text-xs"><x-icon name="edit" :size="14" /></a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf @method('DELETE')
                                <button class="btn-ghost text-xs hover:!text-red-700 hover:!bg-red-50"><x-icon name="trash" :size="14" /></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
