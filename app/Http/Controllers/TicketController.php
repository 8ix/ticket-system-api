<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    public function openTickets(Request $request): TicketCollection
    {
        $tickets = Ticket::where('status', false)->paginate(
            $request->input('per_page', 15)
        );

        return $this->ticketCollectionWithUser($tickets);
    }
    
    public function closedTickets(Request $request): TicketCollection
    {
        $tickets = Ticket::where('status', true)->paginate(
            $request->input('per_page', 15)
        );

        return $this->ticketCollectionWithUser($tickets);
    }

    private function ticketCollectionWithUser($tickets): TicketCollection
    {
        return new TicketCollection(
            $tickets->through(fn ($ticket) => (new TicketResource($ticket))->withUser())
        );
    }
}