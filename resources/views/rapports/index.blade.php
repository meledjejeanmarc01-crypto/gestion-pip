@extends('layouts.app')
@section('titre', 'Rapports')

@section('contenu')
<div class="card card-kpi p-4 mb-3" style="max-width: 760px;">
    <h2 class="h6 mb-3">Générer un rapport</h2>
    <form method="POST" action="{{ route('rapports.generer') }}" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">Type de rapport</label>
            <select name="type" class="form-select" required>
                @foreach (\App\Models\Rapport::TYPES as $valeur => $libelle)
                    <option value="{{ $valeur }}">{{ $libelle }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Région (optionnel)</label>
            <select name="region_id" class="form-select">
                <option value="">Toutes</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Département (optionnel)</label>
            <select name="departement_id" class="form-select">
                <option value="">Tous</option>
                @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Secteur (optionnel)</label>
            <select name="secteur_id" class="form-select">
                <option value="">Tous</option>
                @foreach ($secteurs as $secteur)
                    <option value="{{ $secteur->id }}">{{ $secteur->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <button class="btn btn-success"><i class="bi bi-file-earmark-bar-graph me-1"></i> Générer le rapport</button>
        </div>
    </form>
</div>

<div class="card card-kpi p-3">
    <h2 class="h6 mb-2">Rapports générés récemment</h2>
    <table class="table table-sm align-middle mb-0">
        <thead><tr><th>Titre</th><th>Généré par</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @forelse ($historique as $rapport)
                <tr>
                    <td>{{ $rapport->titre }}</td>
                    <td>{{ $rapport->generePar?->name ?? '—' }}</td>
                    <td>{{ $rapport->created_at->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('rapports.show', $rapport) }}" class="btn btn-sm btn-outline-success">Consulter</a></td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Aucun rapport généré pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
