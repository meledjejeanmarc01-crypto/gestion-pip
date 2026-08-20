<?php

namespace App\Http\Controllers;

use App\Models\Indicateur;
use App\Models\Projet;
use Illuminate\Http\Request;

class IndicateurController extends Controller
{
    public function store(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'libelle' => 'required|string|max:255',
            'unite' => 'nullable|string|max:50',
            'valeur_cible' => 'nullable|numeric',
            'valeur_realisee' => 'nullable|numeric',
            'date_mesure' => 'nullable|date',
        ]);

        $projet->indicateurs()->create($data);

        return back()->with('succes', 'Indicateur ajouté.');
    }

    public function update(Request $request, Projet $projet, Indicateur $indicateur)
    {
        $data = $request->validate([
            'valeur_realisee' => 'required|numeric',
            'date_mesure' => 'nullable|date',
        ]);

        $indicateur->update($data);

        return back()->with('succes', 'Indicateur mis à jour.');
    }
}
