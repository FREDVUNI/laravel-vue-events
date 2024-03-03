<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makePayment(Request $request, $ticketSlug)
    {
        $request->validate([
            'method' => 'required|string',
        ]);

        $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

        $payment = Payment::create([
            'ticket_id' => $ticket->id,
            'method' => $request->method,
            'payment_status' => 'pending',
        ]);

        return response()->json($payment, 201);
    }

    public function getPayment($ticketSlug)
    {
        $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

        $payment = $ticket->payment;

        return response()->json($payment);
    }

    public function updatePayment(Request $request, $ticketSlug)
    {
        $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

        $payment = $ticket->payment;

        $payment->update($request->all());

        return response()->json($payment);
    }

    public function cancelPayment($ticketSlug)
    {
        $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

        $payment = $ticket->payment;

        $payment->update(['payment_status' => 'canceled']);

        return response()->json($payment);
    }
}
