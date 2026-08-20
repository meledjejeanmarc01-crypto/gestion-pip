@extends('layouts.app')
@section('titre', $rapport->titre)

@section('contenu')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="h5 mb-0">{{ $rapport->titre }}</h2>
        <span class="text-muted small">Généré par {{ $rapport->generePar?->name ?? '—' }} le {{ $rapport->created_at->format('d/m/Y à H:i') }}</span>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-outline-success btn-sm"><i class="bi bi-printer me-1"></i> Imprimer / PDF</button>
        <a href="{{ route('rapports.index') }}" class="btn btn-outline-secondary btn-sm">← Nouveau rapport</a>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-3"><div class="card card-kpi p-3"><div class="small text-muted">Projets concernés</div><div class="fs-4 fw-bold">{{ $rapport->donnees['nombre_projets'] ?? 0 }}</div></div></div>
    <div class="col-md-3"><div class="card card-kpi p-3"><div class="small text-muted">Avancement moyen</div><div class="fs-4 fw-bold">{{ $rapport->donnees['avancement_moyen'] ?? 0 }}%</div></div></div>
    <div class="col-md-3"><div class="card card-kpi p-3"><div class="small text-muted">En retard</div><div class="fs-4 fw-bold text-danger">{{ $rapport->donnees['projets_en_retard'] ?? 0 }}</div></div></div>
    <div class="col-md-3"><div class="card card-kpi p-3"><div class="small text-muted">Terminés</div><div class="fs-4 fw-bold text-success">{{ $rapport->donnees['projets_termines'] ?? 0 }}</div></div></div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4"><div class="card card-kpi p-3"><div class="small text-muted">Budget total</div><div class="fs-5 fw-bold">{{ number_format($rapport->donnees['budget_total'] ?? 0, 0, ',', ' ') }} FCFA</div></div></div>
    <div class="col-md-4"><div class="card card-kpi p-3"><div class="small text-muted">Total décaissé</div><div class="fs-5 fw-bold text-success">{{ number_format($rapport->donnees['total_decaisse'] ?? 0, 0, ',', ' ') }} FCFA</div></div></div>
    <div class="col-md-4"><div class="card card-kpi p-3"><div class="small text-muted">Total dépensé</div><div class="fs-5 fw-bold text-warning">{{ number_format($rapport->donnees['total_depense'] ?? 0, 0, ',', ' ') }} FCFA</div></div></div>
</div>

<div class="card card-kpi p-3">
    <h3 class="h6">Liste des projets</h3>
    <table class="table table-sm align-middle mb-0">
        <thead><tr><th>Code</th><th>Projet</th><th>Région</th><th>Secteur</th><th>Statut</th><th>Avancement</th><th>Coût prévisionnel</th></tr></thead>
        <tbody>
            @forelse (($rapport->donnees['liste'] ?? []) as $p)
                <tr>
                    <td>{{ $p['code'] }}</td>
                    <td>{{ $p['nom'] }}</td>
                    <td>{{ $p['region'] ?? '—' }}</td>
                    <td>{{ $p['secteur'] ?? '—' }}</td>
                    <td><span class="badge badge-statut-{{ $p['statut'] }}">{{ str_replace('_',' ',$p['statut']) }}</span></td>
                    <td>{{ $p['avancement'] }}%</td>
                    <td>{{ number_format($p['cout_previsionnel'], 0, ',', ' ') }} FCFA</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-3">Aucun projet ne correspond à ces critères.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<p class="text-muted small mt-3">
    Export PDF/Excel natif à implémenter avec Laravel-DomPDF ou Maatwebsite/Excel — en attendant,
    le bouton « Imprimer / PDF » ci-dessus utilise l'impression du navigateur (Ctrl+P → Enregistrer en PDF).
</p>
@endsection
