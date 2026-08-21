<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with(['projet'])
            ->latest()
            ->paginate(15);

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $projets = Projet::orderBy('nom')->get();

        return view('documents.create', compact('projets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'titre' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'fichier' => 'required|file|max:10240',
        ]);

        $chemin = $request->file('fichier')->store('documents', 'public');

        Document::create([
            'projet_id' => $data['projet_id'],
            'titre' => $data['titre'],
            'type' => $data['type'] ?? null,
            'chemin_fichier' => $chemin,
            'depose_par_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('documents.index')
            ->with('succes', 'Document enregistré avec succès.');
    }

    public function show(Document $document)
    {
        $document->load('projet');

        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $projets = Projet::orderBy('nom')->get();

        return view('documents.edit', compact('document', 'projets'));
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'titre' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'fichier' => 'nullable|file|max:10240',
        ]);

        $document->update([
            'projet_id' => $data['projet_id'],
            'titre' => $data['titre'],
            'type' => $data['type'] ?? null,
        ]);

        if ($request->hasFile('fichier')) {
            if ($document->chemin_fichier) {
                Storage::disk('public')->delete($document->chemin_fichier);
            }

            $document->update([
                'chemin_fichier' => $request->file('fichier')
                    ->store('documents', 'public'),
            ]);
        }

        return redirect()
            ->route('documents.index')
            ->with('succes', 'Document modifié avec succès.');
    }

    public function destroy(Document $document)
    {
        if ($document->chemin_fichier) {
            Storage::disk('public')->delete($document->chemin_fichier);
        }

        $document->delete();

        return redirect()
            ->route('documents.index')
            ->with('succes', 'Document supprimé avec succès.');
    }
}