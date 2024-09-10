<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function userTickets(Request $request, User $user)
    {
        return $user->tickets()->paginate(
            $request->input('per_page', 15)
        );
    }
}
