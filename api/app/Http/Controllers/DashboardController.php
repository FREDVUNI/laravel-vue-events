<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController
{
    public function getDashboardStats()
    {
        return response()->json([
            'users_count' => User::count(),
            'events_count' => Event::count(),
            'upcoming_events_count' => Event::where('start_date', '>=', now())->count(),
            'sold_tickets_count' => Ticket::count(),
        ], 200);
    }
}
