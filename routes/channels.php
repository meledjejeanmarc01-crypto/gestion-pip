<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Canaux de diffusion (Broadcasting) - Laravel Reverb
|--------------------------------------------------------------------------
| Le canal "projets.suivi" est public : tout utilisateur authentifié
| peut écouter les mises à jour temps réel du tableau de bord et de la carte.
*/

Broadcast::channel('projets.suivi', function ($user) {
    return $user !== null; // accessible à tout utilisateur connecté
});
