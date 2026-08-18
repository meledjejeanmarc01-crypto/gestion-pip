@extends('layouts.app')
@section('titre', 'Tableau de bord national')

@section('contenu')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <div class="text-muted small">Projets enregistrés</div>
            <div class="fs-3 fw-bold" id="kpi-total">{{ $totalProjets }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <div class="text-muted small">En cours / Terminés</div>
            <div class="fs-3 fw-bold"><span id="kpi-en-cours">{{ $enCours }}</span> / <span id="kpi-termines">{{ $termines }}</span></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <div class="text-muted small">Projets en retard</div>
            <div class="fs-3 fw-bold text-danger" id="kpi-en-retard">{{ $enRetard }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <div class="text-muted small">Avancement moyen</div>
            <div class="fs-3 fw-bold" id="kpi-avancement">{{ $avancementMoyen }}%</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-kpi p-3">
            <div class="text-muted small">Budget total prévisionnel</div>
            <div class="fs-4 fw-bold" id="kpi-budget">{{ number_format($budgetTotal, 0, ',', ' ') }} FCFA</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3">
            <div class="text-muted small">Montant total décaissé</div>
            <div class="fs-4 fw-bold text-success" id="kpi-decaisse">{{ number_format($totalDecaisse, 0, ',', ' ') }} FCFA</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3">
            <div class="text-muted small">Montant total dépensé</div>
            <div class="fs-4 fw-bold text-warning" id="kpi-depense">{{ number_format($totalDepense, 0, ',', ' ') }} FCFA</div>
        </div>
    </div>
</div>

<div class="card card-kpi p-3 mb-4">
    <h2 class="h6 mb-3">Secteurs d'intervention</h2>
    <div class="row row-cols-2 row-cols-md-4 g-3 text-center">
        <div class="col"><img src="{{ asset('images/infrastructures/route.svg') }}" class="img-fluid rounded" alt="Infrastructures"><div class="small mt-1">Infrastructures</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/sante.svg') }}" class="img-fluid rounded" alt="Santé"><div class="small mt-1">Santé</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/education.svg') }}" class="img-fluid rounded" alt="Éducation"><div class="small mt-1">Éducation</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/agriculture.svg') }}" class="img-fluid rounded" alt="Agriculture"><div class="small mt-1">Agriculture</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/energie.svg') }}" class="img-fluid rounded" alt="Énergie"><div class="small mt-1">Énergie</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/eau-potable.svg') }}" class="img-fluid rounded" alt="Eau potable"><div class="small mt-1">Eau potable</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/transports.svg') }}" class="img-fluid rounded" alt="Transports"><div class="small mt-1">Transports</div></div>
        <div class="col"><img src="{{ asset('images/infrastructures/developpement-local.svg') }}" class="img-fluid rounded" alt="Développement local"><div class="small mt-1">Développement local</div></div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card card-kpi p-3">
            <h2 class="h6">Répartition des projets par région</h2>
            <canvas id="graphRegions" height="220"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-kpi p-3">
            <h2 class="h6">Répartition des projets par secteur</h2>
            <canvas id="graphSecteurs" height="220"></canvas>
        </div>
    </div>
</div>

<div class="card card-kpi p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h6 mb-0">Projets récents <span class="pastille-live ms-2"><span class="point"></span> mise à jour en direct</span></h2>
        <a href="{{ route('projets.index') }}" class="small">Voir tous les projets →</a>
    </div>
    <table class="table table-sm align-middle mb-0">
        <thead>
            <tr><th>Code</th><th>Projet</th><th>Région</th><th>Statut</th><th>Avancement</th></tr>
        </thead>
        <tbody id="table-projets-recents">
            @foreach ($projetsRecents as $projet)
                <tr data-projet-id="{{ $projet->id }}">
                    <td>{{ $projet->code }}</td>
                    <td>{{ $projet->nom }}</td>
                    <td>{{ $projet->region?->nom ?? '—' }}</td>
                    <td><span class="badge badge-statut-{{ $projet->statut }}">{{ str_replace('_', ' ', $projet->statut) }}</span></td>
                    <td style="min-width:120px;">
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar" style="width: {{ $projet->avancement_physique }}%"></div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@vite(['resources/js/dashboard.js'])
<script>
    window.donneesGraphRegions = @json($repartitionParRegion->pluck('projets_count', 'nom'));
    window.donneesGraphSecteurs = @json($repartitionParSecteur->pluck('projets_count', 'nom'));
</script>
@endsection
