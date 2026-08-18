<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Projet;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function store(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'bailleur_id' => 'nullable|exists:bailleurs,id',
            'annee_exercice' => 'required|integer|min:2000|max:2100',
            'montant_previsionnel' => 'required|numeric|min:0',
            'montant_engage' => 'nullable|numeric|min:0',
        ]);

        $data['montant_disponible'] = $data['montant_previsionnel'] - ($data['montant_engage'] ?? 0);

        $projet->budgets()->create($data);

        return back()->with('succes', 'Budget ajouté.');
    }
}
