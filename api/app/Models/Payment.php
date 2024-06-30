<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'payment_status',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    
    public static function createPayment(array $data)
    {
        $ticket = Ticket::findOrFail($data['ticket_id']);

        return $ticket->payment()->create([
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_status'] ?? 'pending',
        ]);
    }
}
