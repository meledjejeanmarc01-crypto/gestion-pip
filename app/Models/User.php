<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'structure_id', 'region_id', 'actif',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'actif' => 'boolean',
        ];
    }

    public const ROLES = [
        'admin_national'          => 'Administrateur national',
        'responsable_national'    => 'Responsable national',
        'responsable_regional'    => 'Responsable régional',
        'responsable_departemental' => 'Responsable départemental',
        'responsable_projet'      => 'Responsable de projet',
        'agent_financier'         => 'Agent financier',
        'agent_suivi_evaluation'  => 'Agent de suivi-évaluation',
        'decideur'                => 'Décideur',
    ];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function projetsResponsable()
    {
        return $this->hasMany(Projet::class, 'responsable_id');
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles, true);
    }

    public function libelleRole(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
