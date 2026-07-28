<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\Pme;
use App\Models\User;
use App\Notifications\PmeInscriptionReceived;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class InscriptionController extends Controller
{
    public function create(): View
    {
        return view('public.inscription', [
            'categories' => BusinessCategory::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'raison_sociale' => 'required|string|max:255',
            'rccm' => 'nullable|string|max:255|unique:pmes,rccm',
            'nif' => 'nullable|string|max:255|unique:pmes,nif',
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
            'email_contact' => 'required|email|max:255',
            'representant_nom' => 'required|string|max:255',
            'representant_fonction' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:business_categories,id',
            'user_email' => 'required|email|max:255|unique:users,email',
            'user_password' => 'required|string|min:8|confirmed',
        ], [
            'categories.required' => 'Veuillez sélectionner au moins un métier.',
        ]);

        $user = DB::transaction(function () use ($data) {
            $pme = Pme::create([
                'raison_sociale' => $data['raison_sociale'],
                'rccm' => $data['rccm'] ?? null,
                'nif' => $data['nif'] ?? null,
                'ville' => $data['ville'],
                'telephone' => $data['telephone'],
                'email_contact' => $data['email_contact'],
                'representant_nom' => $data['representant_nom'],
                'representant_fonction' => $data['representant_fonction'],
                'description' => $data['description'] ?? null,
                'status' => Pme::STATUS_PENDING,
            ]);

            $pme->categories()->sync($data['categories']);

            return User::create([
                'name' => $data['representant_nom'],
                'email' => $data['user_email'],
                'password' => Hash::make($data['user_password']),
                'role' => User::ROLE_PME,
                'pme_id' => $pme->id,
            ]);
        });

        try {
            $user->notify(new PmeInscriptionReceived($user->pme, $user->email));
        } catch (\Throwable $e) {
            Log::warning('PmeInscriptionReceived mail failed: ' . $e->getMessage());
        }

        return redirect()->route('inscription.confirmation')->with('success', "Votre demande d'inscription a bien été enregistrée. Elle sera examinée par nos équipes.");
    }

    public function confirmation(): View
    {
        return view('public.inscription-confirmation');
    }
}
