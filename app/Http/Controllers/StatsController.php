<?php

namespace App\Http\Controllers;
Use App\Models\Ticket;
use App\Models\User;
use App\Http\Resources\StatsResource;

class StatsController extends Controller
{
    public function index(): StatsResource
    {
        $totalTickets = Ticket::count();
        $unprocessedTickets = Ticket::where('status', false)->count();

        $userWithMostTickets = User::withCount('tickets')
            ->orderBy('tickets_count', 'desc')
            ->first();

        $lastProcessedTicket = Ticket::where('status', true)
            ->latest('updated_at')
            ->first();

        return new StatsResource([
            'total_tickets' => $totalTickets,
            'unprocessed_tickets' => $unprocessedTickets,
            'user_with_most_tickets' => $userWithMostTickets,
            'last_ticket_processed_at' => $lastProcessedTicket,
        ]);
    }
}
