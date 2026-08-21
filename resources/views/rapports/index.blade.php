@extends('layouts.app')

@section('titre', 'Rapports')

@section('contenu')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Rapports</h2>

            <p class="text-muted">
                Rapports de suivi des investissements publics
            </p>
        </div>

        <a href="{{ route('rapports.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Nouveau rapport
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Rapports disponibles</strong>
        </div>

        <div class="card-body">

            @if($rapports->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Généré par</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($rapports as $rapport)

                            <tr>

                                <td>
                                    {{ $rapport->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $rapport->titre }}
                                    </strong>
                                </td>

                                <td>

                                    <span class="badge bg-primary">
                                        {{ ucfirst($rapport->type) }}
                                    </span>

                                </td>

                                <td>
                                    {{ $rapport->genere_par_id ?? '-' }}
                                </td>

                                <td>
                                    {{ $rapport->created_at?->format('d/m/Y H:i') }}
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('rapports.show', $rapport) }}"
                                           class="btn btn-sm btn-info">
                                            Voir
                                        </a>

                                        <a href="{{ route('rapports.edit', $rapport) }}"
                                           class="btn btn-sm btn-warning">
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('rapports.destroy', $rapport) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous supprimer ce rapport ?');"
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

                {{ $rapports->links() }}

            @else

                <div class="text-center py-5">

                    <i class="bi bi-file-earmark-bar-graph display-4 text-muted"></i>

                    <h5 class="mt-3">
                        Aucun rapport
                    </h5>

                    <p class="text-muted">
                        Aucun rapport n'est encore enregistré.
                    </p>

                    <a href="{{ route('rapports.create') }}"
                       class="btn btn-primary">
                        Générer un rapport
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection