<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request, Projet $projet)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'fichier' => 'required|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        $chemin = $request->file('fichier')->store('documents/' . $projet->id, 'public');

        $projet->documents()->create([
            'titre' => $data['titre'],
            'type' => $data['type'] ?? 'piece_administrative',
            'chemin_fichier' => $chemin,
            'depose_par_id' => $request->user()->id,
        ]);

        return back()->with('succes', 'Document déposé.');
    }

    public function destroy(Projet $projet, \App\Models\Document $document)
    {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($document->chemin_fichier);
        $document->delete();

        return back()->with('succes', 'Document supprimé.');
    }
}
