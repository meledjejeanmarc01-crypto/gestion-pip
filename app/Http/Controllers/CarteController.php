<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class CarteController extends Controller
{
    /**
     * Page carte interactive de la Côte d'Ivoire :
     * un marqueur par région, coloré selon le nombre / avancement des projets.
     */
    public function index()
    {
        $regions = Region::withCount('projets')
            ->with(['projets' => function ($q) {
                $q->select('id', 'region_id', 'nom', 'statut', 'avancement_physique', 'cout_previsionnel');
            }])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $donneesCarte = $regions->map(function (Region $region) {
            return [
                'id' => $region->id,
                'nom' => $region->nom,
                'lat' => (float) $region->latitude,
                'lng' => (float) $region->longitude,
                'nb_projets' => $region->projets_count,
                'avancement_moyen' => round($region->projets->avg('avancement_physique') ?? 0),
                'budget_total' => $region->projets->sum('cout_previsionnel'),
                'en_retard' => $region->projets->where('statut', 'en_retard')->count(),
            ];
        });

        return view('carte.index', compact('donneesCarte'));
    }
}
