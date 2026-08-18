<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    protected $fillable = [
        'projet_id', 'libelle', 'unite', 'valeur_cible', 'valeur_realisee', 'date_mesure',
    ];

    protected $casts = [
        'date_mesure' => 'date',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
