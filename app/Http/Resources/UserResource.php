<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $withTicketCount = false;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'ticket_count' => $this->when($this->withTicketCount, $this->tickets_count),
        ];
    }

    /**
     * Add ticket count to the resource.
     *
     * @return $this
     */
    public function withTicketCount()
    {
        $this->withTicketCount = true;
        return $this;
    }
}
