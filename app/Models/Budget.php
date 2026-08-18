<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'projet_id', 'bailleur_id', 'annee_exercice',
        'montant_previsionnel', 'montant_engage', 'montant_disponible',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function bailleur()
    {
        return $this->belongsTo(Bailleur::class);
    }
}
