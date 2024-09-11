<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTicketsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => new UserResource($this->resource['user']),
            'tickets' => TicketResource::collection($this->resource['tickets'])
        ];
    }

    public function with($request)
    {
        $tickets = $this->resource['tickets'];

        if (method_exists($tickets, 'toArray')) {
            $paginationData = $tickets->toArray();

            // Remove the data key as we're already including it
            unset($paginationData['data']);
            
            return ['meta' => $paginationData];
        }

        return [];
    }
}