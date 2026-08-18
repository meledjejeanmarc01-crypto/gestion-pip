@extends('layouts.app')
@section('titre', "Carte du territoire ivoirien")

@section('contenu')
<div class="card card-kpi p-3 mb-3">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h6 mb-1">Projets d'investissement public par région</h2>
            <p class="text-muted small mb-0">
                La taille et la couleur des marqueurs varient selon le nombre de projets
                et leur avancement moyen. Cliquez sur une région pour le détail.
            </p>
        </div>
        <span class="pastille-live"><span class="point"></span> Carte synchronisée en temps réel</span>
    </div>
</div>

<div id="carte-ci"></div>

<script>
    window.donneesCarteRegions = @json($donneesCarte);
</script>
@vite(['resources/js/carte.js'])
@endsection
