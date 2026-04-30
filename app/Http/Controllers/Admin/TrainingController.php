<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingController extends Controller
{
    public function index(): View
    {
        return view('admin.trainings.index', [
            'trainings' => Training::with('author')->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.trainings.form', ['training' => new Training()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        Training::create([
            ...$data,
            'created_by' => $request->user()->id,
            'published_at' => $data['status'] === Training::STATUS_PUBLISHED ? now() : null,
        ]);

        return redirect()->route('admin.trainings.index')->with('success', 'Formation créée.');
    }

    public function edit(Training $training): View
    {
        return view('admin.trainings.form', ['training' => $training]);
    }

    public function update(Request $request, Training $training): RedirectResponse
    {
        $data = $this->validateData($request);

        $publishedAt = $training->published_at;
        if ($data['status'] === Training::STATUS_PUBLISHED && ! $publishedAt) {
            $publishedAt = now();
        }

        $training->update([
            ...$data,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.trainings.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Training $training): RedirectResponse
    {
        $training->delete();

        return redirect()->route('admin.trainings.index')->with('success', 'Formation supprimée.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'lieu' => 'nullable|string|max:255',
            'places_disponibles' => 'nullable|integer|min:0',
            'contact_email' => 'nullable|email|max:255',
            'status' => 'required|in:draft,published,closed',
        ]);
    }
}
