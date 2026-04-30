<?php

namespace App\Http\Controllers\Pme;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\View\View;

class TrainingController extends Controller
{
    public function index(): View
    {
        return view('pme.trainings.index', [
            'trainings' => Training::published()->orderBy('date_debut')->paginate(12),
        ]);
    }
}
