<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bailleur extends Model
{
    protected $fillable = ['code', 'nom', 'type', 'user_id', 'contact_email', 'contact_telephone'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function decaissements()
    {
        return $this->hasMany(Decaissement::class);
    }
}
