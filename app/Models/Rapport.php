<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable = ['type', 'titre', 'filtres', 'donnees', 'genere_par_id'];

    protected $casts = [
        'filtres' => 'array',
        'donnees' => 'array',
    ];

    public const TYPES = [
        'general' => 'Rapport général',
        'region' => 'Rapport par région',
        'departement' => 'Rapport par département',
        'secteur' => 'Rapport par secteur',
        'financier' => 'Rapport financier',
        'avancement' => "Rapport d'avancement",
        'retards' => 'Liste des projets en retard',
    ];

    public function generePar()
    {
        return $this->belongsTo(User::class, 'genere_par_id');
    }
}
