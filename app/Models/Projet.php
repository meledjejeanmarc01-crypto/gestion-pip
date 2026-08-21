<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $table = 'projets';

    protected $fillable = [
        'code',
        'nom',
        'description',
        'secteur_id',
        'structure_id',
        'district_id',
        'region_id',
        'departement_id',
        'sous_prefecture_id',
        'commune_id',
        'date_debut_prevue',
        'date_fin_prevue',
        'date_debut_reelle',
        'date_fin_reelle',
        'cout_previsionnel',
        'statut',
        'avancement_physique',
        'responsable_id',
        'cree_par_id',
    ];

    protected $casts = [
        'date_debut_prevue' => 'datetime',
        'date_fin_prevue' => 'datetime',
        'date_debut_reelle' => 'datetime',
        'date_fin_reelle' => 'datetime',
        'cout_previsionnel' => 'decimal:2',
        'avancement_physique' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations géographiques
    |--------------------------------------------------------------------------
    */

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function sousPrefecture()
    {
        return $this->belongsTo(SousPrefecture::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations principales
    |--------------------------------------------------------------------------
    */

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function creePar()
    {
        return $this->belongsTo(User::class, 'cree_par_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Budgets
    |--------------------------------------------------------------------------
    */

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Décaissements
    |--------------------------------------------------------------------------
    */

    public function decaissements()
    {
        return $this->hasMany(Decaissement::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Dépenses
    |--------------------------------------------------------------------------
    */

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Rapports
    |--------------------------------------------------------------------------
    */

    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'projet_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Tâches
    |--------------------------------------------------------------------------
    */

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Indicateurs
    |--------------------------------------------------------------------------
    */

    public function indicateurs()
    {
        return $this->hasMany(Indicateur::class);
    }
    

    public function documents()
    {
        return $this->hasMany(Document::class);
    }


    public function bailleurs()
    {
        return $this->belongsToMany(
            Bailleur::class,
            'bailleur_projet'
        );
    }
}