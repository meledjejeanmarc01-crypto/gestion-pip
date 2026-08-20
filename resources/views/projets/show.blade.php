@extends('layouts.app')
@section('titre', $projet->nom)

@section('contenu')
<div class="row g-3 mb-3">
    <div class="col-md-8">
        <div class="card card-kpi p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="h5">{{ $projet->nom }} <span class="text-muted small">({{ $projet->code }})</span></h2>
                    <span class="badge badge-statut-{{ $projet->statut }}">{{ str_replace('_',' ',$projet->statut) }}</span>
                    <span class="text-muted small ms-2">{{ $projet->secteur?->nom }} · {{ $projet->region?->nom ?? 'Portée nationale' }}</span>
                </div>
                <a href="{{ route('projets.edit', $projet) }}" class="btn btn-sm btn-outline-success align-self-start">Modifier</a>
            </div>
            @if (auth()->user()->hasRole(['admin_national', 'responsable_national']))
            <form method="POST" action="{{ route('projets.destroy', $projet) }}" class="mt-2"
                  onsubmit="return confirm('Supprimer définitivement le projet « {{ $projet->nom }} » ainsi que tous ses budgets, décaissements, dépenses et tâches ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer ce projet</button>
            </form>
            @endif
            <p class="mt-3">{{ $projet->description ?: 'Aucune description renseignée.' }}</p>
            <div class="progress" style="height:10px;">
                <div class="progress-bar bg-success" style="width: {{ $projet->avancement_physique }}%"></div>
            </div>
            <small class="text-muted">Avancement physique : {{ $projet->avancement_physique }}%</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-kpi p-3">
            <div class="small text-muted">Coût prévisionnel</div>
            <div class="fs-5 fw-bold">{{ number_format($projet->cout_previsionnel, 0, ',', ' ') }} FCFA</div>
            <div class="small text-muted mt-2">Total décaissé</div>
            <div class="fw-bold text-success">{{ number_format($projet->decaissements->sum('montant'), 0, ',', ' ') }} FCFA</div>
            <div class="small text-muted mt-2">Total dépensé</div>
            <div class="fw-bold text-warning">{{ number_format($projet->depenses->sum('montant'), 0, ',', ' ') }} FCFA</div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Décaissements --}}
    <div class="col-md-6">
        <div class="card card-kpi p-3">
            <h3 class="h6">Décaissements</h3>
            <ul class="list-group list-group-flush mb-3">
                @forelse ($projet->decaissements as $d)
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span>{{ $d->date_decaissement->format('d/m/Y') }} — {{ $d->source }}</span>
                        <strong>{{ number_format($d->montant, 0, ',', ' ') }} FCFA</strong>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted">Aucun décaissement enregistré.</li>
                @endforelse
            </ul>
            <form method="POST" action="{{ route('projets.decaissements.store', $projet) }}" class="row g-2">
                @csrf
                <div class="col-5"><input type="date" name="date_decaissement" class="form-control form-control-sm" required></div>
                <div class="col-4"><input type="number" step="0.01" name="montant" placeholder="Montant" class="form-control form-control-sm" required></div>
                <div class="col-3"><button class="btn btn-sm btn-success w-100">Ajouter</button></div>
                <div class="col-12"><input type="text" name="source" placeholder="Source du financement" class="form-control form-control-sm mt-1"></div>
            </form>
        </div>
    </div>

    {{-- Dépenses --}}
    <div class="col-md-6">
        <div class="card card-kpi p-3">
            <h3 class="h6">Dépenses</h3>
            <ul class="list-group list-group-flush mb-3">
                @forelse ($projet->depenses as $d)
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span>{{ $d->date_depense->format('d/m/Y') }} — {{ $d->categorie }}</span>
                        <strong>{{ number_format($d->montant, 0, ',', ' ') }} FCFA</strong>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted">Aucune dépense enregistrée.</li>
                @endforelse
            </ul>
            <form method="POST" action="{{ route('projets.depenses.store', $projet) }}" enctype="multipart/form-data" class="row g-2">
                @csrf
                <div class="col-5"><input type="date" name="date_depense" class="form-control form-control-sm" required></div>
                <div class="col-4"><input type="number" step="0.01" name="montant" placeholder="Montant" class="form-control form-control-sm" required></div>
                <div class="col-3"><button class="btn btn-sm btn-success w-100">Ajouter</button></div>
                <div class="col-6"><input type="text" name="categorie" placeholder="Catégorie" class="form-control form-control-sm mt-1" required></div>
                <div class="col-6"><input type="file" name="piece_justificative" class="form-control form-control-sm mt-1"></div>
            </form>
        </div>
    </div>

    {{-- Tâches --}}
    <div class="col-md-12">
        <div class="card card-kpi p-3">
            <h3 class="h6">Activités / tâches</h3>
            <ul class="list-group list-group-flush mb-3">
                @forelse ($projet->taches as $t)
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span>{{ $t->libelle }} <span class="badge bg-secondary">{{ str_replace('_',' ',$t->etat) }}</span></span>
                        <span class="small text-muted">{{ $t->pourcentage_avancement }}%</span>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted">Aucune tâche planifiée.</li>
                @endforelse
            </ul>
            <form method="POST" action="{{ route('projets.taches.store', $projet) }}" class="row g-2">
                @csrf
                <div class="col-8"><input type="text" name="libelle" placeholder="Libellé de la tâche" class="form-control form-control-sm" required></div>
                <div class="col-4"><button class="btn btn-sm btn-success w-100">Planifier</button></div>
            </form>
        </div>
    </div>

    {{-- Indicateurs --}}
    <div class="col-md-6">
        <div class="card card-kpi p-3">
            <h3 class="h6">Indicateurs de performance</h3>
            <ul class="list-group list-group-flush mb-3">
                @forelse ($projet->indicateurs as $i)
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span>{{ $i->libelle }}</span>
                        <span class="small text-muted">
                            {{ $i->valeur_realisee ?? '—' }} / {{ $i->valeur_cible ?? '—' }} {{ $i->unite }}
                        </span>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted">Aucun indicateur enregistré.</li>
                @endforelse
            </ul>
            <form method="POST" action="{{ route('projets.indicateurs.store', $projet) }}" class="row g-2">
                @csrf
                <div class="col-6"><input type="text" name="libelle" placeholder="Libellé" class="form-control form-control-sm" required></div>
                <div class="col-3"><input type="text" name="unite" placeholder="Unité" class="form-control form-control-sm"></div>
                <div class="col-3"><button class="btn btn-sm btn-success w-100">Ajouter</button></div>
                <div class="col-6"><input type="number" step="0.01" name="valeur_cible" placeholder="Valeur cible" class="form-control form-control-sm mt-1"></div>
                <div class="col-6"><input type="number" step="0.01" name="valeur_realisee" placeholder="Valeur réalisée" class="form-control form-control-sm mt-1"></div>
            </form>
        </div>
    </div>

    {{-- Documents --}}
    <div class="col-md-6">
        <div class="card card-kpi p-3">
            <h3 class="h6">Documents du projet</h3>
            <ul class="list-group list-group-flush mb-3">
                @forelse ($projet->documents as $doc)
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($doc->chemin_fichier) }}" target="_blank">{{ $doc->titre }}</a>
                        <span class="small text-muted">{{ str_replace('_',' ',$doc->type) }}</span>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted">Aucun document déposé.</li>
                @endforelse
            </ul>
            <form method="POST" action="{{ route('projets.documents.store', $projet) }}" enctype="multipart/form-data" class="row g-2">
                @csrf
                <div class="col-12"><input type="text" name="titre" placeholder="Titre du document" class="form-control form-control-sm" required></div>
                <div class="col-8">
                    <select name="type" class="form-select form-select-sm">
                        <option value="piece_administrative">Pièce administrative</option>
                        <option value="decision_inscription_budget">Décision d'inscription au budget</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="col-4"><button class="btn btn-sm btn-success w-100">Déposer</button></div>
                <div class="col-12"><input type="file" name="fichier" class="form-control form-control-sm mt-1" required></div>
            </form>
        </div>
    </div>
</div>
@endsection
