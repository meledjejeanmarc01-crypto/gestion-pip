<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['region_id', 'code', 'nom'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function sousPrefectures()
    {
        return $this->hasMany(SousPrefecture::class);
    }
}
