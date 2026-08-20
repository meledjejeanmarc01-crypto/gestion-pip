<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecaissementController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IndicateurController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

// ----- Authentification -----
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

Route::redirect('/', '/dashboard');

// ----- Espace applicatif (utilisateur connecté) -----
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/carte', [CarteController::class, 'index'])->name('carte.index');

    Route::resource('projets', ProjetController::class)
        ->except(['destroy']);

    Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])
        ->middleware('role:admin_national,responsable_national')
        ->name('projets.destroy');

    Route::post('/projets/{projet}/budgets', [BudgetController::class, 'store'])
        ->middleware('role:admin_national,agent_financier,responsable_projet')
        ->name('projets.budgets.store');

    Route::post('/projets/{projet}/decaissements', [DecaissementController::class, 'store'])
        ->middleware('role:admin_national,agent_financier')
        ->name('projets.decaissements.store');

    Route::post('/projets/{projet}/depenses', [DepenseController::class, 'store'])
        ->middleware('role:admin_national,agent_financier')
        ->name('projets.depenses.store');

    Route::post('/projets/{projet}/taches', [TacheController::class, 'store'])
        ->name('projets.taches.store');

    Route::patch('/projets/{projet}/taches/{tache}', [TacheController::class, 'update'])
        ->middleware('role:admin_national,responsable_projet,agent_suivi_evaluation')
        ->name('projets.taches.update');

    Route::post('/projets/{projet}/indicateurs', [IndicateurController::class, 'store'])
        ->middleware('role:admin_national,agent_suivi_evaluation,responsable_projet')
        ->name('projets.indicateurs.store');

    Route::patch('/projets/{projet}/indicateurs/{indicateur}', [IndicateurController::class, 'update'])
        ->middleware('role:admin_national,agent_suivi_evaluation')
        ->name('projets.indicateurs.update');

    Route::post('/projets/{projet}/documents', [DocumentController::class, 'store'])
        ->name('projets.documents.store');

    Route::delete('/projets/{projet}/documents/{document}', [DocumentController::class, 'destroy'])
        ->middleware('role:admin_national,responsable_projet')
        ->name('projets.documents.destroy');

    // ----- Bailleurs -----
    Route::get('/bailleurs', [BailleurController::class, 'index'])->name('bailleurs.index');
    Route::get('/bailleurs/creer', [BailleurController::class, 'create'])
        ->middleware('role:admin_national')->name('bailleurs.create');
    Route::post('/bailleurs', [BailleurController::class, 'store'])
        ->middleware('role:admin_national')->name('bailleurs.store');
    Route::get('/bailleurs/{bailleur}/modifier', [BailleurController::class, 'edit'])
        ->middleware('role:admin_national')->name('bailleurs.edit');
    Route::put('/bailleurs/{bailleur}', [BailleurController::class, 'update'])
        ->middleware('role:admin_national')->name('bailleurs.update');

    // ----- Rapports -----
    Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::post('/rapports', [RapportController::class, 'generer'])->name('rapports.generer');
    Route::get('/rapports/{rapport}', [RapportController::class, 'show'])->name('rapports.show');
});
