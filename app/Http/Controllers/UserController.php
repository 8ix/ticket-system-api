<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userTickets($userId)
    {
        return ['success' => true];
    }
}
