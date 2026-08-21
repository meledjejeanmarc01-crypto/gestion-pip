<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use Illuminate\Http\Request;

class BailleurController extends Controller
{
    public function index()
    {
        $bailleurs = Bailleur::with('utilisateur')
            ->latest()
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
            'code' => 'required|string|max:255|unique:bailleurs,code',
            'nom' => 'required|string|max:255',
            'type' => 'required|in:etat,partenaire_bilateral,partenaire_multilateral,prive,autre',
            'contact_email' => 'nullable|email|max:255',
            'contact_telephone' => 'nullable|string|max:50',
        ]);

        Bailleur::create($data);

        return redirect()
            ->route('bailleurs.index')
            ->with('succes', 'Bailleur enregistré avec succès.');
    }

    public function show(Bailleur $bailleur)
    {
        $bailleur->load(['budgets', 'decaissements']);

        return view('bailleurs.show', compact('bailleur'));
    }

    public function edit(Bailleur $bailleur)
    {
        return view('bailleurs.edit', compact('bailleur'));
    }

    public function update(Request $request, Bailleur $bailleur)
    {
        $data = $request->validate([
            'code' => 'required|string|max:255|unique:bailleurs,code,' . $bailleur->id,
            'nom' => 'required|string|max:255',
            'type' => 'required|in:etat,partenaire_bilateral,partenaire_multilateral,prive,autre',
            'contact_email' => 'nullable|email|max:255',
            'contact_telephone' => 'nullable|string|max:50',
        ]);

        $bailleur->update($data);

        return redirect()
            ->route('bailleurs.index')
            ->with('succes', 'Bailleur modifié avec succès.');
    }

    public function destroy(Bailleur $bailleur)
    {
        $bailleur->delete();

        return redirect()
            ->route('bailleurs.index')
            ->with('succes', 'Bailleur supprimé avec succès.');
    }
}