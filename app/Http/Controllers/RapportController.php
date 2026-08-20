<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\Region;
use App\Models\Secteur;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('nom')->get();
        $secteurs = Secteur::orderBy('nom')->get();
        $departements = Departement::orderBy('nom')->get();

        $historique = Rapport::with('generePar')->latest()->take(10)->get();

        return view('rapports.index', compact('regions', 'secteurs', 'departements', 'historique'));
    }

    public function generer(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:general,region,departement,secteur,financier,avancement,retards',
            'region_id' => 'nullable|exists:regions,id',
            'departement_id' => 'nullable|exists:departements,id',
            'secteur_id' => 'nullable|exists:secteurs,id',
        ]);

        $projets = Projet::with(['region', 'departement', 'secteur'])
            ->when($data['type'] === 'retards', fn ($q) => $q->where('statut', 'en_retard'))
            ->when(!empty($data['region_id']), fn ($q) => $q->where('region_id', $data['region_id']))
            ->when(!empty($data['departement_id']), fn ($q) => $q->where('departement_id', $data['departement_id']))
            ->when(!empty($data['secteur_id']), fn ($q) => $q->where('secteur_id', $data['secteur_id']))
            ->get();

        $resultats = [
            'nombre_projets' => $projets->count(),
            'budget_total' => $projets->sum('cout_previsionnel'),
            'total_decaisse' => $projets->sum(fn ($p) => $p->decaissements()->sum('montant')),
            'total_depense' => $projets->sum(fn ($p) => $p->depenses()->sum('montant')),
            'avancement_moyen' => round($projets->avg('avancement_physique') ?? 0, 1),
            'projets_en_retard' => $projets->where('statut', 'en_retard')->count(),
            'projets_termines' => $projets->where('statut', 'termine')->count(),
            'liste' => $projets->map(fn ($p) => [
                'code' => $p->code,
                'nom' => $p->nom,
                'region' => $p->region?->nom,
                'secteur' => $p->secteur?->nom,
                'statut' => $p->statut,
                'avancement' => $p->avancement_physique,
                'cout_previsionnel' => $p->cout_previsionnel,
            ])->values(),
        ];

        $rapport = Rapport::create([
            'type' => $data['type'],
            'titre' => Rapport::TYPES[$data['type']] . ' — ' . now()->format('d/m/Y H:i'),
            'filtres' => $data,
            'donnees' => $resultats,
            'genere_par_id' => $request->user()->id,
        ]);

        return redirect()->route('rapports.show', $rapport);
    }

    public function show(Rapport $rapport)
    {
        return view('rapports.show', compact('rapport'));
    }
}
