@extends('layouts.app')
@section('titre', isset($bailleur) ? 'Modifier le bailleur' : 'Nouveau bailleur')

@section('contenu')
<div class="card card-kpi p-4" style="max-width: 640px;">
    <form method="POST" action="{{ isset($bailleur) ? route('bailleurs.update', $bailleur) : route('bailleurs.store') }}">
        @csrf
        @isset($bailleur) @method('PUT') @endisset

        @unless (isset($bailleur))
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        @endunless

        <div class="mb-3">
            <label class="form-label">Nom du bailleur</label>
            <input type="text" name="nom" class="form-control" required value="{{ old('nom', $bailleur->nom ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                @foreach (['etat' => 'État', 'partenaire_bilateral' => 'Partenaire bilatéral', 'partenaire_multilateral' => 'Partenaire multilatéral', 'prive' => 'Privé', 'autre' => 'Autre'] as $valeur => $libelle)
                    <option value="{{ $valeur }}" @selected(old('type', $bailleur->type ?? '') == $valeur)>{{ $libelle }}</option>
                @endforeach
            </select>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Email de contact</label>
                <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $bailleur->contact_email ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Téléphone de contact</label>
                <input type="text" name="contact_telephone" class="form-control" value="{{ old('contact_telephone', $bailleur->contact_telephone ?? '') }}">
            </div>
        </div>

        <button class="btn btn-success mt-4"><i class="bi bi-check-lg me-1"></i> Enregistrer</button>
    </form>
</div>
@endsection
