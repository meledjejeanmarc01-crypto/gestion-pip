@extends('layouts.app')

@section('titre', 'Bailleurs')

@section('contenu')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Bailleurs</h2>
        <p class="text-muted mb-0">
            Gestion des partenaires financiers des projets d'investissement public.
        </p>
    </div>

    <a href="{{ route('bailleurs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Nouveau bailleur
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        @if($bailleurs->count())

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bailleurs as $bailleur)

                            <tr>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $bailleur->code }}
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $bailleur->nom }}</strong>
                                </td>

                                <td>
                                    @switch($bailleur->type)
                                        @case('etat')
                                            État
                                            @break

                                        @case('partenaire_bilateral')
                                            Partenaire bilatéral
                                            @break

                                        @case('partenaire_multilateral')
                                            Partenaire multilatéral
                                            @break

                                        @case('prive')
                                            Privé
                                            @break

                                        @default
                                            Autre
                                    @endswitch
                                </td>

                                <td>
                                        {{ $bailleur->contact_email ?: 'Non renseigné' }}
                                </td>

                                <td>
                                         {{ $bailleur->contact_telephone ?: 'Non renseigné' }}
                                </td>

                                <td class="text-end">

                                    <a href="{{ route('bailleurs.show', $bailleur) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('bailleurs.edit', $bailleur) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('bailleurs.destroy', $bailleur) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Voulez-vous vraiment supprimer ce bailleur ?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $bailleurs->links() }}
            </div>

        @else

            <div class="text-center py-5">

                <i class="bi bi-building display-4 text-muted"></i>

                <h4 class="mt-3">
                    Aucun bailleur enregistré
                </h4>

                <p class="text-muted">
                    Commencez par enregistrer un bailleur.
                </p>

                <a href="{{ route('bailleurs.create') }}"
                   class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Ajouter un bailleur
                </a>

            </div>

        @endif

    </div>
</div>

@endsection
