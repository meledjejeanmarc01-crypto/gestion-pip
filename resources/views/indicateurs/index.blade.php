@extends('layouts.app')

@section('titre', 'Indicateurs')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Indicateurs</h2>
            <p class="text-muted">
                Suivi des indicateurs de performance des projets
            </p>
        </div>

        <a href="{{ route('indicateurs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Nouvel indicateur
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Liste des indicateurs</strong>
        </div>

        <div class="card-body">

            @if($indicateurs->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Indicateur</th>
                                <th>Projet</th>
                                <th>Unité</th>
                                <th>Valeur cible</th>
                                <th>Valeur réalisée</th>
                                <th>Date de mesure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($indicateurs as $indicateur)

                            <tr>

                                <td>
                                    {{ $indicateur->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $indicateur->libelle }}
                                    </strong>
                                </td>

                                <td>
                                    @if($indicateur->projet)
                                        {{ $indicateur->projet->code }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $indicateur->projet->nom }}
                                        </small>
                                    @else
                                        <span class="text-muted">
                                            Aucun projet
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $indicateur->unite }}
                                </td>

                                <td>
                                    {{ $indicateur->valeur_cible }}
                                </td>

                                <td>
                                    {{ $indicateur->valeur_realisee }}
                                </td>

                                <td>
                                    @if($indicateur->date_mesure)
                                        {{ \Carbon\Carbon::parse($indicateur->date_mesure)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('indicateurs.show', $indicateur) }}"
                                           class="btn btn-sm btn-info">
                                            Voir
                                        </a>

                                        <a href="{{ route('indicateurs.edit', $indicateur) }}"
                                           class="btn btn-sm btn-warning">
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('indicateurs.destroy', $indicateur) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous supprimer cet indicateur ?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Supprimer
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $indicateurs->links() }}
                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-graph-up display-4 text-muted"></i>

                    <h5 class="mt-3">
                        Aucun indicateur
                    </h5>

                    <p class="text-muted">
                        Aucun indicateur n'est encore enregistré.
                    </p>

                    <a href="{{ route('indicateurs.create') }}"
                       class="btn btn-primary">
                        Ajouter le premier indicateur
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection