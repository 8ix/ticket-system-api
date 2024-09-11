<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\UserResource;

class StatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_tickets' => $this['total_tickets'],
            'unprocessed_tickets' => $this['unprocessed_tickets'],
            'user_with_most_tickets' => (new UserResource($this['user_with_most_tickets']))->withTicketCount(),
            'last_ticket_processed' => (new TicketResource($this['last_ticket_processed_at']))->withUser(),
        ];
    }
}
