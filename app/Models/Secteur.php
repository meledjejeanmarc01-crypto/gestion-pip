<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    protected $fillable = ['code', 'nom'];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
