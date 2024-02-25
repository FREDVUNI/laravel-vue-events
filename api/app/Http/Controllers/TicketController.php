<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'price' => 'required|numeric',
            'event_id' => 'required|exists:events,id',
        ]);

        $ticket = Ticket::createTicket($request->all());

        return response()->json($ticket, 201);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $ticket = Ticket::updateTicket($slug, $request->all());

        return response()->json($ticket, 200);
    }

    public function delete($slug)
    {
        Ticket::deleteTicket($slug);

        return response()->json(['message' => 'Ticket deleted successfully'], 200);
    }

    public function cancel($slug)
    {
        $ticket = Ticket::getTicket($slug);
        $ticket->cancel();

        return response()->json($ticket, 200);
    }

    public function markAsPaid($slug)
    {
        $ticket = Ticket::getTicket($slug);
        $ticket->markAsPaid();

        return response()->json($ticket, 200);
    }

    public function markAsUnpaid($slug)
    {
        $ticket = Ticket::getTicket($slug);
        $ticket->markAsUnpaid();

        return response()->json($ticket, 200);
    }
}
