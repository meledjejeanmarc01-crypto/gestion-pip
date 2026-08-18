<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['code', 'nom', 'autonome'];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
