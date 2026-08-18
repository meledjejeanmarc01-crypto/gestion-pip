<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['district_id', 'code', 'nom', 'latitude', 'longitude'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function departements()
    {
        return $this->hasMany(Departement::class);
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
