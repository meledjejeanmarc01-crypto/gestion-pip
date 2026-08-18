<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousPrefecture extends Model
{
    protected $table = 'sous_prefectures';
    protected $fillable = ['departement_id', 'code', 'nom'];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
