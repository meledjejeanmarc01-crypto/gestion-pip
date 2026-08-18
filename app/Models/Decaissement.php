<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decaissement extends Model
{
    protected $fillable = [
        'projet_id', 'bailleur_id', 'date_decaissement', 'montant',
        'source', 'observation', 'enregistre_par_id',
    ];

    protected $casts = [
        'date_decaissement' => 'date',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function bailleur()
    {
        return $this->belongsTo(Bailleur::class);
    }

    public function enregistrePar()
    {
        return $this->belongsTo(User::class, 'enregistre_par_id');
    }
}
