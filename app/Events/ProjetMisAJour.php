<?php

namespace App\Events;

use App\Models\Projet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

/**
 * Diffusé chaque fois qu'un projet est créé, mis à jour (avancement, statut,
 * budget...) afin que le tableau de bord et la carte se mettent à jour
 * en temps réel côté client (Laravel Echo + Reverb).
 */
class ProjetMisAJour implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public function __construct(public Projet $projet, public string $action = 'mise_a_jour')
    {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('projets.suivi'), // canal public écouté par le dashboard et la carte
        ];
    }

    public function broadcastAs(): string
    {
        return 'projet.mis-a-jour';
    }

    public function broadcastWith(): array
    {
        $this->projet->loadMissing(['region', 'secteur']);

        return [
            'action' => $this->action,
            'projet' => [
                'id' => $this->projet->id,
                'code' => $this->projet->code,
                'nom' => $this->projet->nom,
                'statut' => $this->projet->statut,
                'avancement_physique' => $this->projet->avancement_physique,
                'cout_previsionnel' => $this->projet->cout_previsionnel,
                'region' => $this->projet->region?->nom,
                'region_id' => $this->projet->region_id,
                'latitude' => $this->projet->region?->latitude,
                'longitude' => $this->projet->region?->longitude,
                'secteur' => $this->projet->secteur?->nom,
            ],
        ];
    }
}
