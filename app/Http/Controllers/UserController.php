<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserTicketsResource;

class UserController extends Controller
{
    public function userTickets(Request $request, mixed $userId): UserTicketsResource | ErrorResource
    {
        $user = User::find($userId);

        if (!$user) {
            return new ErrorResource([
                'message' => 'User not found',
                'errors' => ['user_id' => 'No user found with the given ID.'],
                'code' => 404
            ]);
        }

        $tickets = $user->tickets()->paginate(
            $request->input('per_page', 15)
        );

        return (new UserTicketsResource([
            'user' => $user,
            'tickets' => $tickets,
        ]));

    }
}
