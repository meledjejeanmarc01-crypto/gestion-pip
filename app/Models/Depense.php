<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = [
        'projet_id', 'categorie', 'montant', 'date_depense',
        'piece_justificative_path', 'enregistre_par_id',
    ];

    protected $casts = [
        'date_depense' => 'date',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
