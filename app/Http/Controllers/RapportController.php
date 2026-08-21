<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        $rapports = Rapport::with('createur')
            ->latest()
            ->paginate(15);

        return view('rapports.index', compact('rapports'));
    }

    public function create()
    {
        return view('rapports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'filtres' => 'nullable|string',
            'donnees' => 'nullable|string',
        ]);

        $data['filtres'] = $data['filtres']
            ? json_decode($data['filtres'], true)
            : null;

        $data['donnees'] = $data['donnees']
            ? json_decode($data['donnees'], true)
            : null;

        $data['genere_par_id'] = $request->user()->id;

        Rapport::create($data);

        return redirect()
            ->route('rapports.index')
            ->with('succes', 'Rapport enregistré avec succès.');
    }

    public function show(Rapport $rapport)
    {
        $rapport->load('createur');

        return view('rapports.show', compact('rapport'));
    }

    public function edit(Rapport $rapport)
    {
        return view('rapports.edit', compact('rapport'));
    }

    public function update(Request $request, Rapport $rapport)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'filtres' => 'nullable|string',
            'donnees' => 'nullable|string',
        ]);

        $data['filtres'] = $data['filtres']
            ? json_decode($data['filtres'], true)
            : null;

        $data['donnees'] = $data['donnees']
            ? json_decode($data['donnees'], true)
            : null;

        $rapport->update($data);

        return redirect()
            ->route('rapports.index')
            ->with('succes', 'Rapport modifié avec succès.');
    }

    public function destroy(Rapport $rapport)
    {
        $rapport->delete();

        return redirect()
            ->route('rapports.index')
            ->with('succes', 'Rapport supprimé avec succès.');
    }
}