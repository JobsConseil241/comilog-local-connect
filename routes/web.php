<?php

use App\Http\Controllers\Admin\BusinessCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OpportunityController as AdminOpportunityController;
use App\Http\Controllers\Admin\PmeController as AdminPmeController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Pme\DashboardController as PmeDashboardController;
use App\Http\Controllers\Pme\NewsController as PmeNewsController;
use App\Http\Controllers\Pme\OpportunityController as PmeOpportunityController;
use App\Http\Controllers\Pme\ProfileController as PmeProfileController;
use App\Http\Controllers\Pme\TrainingController as PmeTrainingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\InscriptionController;
use App\Http\Controllers\Public\LandingController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('home');

Route::get('/inscription', [InscriptionController::class, 'create'])->name('inscription.create');
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store')->middleware('throttle:6,1');
Route::get('/inscription/confirmation', [InscriptionController::class, 'confirmation'])->name('inscription.confirmation');

Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        User::ROLE_ADMIN_COMILOG, User::ROLE_ADMIN_ANPI => redirect()->route('admin.dashboard'),
        default => redirect()->route('pme.dashboard'),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:pme'])->prefix('pme')->name('pme.')->group(function () {
    Route::get('/dashboard', PmeDashboardController::class)->name('dashboard');
    Route::get('/opportunites', [PmeOpportunityController::class, 'index'])->name('opportunities.index');
    Route::get('/opportunites/{opportunity}', [PmeOpportunityController::class, 'show'])->name('opportunities.show');
    Route::post('/opportunites/{opportunity}/interested', [PmeOpportunityController::class, 'expressInterest'])->name('opportunities.interested');
    Route::get('/formations', [PmeTrainingController::class, 'index'])->name('trainings.index');
    Route::get('/actualites', [PmeNewsController::class, 'index'])->name('news.index');
    Route::get('/actualites/{news:slug}', [PmeNewsController::class, 'show'])->name('news.show');
    Route::get('/profil', [PmeProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [PmeProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin_comilog,admin_anpi'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

    Route::get('/pmes', [AdminPmeController::class, 'index'])->name('pmes.index');
    Route::get('/pmes/{pme}', [AdminPmeController::class, 'show'])->name('pmes.show');
    Route::post('/pmes/{pme}/validate', [AdminPmeController::class, 'validatePme'])->name('pmes.validate');
    Route::post('/pmes/{pme}/reject', [AdminPmeController::class, 'reject'])->name('pmes.reject');
    Route::post('/pmes/{pme}/suspend', [AdminPmeController::class, 'suspend'])->name('pmes.suspend');

    Route::resource('opportunities', AdminOpportunityController::class)->except('show');
    Route::resource('trainings', AdminTrainingController::class)->except('show');
    Route::resource('news', AdminNewsController::class)->except('show')->parameters(['news' => 'news']);
    Route::resource('categories', BusinessCategoryController::class)->except('show');
});

require __DIR__.'/auth.php';
