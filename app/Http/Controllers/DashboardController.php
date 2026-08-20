<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Region;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projets = Projet::query();

        // Un responsable régional ne voit que les projets de sa région
        if ($request->user()->hasRole('responsable_regional') && $request->user()->region_id) {
            $projets->where('region_id', $request->user()->region_id);
        }

        $totalProjets = (clone $projets)->count();
        $enCours = (clone $projets)->where('statut', 'en_cours')->count();
        $termines = (clone $projets)->where('statut', 'termine')->count();
        $enRetard = (clone $projets)->where('statut', 'en_retard')->count();

        $budgetTotal = (clone $projets)->sum('cout_previsionnel');
        $totalDecaisse = \App\Models\Decaissement::whereIn('projet_id', (clone $projets)->pluck('id'))->sum('montant');
        $totalDepense = \App\Models\Depense::whereIn('projet_id', (clone $projets)->pluck('id'))->sum('montant');

        $avancementMoyen = round((clone $projets)->avg('avancement_physique') ?? 0, 1);

        $repartitionParRegion = Region::withCount('projets')
            ->having('projets_count', '>', 0)->get(['id', 'nom']);

        $repartitionParSecteur = \App\Models\Secteur::withCount('projets')->get(['id', 'nom']);

        $projetsRecents = (clone $projets)->with(['region', 'secteur'])
            ->latest()->take(8)->get();

        return view('dashboard.index', compact(
            'totalProjets', 'enCours', 'termines', 'enRetard',
            'budgetTotal', 'totalDecaisse', 'totalDepense', 'avancementMoyen',
            'repartitionParRegion', 'repartitionParSecteur', 'projetsRecents'
        ));
    }
}