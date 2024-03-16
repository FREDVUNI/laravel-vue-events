<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function FetchTickets()
    {
        $paidPayments = Payment::where('payment_status', 'paid')->get();
        $tickets = collect();
        foreach ($paidPayments as $payment) {
            $tickets = $tickets->merge($payment->tickets);
        }

        return $tickets;
    }

    public static function createTicket(array $data)
    {
        $event = Event::findOrFail($data['event_id']);
        $user_id = auth()->id();

        $ticket = self::create([
            'ticket_type' => $data['ticket_type'],
            'price' => $data['price'],
            'slug' => Str::slug($event->title . ' ' . $data['ticket_type']),
            'user_id' => $user_id,
            'event_id' => $data['event_id']
        ]);
        return $ticket;
    }

    public static function getTicket($slug)
    {
        return self::where('slug', $slug)->firstOrFail();
    }

    public static function editTicket($slug)
    {
        return self::where('slug', $slug)->firstOrFail();
    }

    public static function updateTicket($slug, array $data)
    {
        $ticket = self::where('slug', $slug)->firstOrFail();

        $ticket->update([
            'ticket_type' => $data['ticket_type'],
            'price' => $data['price'],
            'slug' => Str::slug($data['ticket_type']),
            'user_id' => $data['user_id'],
        ]);

        $event = $ticket->events()->first();
        $event->update([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return $ticket;
    }

    public static function deleteTicket($slug)
    {
        $ticket = self::where('slug', $slug)->firstOrFail();
        $ticket->delete();
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot('start_date', 'end_date');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
