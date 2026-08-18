<?php

namespace App\Http\Controllers;

use App\Events\ProjetMisAJour;
use App\Models\Bailleur;
use App\Models\Projet;
use App\Models\Region;
use App\Models\Secteur;
use App\Models\Structure;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index(Request $request)
    {
        $projets = Projet::with(['region', 'secteur', 'structure', 'responsable'])
            ->when($request->filled('region_id'), fn ($q) => $q->where('region_id', $request->region_id))
            ->when($request->filled('secteur_id'), fn ($q) => $q->where('secteur_id', $request->secteur_id))
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->statut))
            ->when($request->filled('q'), fn ($q) => $q->where(function ($qq) use ($request) {
                $qq->where('nom', 'like', "%{$request->q}%")
                   ->orWhere('code', 'like', "%{$request->q}%");
            }))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $regions = Region::orderBy('nom')->get();
        $secteurs = Secteur::orderBy('nom')->get();

        return view('projets.index', compact('projets', 'regions', 'secteurs'));
    }

    public function create()
    {
        return view('projets.create', [
            'regions' => Region::orderBy('nom')->get(),
            'secteurs' => Secteur::orderBy('nom')->get(),
            'structures' => Structure::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:projets,code',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'secteur_id' => 'required|exists:secteurs,id',
            'structure_id' => 'required|exists:structures,id',
            'region_id' => 'nullable|exists:regions,id',
            'departement_id' => 'nullable|exists:departements,id',
            'date_debut_prevue' => 'nullable|date',
            'date_fin_prevue' => 'nullable|date|after_or_equal:date_debut_prevue',
            'cout_previsionnel' => 'required|numeric|min:0',
        ]);

        $data['cree_par_id'] = $request->user()->id;
        $data['statut'] = 'planifie';

        $projet = Projet::create($data);

        // Diffusion temps réel vers le tableau de bord et la carte
        broadcast(new ProjetMisAJour($projet, 'creation'))->toOthers();

        return redirect()->route('projets.show', $projet)->with('succes', 'Projet enregistré avec succès.');
    }

    public function show(Projet $projet)
    {
        $projet->load([
            'region', 'departement', 'secteur', 'structure', 'responsable',
            'budgets', 'decaissements', 'depenses', 'taches', 'indicateurs', 'documents',
        ]);

        return view('projets.show', compact('projet'));
    }

    public function edit(Projet $projet)
    {
        return view('projets.create', [
            'projet' => $projet,
            'regions' => Region::orderBy('nom')->get(),
            'secteurs' => Secteur::orderBy('nom')->get(),
            'structures' => Structure::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:planifie,en_cours,en_retard,suspendu,termine,cloture',
            'avancement_physique' => 'required|integer|min:0|max:100',
            'region_id' => 'nullable|exists:regions,id',
            'cout_previsionnel' => 'required|numeric|min:0',
        ]);

        $projet->update($data);

        broadcast(new ProjetMisAJour($projet, 'mise_a_jour'))->toOthers();

        return redirect()->route('projets.show', $projet)->with('succes', 'Projet mis à jour.');
    }
}
