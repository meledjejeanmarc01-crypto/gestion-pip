<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function store(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'responsable_id' => 'nullable|exists:users,id',
        ]);

        $projet->taches()->create($data);

        return back()->with('succes', 'Tâche planifiée.');
    }

    public function update(Request $request, Projet $projet, \App\Models\Tache $tache)
    {
        $data = $request->validate([
            'etat' => 'required|in:a_faire,en_cours,termine,bloque',
            'pourcentage_avancement' => 'required|integer|min:0|max:100',
        ]);

        $tache->update($data);

        return back()->with('succes', 'Tâche mise à jour.');
    }
}
