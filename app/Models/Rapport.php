<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $table = 'rapports';

    protected $fillable = [
        'projet_id',
        'titre',
        'type',
        'description',
        'date_rapport',
        'contenu',
        'fichier',
        'statut',
        'cree_par_id',
    ];

    protected $casts = [
        'date_rapport' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Projet
    |--------------------------------------------------------------------------
    */

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Utilisateur ayant créé le rapport
    |--------------------------------------------------------------------------
    */

    public function creePar()
    {
        return $this->belongsTo(User::class, 'cree_par_id');
    }
}