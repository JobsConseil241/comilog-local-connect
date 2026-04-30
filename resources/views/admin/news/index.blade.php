@extends('layouts.portal')
@include('admin._sidebar')

@section('section', 'Publications')
@section('page-title', 'Actualités SMI')
@section('title', 'Actualités — Admin')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.news.create') }}" class="btn-primary"><x-icon name="plus" :size="16" /> Nouvel article</a>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Tags</th>
                <th>Publié</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $n)
                <tr>
                    <td><div class="font-display font-semibold text-navy">{{ $n->titre }}</div></td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @foreach(($n->tags ?? []) as $tag)
                                <span class="badge-bronze">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        @if($n->published_at)
                            <span class="badge-success">{{ $n->published_at->translatedFormat('d M Y') }}</span>
                        @else
                            <span class="badge-warning">Brouillon</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.news.edit', $n) }}" class="btn-ghost text-xs"><x-icon name="edit" :size="14" /></a>
                            <form method="POST" action="{{ route('admin.news.destroy', $n) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="btn-ghost text-xs hover:!text-red-700 hover:!bg-red-50"><x-icon name="trash" :size="14" /></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-16">
                    <div class="mx-auto w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center text-stone-400 mb-3"><x-icon name="newspaper" :size="20" /></div>
                    <p class="text-stone-500">Aucun article.</p>
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $news->links() }}</div>
@endsection
