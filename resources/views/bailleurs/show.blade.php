@extends('layouts.app')

@section('contenu')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Détails du bailleur</h1>
            <p class="text-muted mb-0">
                Informations détaillées sur le bailleur
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('bailleurs.index') }}" class="btn btn-secondary">
                Retour
            </a>

            <a href="{{ route('bailleurs.edit', $bailleur) }}" class="btn btn-primary">
                Modifier
            </a>
        </div>
    </div>

    {{-- Informations du bailleur --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Informations du bailleur</h5>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Code :</strong>
                    <div>{{ $bailleur->code }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Nom :</strong>
                    <div>{{ $bailleur->nom }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Type :</strong>
                    <div>
                        {{ ucfirst($bailleur->type) }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Email :</strong>
                    <div>
                        {{ $bailleur->contact_email ?? 'Non renseigné' }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Téléphone :</strong>
                    <div>
                        {{ $bailleur->contact_telephone ?? 'Non renseigné' }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Date de créaction :</strong>
                    <div>
                        {{ $bailleur->created_at?->format('d/m/Y H:i') }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Budgets --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                Budgets
                <span class="badge bg-primary">
                    {{ $bailleur->budgets->count() }}
                </span>
            </h5>
        </div>

        <div class="card-body">

            @if($bailleur->budgets->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Libellé</th>
                                <th>Montant</th>
                                <th>Année</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bailleur->budgets as $budget)
                                <tr>
                                    <td>{{ $budget->id }}</td>

                                    <td>
                                        {{ $budget->libelle ?? $budget->nom ?? 'Budget' }}
                                    </td>

                                    <td>
                                        {{ number_format($budget->montant ?? 0, 0, ',', ' ') }}
                                        FCFA
                                    </td>

                                    <td>
                                        {{ $budget->annee ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else

                <div class="alert alert-info mb-0">
                    Aucun budget associé à ce bailleur.
                </div>

            @endif

        </div>
    </div>

    {{-- Décaissements --}}
    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">
                Décaissements
                <span class="badge bg-success">
                    {{ $bailleur->decaissements->count() }}
                </span>
            </h5>
        </div>

        <div class="card-body">

            @if($bailleur->decaissements->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Observation</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($bailleur->decaissements as $decaissement)

                                <tr>

                                    <td>
                                        {{ $decaissement->id }}
                                    </td>

                                    <td>
                                        {{ number_format($decaissement->montant ?? 0, 0, ',', ' ') }}
                                        FCFA
                                    </td>

                                    <td>
                                        {{ $decaissement->date_decaissement ?? $decaissement->created_at?->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        {{ $decaissement->observation ?? '-' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info mb-0">
                    Aucun décaissement associé à ce bailleur.
                </div>

            @endif

        </div>

    </div>

</div>
@endsection
