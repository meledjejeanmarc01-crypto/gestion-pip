<?php

namespace App\Http\Controllers;

use App\Models\Indicateur;
use App\Models\Projet;
use Illuminate\Http\Request;

class IndicateurController extends Controller
{
    public function index()
    {
        $indicateurs = Indicateur::with('projet')
            ->latest()
            ->paginate(15);

        return view('indicateurs.index', compact('indicateurs'));
    }

    public function create()
    {
        $projets = Projet::orderBy('nom')->get();

        return view('indicateurs.create', compact('projets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'libelle' => 'required|string|max:255',
            'unite' => 'nullable|string|max:100',
            'valeur_cible' => 'nullable|numeric',
            'valeur_realisee' => 'nullable|numeric',
            'date_mesure' => 'nullable|date',
        ]);

        Indicateur::create($data);

        return redirect()
            ->route('indicateurs.index')
            ->with('succes', 'Indicateur enregistré avec succès.');
    }

    public function show(Indicateur $indicateur)
    {
        $indicateur->load('projet');

        return view('indicateurs.show', compact('indicateur'));
    }

    public function edit(Indicateur $indicateur)
    {
        $projets = Projet::orderBy('nom')->get();

        return view('indicateurs.edit', compact('indicateur', 'projets'));
    }

    public function update(Request $request, Indicateur $indicateur)
    {
        $data = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'libelle' => 'required|string|max:255',
            'unite' => 'nullable|string|max:100',
            'valeur_cible' => 'nullable|numeric',
            'valeur_realisee' => 'nullable|numeric',
            'date_mesure' => 'nullable|date',
        ]);

        $indicateur->update($data);

        return redirect()
            ->route('indicateurs.index')
            ->with('succes', 'Indicateur modifié avec succès.');
    }

    public function destroy(Indicateur $indicateur)
    {
        $indicateur->delete();

        return redirect()
            ->route('indicateurs.index')
            ->with('succes', 'Indicateur supprimé avec succès.');
    }
}