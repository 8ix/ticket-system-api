<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function openTickets()
    {
        return Ticket::where('status', false)->paginate(
            request()->input('per_page', 15)
        );
    }

    public function closedTickets()
    {
        return Ticket::where('status', true)->paginate(
            request()->input('per_page', 15)
        );
    }
}
