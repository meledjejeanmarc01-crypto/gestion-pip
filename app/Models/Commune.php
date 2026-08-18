<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = ['sous_prefecture_id', 'code', 'nom'];

    public function sousPrefecture()
    {
        return $this->belongsTo(SousPrefecture::class);
    }
}
