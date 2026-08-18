<?php

namespace App\Http\Controllers;

use App\Events\DecaissementEnregistre;
use App\Events\ProjetMisAJour;
use App\Models\Projet;
use Illuminate\Http\Request;

class DecaissementController extends Controller
{
    public function store(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'bailleur_id' => 'nullable|exists:bailleurs,id',
            'date_decaissement' => 'required|date',
            'montant' => 'required|numeric|min:0.01',
            'source' => 'nullable|string|max:255',
            'observation' => 'nullable|string',
        ]);

        $data['enregistre_par_id'] = $request->user()->id;
        $decaissement = $projet->decaissements()->create($data);

        // Notifications temps réel : mise à jour du total décaissé sur le dashboard
        broadcast(new DecaissementEnregistre($decaissement))->toOthers();
        broadcast(new ProjetMisAJour($projet, 'decaissement'))->toOthers();

        return back()->with('succes', 'Décaissement enregistré.');
    }
}
