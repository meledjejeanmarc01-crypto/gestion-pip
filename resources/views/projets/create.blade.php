@extends('layouts.app')
@section('titre', isset($projet) ? 'Modifier le projet' : 'Nouveau projet')

@section('contenu')
<div class="card card-kpi p-4" style="max-width: 760px;">
    <form method="POST" action="{{ isset($projet) ? route('projets.update', $projet) : route('projets.store') }}">
        @csrf
        @isset($projet) @method('PUT') @endisset

        @unless (isset($projet))
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Code du projet</label>
                <input type="text" name="code" class="form-control" required value="{{ old('code') }}">
            </div>
            <div class="col-md-8">
                <label class="form-label">Nom du projet</label>
                <input type="text" name="nom" class="form-control" required value="{{ old('nom') }}">
            </div>
        </div>
        @else
        <div class="mb-3">
            <label class="form-label">Nom du projet</label>
            <input type="text" name="nom" class="form-control" required value="{{ old('nom', $projet->nom) }}">
        </div>
        @endisset

        <div class="mb-3 mt-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $projet->description ?? '') }}</textarea>
        </div>

        <div class="row g-3">
            @unless (isset($projet))
            <div class="col-md-6">
                <label class="form-label">Secteur</label>
                <select name="secteur_id" class="form-select" required>
                    @foreach ($secteurs as $secteur)
                        <option value="{{ $secteur->id }}">{{ $secteur->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Structure responsable</label>
                <select name="structure_id" class="form-select" required>
                    @foreach ($structures as $structure)
                        <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                    @endforeach
                </select>
            </div>
            @endunless

            <div class="col-md-6">
                <label class="form-label">Région</label>
                <select name="region_id" class="form-select">
                    <option value="">—</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" @selected(old('region_id', $projet->region_id ?? null) == $region->id)>{{ $region->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Coût prévisionnel (FCFA)</label>
                <input type="number" step="0.01" name="cout_previsionnel" class="form-control" required
                       value="{{ old('cout_previsionnel', $projet->cout_previsionnel ?? 0) }}">
            </div>

            @unless (isset($projet))
            <div class="col-md-6">
                <label class="form-label">Date de début prévue</label>
                <input type="date" name="date_debut_prevue" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Date de fin prévue</label>
                <input type="date" name="date_fin_prevue" class="form-control">
            </div>
            @else
            <div class="col-md-6">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select" required>
                    @foreach (['planifie','en_cours','en_retard','suspendu','termine','cloture'] as $statut)
                        <option value="{{ $statut }}" @selected($projet->statut == $statut)>{{ str_replace('_',' ',$statut) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Avancement physique (%)</label>
                <input type="number" min="0" max="100" name="avancement_physique" class="form-control" required
                       value="{{ old('avancement_physique', $projet->avancement_physique) }}">
            </div>
            @endunless
        </div>

        <button class="btn btn-success mt-4">
            <i class="bi bi-check-lg me-1"></i> Enregistrer
        </button>
    </form>
</div>
@endsection
