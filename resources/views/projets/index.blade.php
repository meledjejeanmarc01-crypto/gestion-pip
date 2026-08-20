@extends('layouts.app')
@section('titre', 'Projets d\'investissement public')

@section('contenu')
<div class="card card-kpi p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Recherche</label>
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom ou code...">
        </div>
        <div class="col-md-3">
            <label class="form-label small">Région</label>
            <select name="region_id" class="form-select">
                <option value="">Toutes</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" @selected(request('region_id') == $region->id)>{{ $region->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Secteur</label>
            <select name="secteur_id" class="form-select">
                <option value="">Tous</option>
                @foreach ($secteurs as $secteur)
                    <option value="{{ $secteur->id }}" @selected(request('secteur_id') == $secteur->id)>{{ $secteur->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label small">Statut</label>
            <select name="statut" class="form-select">
                <option value="">Tous</option>
                @foreach (['planifie','en_cours','en_retard','suspendu','termine','cloture'] as $statut)
                    <option value="{{ $statut }}" @selected(request('statut') == $statut)>{{ str_replace('_',' ',$statut) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <button class="btn btn-success w-100"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>

<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('projets.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Nouveau projet
    </a>
</div>

<div class="card card-kpi p-3">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>Code</th><th>Projet</th><th>Secteur</th><th>Région</th>
                <th>Coût prévisionnel</th><th>Statut</th><th>Avancement</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projets as $projet)
                <tr>
                    <td>{{ $projet->code }}</td>
                    <td>{{ $projet->nom }}</td>
                    <td>{{ $projet->secteur?->nom }}</td>
                    <td>{{ $projet->region?->nom ?? '—' }}</td>
                    <td>{{ number_format($projet->cout_previsionnel, 0, ',', ' ') }} FCFA</td>
                    <td><span class="badge badge-statut-{{ $projet->statut }}">{{ str_replace('_',' ',$projet->statut) }}</span></td>
                    <td style="min-width:120px;">
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar" style="width: {{ $projet->avancement_physique }}%"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('projets.show', $projet) }}" class="btn btn-sm btn-outline-success">Détail</a>
                            <a href="{{ route('projets.edit', $projet) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                            @if (auth()->user()->hasRole(['admin_national', 'responsable_national']))
                            <form method="POST" action="{{ route('projets.destroy', $projet) }}"
                                  onsubmit="return confirm('Supprimer définitivement le projet « {{ $projet->nom }} » ainsi que tous ses budgets, décaissements, dépenses et tâches ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Aucun projet enregistré pour ces critères.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $projets->links() }}</div>
@endsection
