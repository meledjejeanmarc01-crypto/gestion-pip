@extends('layouts.app')
@section('titre', 'Bailleurs de fonds')

@section('contenu')
<div class="d-flex justify-content-end mb-2">
    @if (auth()->user()->hasRole('admin_national'))
        <a href="{{ route('bailleurs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i> Nouveau bailleur
        </a>
    @endif
</div>

<div class="card card-kpi p-3">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>Code</th><th>Nom</th><th>Type</th><th>Budgets liés</th><th>Total décaissé</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bailleurs as $bailleur)
                <tr>
                    <td>{{ $bailleur->code }}</td>
                    <td>{{ $bailleur->nom }}</td>
                    <td>{{ str_replace('_', ' ', $bailleur->type) }}</td>
                    <td>{{ $bailleur->budgets_count }}</td>
                    <td>{{ number_format($bailleur->decaissements_sum_montant ?? 0, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @if (auth()->user()->hasRole('admin_national'))
                            <a href="{{ route('bailleurs.edit', $bailleur) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Aucun bailleur enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $bailleurs->links() }}</div>
@endsection
