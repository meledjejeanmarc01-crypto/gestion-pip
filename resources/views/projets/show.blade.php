@extends('layouts.app')

@section('titre', 'Détails du projet')

@section('contenu')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Détails du projet</h2>
            <p class="text-muted mb-0">
                Informations détaillées sur le projet
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('projets.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Retour
            </a>

            <a href="{{ route('projets.edit', $projet) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
                Modifier
            </a>
        </div>
    </div>

    {{-- Informations générales --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-folder2-open"></i>
                Informations du projet
            </h5>
        </div>

        <div class="card-body">
            <div class="row g-4">

                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Code :</label>
                        <div>
                            {{ $projet->code ?? 'Non renseigné' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nom :</label>
                        <div>
                            {{ $projet->nom ?? 'Non renseigné' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description :</label>
                        <div>
                            {{ $projet->description ?? 'Aucune description renseignée.' }}
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Statut :</label>

                        <div>
                            @php
                                $statut = $projet->statut ?? 'Non renseigné';

                                $badgeClass = match (strtolower($statut)) {
                                    'en cours' => 'bg-primary',
                                    'terminé', 'termine' => 'bg-success',
                                    'suspendu' => 'bg-warning text-dark',
                                    'annulé', 'annule' => 'bg-danger',
                                    default => 'bg-secondary',
                                };
                            @endphp

                            <span class="badge {{ $badgeClass }}">
                                {{ $statut }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Date de début :
                        </label>

                        <div>
                            @if($projet->date_debut)
                                {{ \Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y') }}
                            @else
                                Non renseignée
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Date de fin :
                        </label>

                        <div>
                            @if($projet->date_fin)
                                {{ \Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y') }}
                            @else
                                Non renseignée
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Indicateurs --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">
                        Budget
                    </div>

                    <div class="fs-4 fw-bold">
                        {{ number_format($projet->budget ?? 0, 0, ',', ' ') }}
                        FCFA
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">
                        Avancement
                    </div>

                    <div class="fs-4 fw-bold">
                        {{ $projet->pourcentage_avancement ?? 0 }} %
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">
                        Tâches
                    </div>

                    <div class="fs-4 fw-bold">
                        {{ $projet->taches?->count() ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">
                        Rapports
                    </div>

                    <div class="fs-4 fw-bold">
                        {{ $projet->rapports?->count() ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Activités et tâches --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-list-check"></i>
                Activités et tâches
            </h5>
        </div>

        <div class="card-body">

            @forelse ($projet->taches as $t)

                <div class="list-group mb-2">

                    <div class="list-group-item">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <div class="fw-semibold">
                                    {{ $t->libelle ?? 'Tâche sans libellé' }}
                                </div>

                                <small class="text-muted">
                                    État :
                                    {{ str_replace('_', ' ', $t->etat ?? 'Non renseigné') }}
                                </small>
                            </div>

                            <span class="badge bg-secondary">
                                {{ $t->pourcentage_avancement ?? 0 }} %
                            </span>

                        </div>

                        <div class="progress mt-2" style="height: 8px;">

                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: {{ min(max($t->pourcentage_avancement ?? 0, 0), 100) }}%;"
                                aria-valuenow="{{ $t->pourcentage_avancement ?? 0 }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="alert alert-light border mb-0">
                    <i class="bi bi-info-circle"></i>
                    Aucune tâche planifiée pour ce projet.
                </div>

            @endforelse

        </div>

        {{-- Ajouter une tâche --}}
        <div class="card-footer">

            <h6 class="mb-3">
                <i class="bi bi-plus-circle"></i>
                Planifier une nouvelle tâche
            </h6>

            <form
                method="POST"
                action="{{ route('projets.taches.store', $projet) }}"
                class="row g-2">

                @csrf

                <div class="col-md-8">

                    <label class="form-label">
                        Libellé de la tâche
                    </label>

                    <input
                        type="text"
                        name="libelle"
                        class="form-control"
                        placeholder="Exemple : Construction du bâtiment"
                        required>

                </div>

                <div class="col-md-4 d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-success w-100">

                        <i class="bi bi-plus-lg"></i>
                        Planifier

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- Budgets --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-cash-stack"></i>
                Budgets
            </h5>
        </div>

        <div class="card-body p-0">

            @if(isset($projet->budgets) && $projet->budgets->count())

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Libellé</th>
                                <th>Montant</th>
                                <th>Année</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($projet->budgets as $index => $budget)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        {{ $budget->libelle ?? 'Budget' }}
                                    </td>

                                    <td>
                                        {{ number_format($budget->montant ?? 0, 0, ',', ' ') }}
                                        FCFA
                                    </td>

                                    <td>
                                        {{ $budget->annee ?? '—' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-3 text-muted">
                    Aucun budget associé à ce projet.
                </div>

            @endif

        </div>

    </div>

    {{-- Décaissements --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-wallet2"></i>
                Décaissements
            </h5>
        </div>

        <div class="card-body p-0">

            @if(isset($projet->decaissements) && $projet->decaissements->count())

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Observation</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($projet->decaissements as $index => $decaissement)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ number_format($decaissement->montant ?? 0, 0, ',', ' ') }}
                                        FCFA
                                    </td>

                                    <td>
                                        @if($decaissement->date_decaissement)
                                            {{ \Carbon\Carbon::parse($decaissement->date_decaissement)->format('d/m/Y') }}
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td>
                                        {{ $decaissement->observation ?? '—' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-3 text-muted">
                    Aucun décaissement associé à ce projet.
                </div>

            @endif

        </div>

    </div>

    {{-- Rapports --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-file-earmark-text"></i>
                Rapports
            </h5>
        </div>

        <div class="card-body p-0">

            @if(isset($projet->rapports) && $projet->rapports->count())

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Type</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($projet->rapports as $index => $rapport)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        {{ $rapport->titre ?? 'Rapport' }}
                                    </td>

                                    <td>
                                        @if($rapport->date_rapport)
                                            {{ \Carbon\Carbon::parse($rapport->date_rapport)->format('d/m/Y') }}
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td>
                                        {{ $rapport->type ?? '—' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-3 text-muted">
                    Aucun rapport associé à ce projet.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection