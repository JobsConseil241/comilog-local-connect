<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PmeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pme::with('categories')->latest();

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('raison_sociale', 'like', "%{$search}%")
                  ->orWhere('rccm', 'like', "%{$search}%")
                  ->orWhere('email_contact', 'like', "%{$search}%");
            });
        }

        return view('admin.pmes.index', [
            'pmes' => $query->paginate(20)->withQueryString(),
            'currentStatus' => $status,
            'searchTerm' => $search,
        ]);
    }

    public function show(Pme $pme): View
    {
        return view('admin.pmes.show', [
            'pme' => $pme->load('categories', 'users', 'validator'),
        ]);
    }

    public function validatePme(Request $request, Pme $pme): RedirectResponse
    {
        $pme->update([
            'status' => Pme::STATUS_ACTIVE,
            'validated_at' => now(),
            'validated_by' => $request->user()->id,
            'rejection_reason' => null,
        ]);

        return back()->with('success', "PME « {$pme->raison_sociale} » validée.");
    }

    public function reject(Request $request, Pme $pme): RedirectResponse
    {
        $data = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $pme->update([
            'status' => Pme::STATUS_REJECTED,
            'rejection_reason' => $data['rejection_reason'],
        ]);

        return back()->with('success', "PME « {$pme->raison_sociale} » rejetée.");
    }

    public function suspend(Pme $pme): RedirectResponse
    {
        $pme->update(['status' => Pme::STATUS_SUSPENDED]);

        return back()->with('success', "PME « {$pme->raison_sociale} » suspendue.");
    }
}
