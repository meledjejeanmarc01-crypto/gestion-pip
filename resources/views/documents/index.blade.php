@extends('layouts.app')

@section('titre', 'Documents')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Documents</h2>
            <p class="text-muted">
                Gestion des documents des projets d'investissement public
            </p>
        </div>

        <a href="{{ route('documents.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Nouveau document
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Liste des documents</strong>
        </div>

        <div class="card-body">

            @if($documents->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Projet</th>
                                <th>Fichier</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($documents as $document)

                            <tr>

                                <td>
                                    {{ $document->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $document->titre }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $document->type }}
                                    </span>
                                </td>

                                <td>

                                    @if($document->projet)

                                        {{ $document->projet->code }}

                                        <br>

                                        <small class="text-muted">
                                            {{ $document->projet->nom }}
                                        </small>

                                    @else

                                        <span class="text-muted">
                                            Aucun projet
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $document->chemin_fichier ?? '-' }}
                                </td>

                                <td>
                                    {{ $document->created_at?->format('d/m/Y') }}
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('documents.show', $document) }}"
                                           class="btn btn-sm btn-info">
                                            Voir
                                        </a>

                                        <a href="{{ route('documents.edit', $document) }}"
                                           class="btn btn-sm btn-warning">
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('documents.destroy', $document) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous supprimer ce document ?');"
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

                {{ $documents->links() }}

            @else

                <div class="text-center py-5">

                    <i class="bi bi-file-earmark-text display-4 text-muted"></i>

                    <h5 class="mt-3">
                        Aucun document
                    </h5>

                    <p class="text-muted">
                        Aucun document n'est encore enregistré.
                    </p>

                    <a href="{{ route('documents.create') }}"
                       class="btn btn-primary">
                        Ajouter le premier document
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection