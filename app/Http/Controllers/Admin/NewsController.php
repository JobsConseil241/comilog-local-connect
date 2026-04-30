<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', [
            'news' => News::with('author')->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.form', ['article' => new News()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['titre']);
        $data['tags'] = $this->parseTags($data['tags'] ?? null);

        News::create([
            ...$data,
            'created_by' => $request->user()->id,
            'published_at' => ! empty($data['publish_now']) ? now() : null,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Article créé.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.form', ['article' => $news]);
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['tags'] = $this->parseTags($data['tags'] ?? null);

        if ($data['titre'] !== $news->titre) {
            $data['slug'] = $this->uniqueSlug($data['titre'], $news->id);
        }

        $publishedAt = $news->published_at;
        if (! empty($data['publish_now']) && ! $publishedAt) {
            $publishedAt = now();
        }

        $news->update([
            ...$data,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Article mis à jour.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Article supprimé.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'titre' => 'required|string|max:255',
            'extrait' => 'nullable|string|max:500',
            'contenu' => 'required|string',
            'tags' => 'nullable|string|max:255',
            'publish_now' => 'nullable|boolean',
        ]);
    }

    private function parseTags(?string $tags): array
    {
        if (! $tags) {
            return [];
        }

        return collect(explode(',', $tags))->map(fn ($t) => trim($t))->filter()->values()->all();
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (News::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
