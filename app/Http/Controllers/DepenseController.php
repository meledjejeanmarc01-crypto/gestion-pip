<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function store(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'categorie' => 'required|string|max:100',
            'montant' => 'required|numeric|min:0.01',
            'date_depense' => 'required|date',
            'piece_justificative' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($request->hasFile('piece_justificative')) {
            $data['piece_justificative_path'] = $request->file('piece_justificative')
                ->store('depenses/' . $projet->id, 'public');
        }
        unset($data['piece_justificative']);

        $data['enregistre_par_id'] = $request->user()->id;
        $projet->depenses()->create($data);

        return back()->with('succes', 'Dépense enregistrée.');
    }
}
