<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function openTickets()
    {
        return ['success' => true];
    }

    public function closedTickets()
    {
        return ['success' => true];
    }
}
