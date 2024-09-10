<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatsController;

Route::get('/tickets/open', [TicketController::class, 'openTickets']);
Route::get('/tickets/closed', [TicketController::class, 'closedTickets']);
Route::get('/users/{user}/tickets', [UserController::class, 'userTickets']);
Route::get('/stats', [StatsController::class, 'index']);    

