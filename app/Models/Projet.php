<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'nom', 'description', 'secteur_id', 'structure_id',
        'district_id', 'region_id', 'departement_id', 'sous_prefecture_id', 'commune_id',
        'date_debut_prevue', 'date_fin_prevue', 'date_debut_reelle', 'date_fin_reelle',
        'cout_previsionnel', 'statut', 'avancement_physique', 'responsable_id', 'cree_par_id',
    ];

    protected $casts = [
        'date_debut_prevue' => 'date',
        'date_fin_prevue' => 'date',
        'date_debut_reelle' => 'date',
        'date_fin_reelle' => 'date',
        'cout_previsionnel' => 'decimal:2',
    ];

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

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

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function decaissements()
    {
        return $this->hasMany(Decaissement::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function indicateurs()
    {
        return $this->hasMany(Indicateur::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Accesseurs utiles pour le tableau de bord
    public function getTotalDecaisseAttribute(): float
    {
        return (float) $this->decaissements()->sum('montant');
    }

    public function getTotalDepenseAttribute(): float
    {
        return (float) $this->depenses()->sum('montant');
    }

    public function getEstEnRetardAttribute(): bool
    {
        return $this->date_fin_prevue
            && $this->date_fin_prevue->isPast()
            && !in_array($this->statut, ['termine', 'cloture']);
    }

    // Met à jour automatiquement le statut "en_retard" si la date prévue est dépassée
    public function synchroniserStatutRetard(): void
    {
        if ($this->est_en_retard && $this->statut !== 'en_retard') {
            $this->update(['statut' => 'en_retard']);
        }
    }
}
