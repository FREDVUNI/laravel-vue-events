<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'payment_method' => 'required|string',
                'payment_status' => 'required|string',
                'ticket_id' => 'required',
            ]);

            $payment = (new Payment())->createPayment($data);

            return response()->json($payment, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function index()
    {
        try {
            $payments = Payment::all();

            return response()->json($payments);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function show($slug)
    {
        try {
            $payment = Payment::whereHas('ticket', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->firstOrFail();

            return response()->json($payment);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $payment = Payment::whereHas('ticket', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->firstOrFail();

            $payment->update($request->all());

            return response()->json($payment);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function cancel($slug)
    {
        try {
            $payment = Payment::whereHas('ticket', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->firstOrFail();

            $payment->update(['payment_status' => 'canceled']);

            return response()->json($payment);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
