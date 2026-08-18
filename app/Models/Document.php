<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['projet_id', 'titre', 'type', 'chemin_fichier', 'depose_par_id'];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
