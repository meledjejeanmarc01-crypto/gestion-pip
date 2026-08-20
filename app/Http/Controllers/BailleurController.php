<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use Illuminate\Http\Request;

class BailleurController extends Controller
{
    public function index()
    {
        $bailleurs = Bailleur::withCount(['budgets', 'decaissements'])
            ->withSum('decaissements', 'montant')
            ->orderBy('nom')
            ->paginate(15);

        return view('bailleurs.index', compact('bailleurs'));
    }

    public function create()
    {
        return view('bailleurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:bailleurs,code',
            'nom' => 'required|string|max:255',
            'type' => 'required|in:etat,partenaire_bilateral,partenaire_multilateral,prive,autre',
            'contact_email' => 'nullable|email',
            'contact_telephone' => 'nullable|string|max:30',
        ]);

        Bailleur::create($data);

        return redirect()->route('bailleurs.index')->with('succes', 'Bailleur enregistré.');
    }

    public function edit(Bailleur $bailleur)
    {
        return view('bailleurs.create', compact('bailleur'));
    }

    public function update(Request $request, Bailleur $bailleur)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:etat,partenaire_bilateral,partenaire_multilateral,prive,autre',
            'contact_email' => 'nullable|email',
            'contact_telephone' => 'nullable|string|max:30',
        ]);

        $bailleur->update($data);

        return redirect()->route('bailleurs.index')->with('succes', 'Bailleur mis à jour.');
    }
}
