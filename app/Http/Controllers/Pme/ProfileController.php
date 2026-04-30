<?php

namespace App\Http\Controllers\Pme;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('pme.profile.edit', [
            'pme' => $request->user()->pme,
            'categories' => BusinessCategory::where('is_active', true)->orderBy('name')->get(),
            'selectedCategoryIds' => $request->user()->pme?->categories()->pluck('business_categories.id')->all() ?? [],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $pme = $request->user()->pme;
        abort_unless($pme, 404);

        $data = $request->validate([
            'raison_sociale' => 'required|string|max:255',
            'rccm' => "nullable|string|max:255|unique:pmes,rccm,{$pme->id}",
            'nif' => "nullable|string|max:255|unique:pmes,nif,{$pme->id}",
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
            'email_contact' => 'required|email|max:255',
            'representant_nom' => 'required|string|max:255',
            'representant_fonction' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:business_categories,id',
        ]);

        $pme->update(collect($data)->except('categories')->all());
        $pme->categories()->sync($data['categories']);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
