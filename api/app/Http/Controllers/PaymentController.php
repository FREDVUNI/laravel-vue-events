<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makePayment(Request $request, $ticketSlug)
    {
        try{
            $request->validate([
                'payment_method' => 'required|string',
            ]);

            $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

            $payment = Payment::create([
                'ticket_id' => $ticket->id,
                'payment_method' => $request->method,
                'payment_status' => 'pending',
            ]);

            return response()->json($payment, 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function getPayment($ticketSlug)
    {   
        try{
            $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

            $payment = $ticket->payment;

            return response()->json($payment);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function updatePayment(Request $request, $ticketSlug)
    {
        try{
            $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

            $payment = $ticket->payment;

            $payment->update($request->all());

            return response()->json($payment);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function cancelPayment($ticketSlug)
    {
        try{
            $ticket = Ticket::where('slug', $ticketSlug)->firstOrFail();

            $payment = $ticket->payment;

            $payment->update(['payment_status' => 'canceled']);

            return response()->json($payment);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
