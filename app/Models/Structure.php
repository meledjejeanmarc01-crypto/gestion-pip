<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'nom', 'type', 'adresse', 'telephone', 'email'];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }

    public function utilisateurs()
    {
        return $this->hasMany(User::class);
    }
}
