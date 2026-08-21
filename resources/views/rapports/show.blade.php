@extends('layouts.app')

@section('titre', 'Détails du rapport')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Détails du rapport</h2>

            <p class="text-muted mb-0">
                Consultation des informations du rapport.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('rapports.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Retour
            </a>

            <a href="{{ route('rapports.edit', $rapport) }}"
               class="btn btn-warning">
                <i class="bi bi-pencil me-1"></i>
                Modifier
            </a>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header">
            <strong>
                <i class="bi bi-file-earmark-text me-1"></i>
                {{ $rapport->titre }}
            </strong>
        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="text-muted">
                        Type
                    </label>

                    <div class="mt-1">
                        <span class="badge bg-primary">
                            {{ ucfirst($rapport->type) }}
                        </span>
                    </div>

                </div>

                <div class="col-md-6">

                    <label class="text-muted">
                        Titre
                    </label>

                    <div class="mt-1">
                        <strong>
                            {{ $rapport->titre }}
                        </strong>
                    </div>

                </div>

                <div class="col-md-6">

                    <label class="text-muted">
                        Généré par
                    </label>

                    <div class="mt-1">
                        @if($rapport->createur)
                            {{ $rapport->createur->name }}
                        @else
                            Utilisateur #{{ $rapport->genere_par_id }}
                        @endif
                    </div>

                </div>

                <div class="col-md-6">

                    <label class="text-muted">
                        Date de création
                    </label>

                    <div class="mt-1">
                        {{ $rapport->created_at?->format('d/m/Y H:i') }}
                    </div>

                </div>

            </div>

            <hr class="my-4">

            <h5 class="mb-3">
                Filtres
            </h5>

            @if($rapport->filtres)

                <pre class="bg-light p-3 rounded">{{ json_encode($rapport->filtres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

            @else

                <p class="text-muted">
                    Aucun filtre enregistré.
                </p>

            @endif

            <h5 class="mb-3 mt-4">
                Données
            </h5>

            @if($rapport->donnees)

                <pre class="bg-light p-3 rounded">{{ json_encode($rapport->donnees, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

            @else

                <p class="text-muted">
                    Aucune donnée enregistrée.
                </p>

            @endif

        </div>

    </div>

</div>

@endsection