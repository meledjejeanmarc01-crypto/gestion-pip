<?php

namespace App\Events;

use App\Models\Decaissement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class DecaissementEnregistre implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public function __construct(public Decaissement $decaissement)
    {
    }

    public function broadcastOn(): array
    {
        return [new Channel('projets.suivi')];
    }

    public function broadcastAs(): string
    {
        return 'decaissement.enregistre';
    }

    public function broadcastWith(): array
    {
        return [
            'projet_id' => $this->decaissement->projet_id,
            'montant' => $this->decaissement->montant,
            'date' => $this->decaissement->date_decaissement->format('Y-m-d'),
        ];
    }
}
