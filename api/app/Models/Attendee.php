<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function fetchAttendees()
    {
        return self::all();
    }

    public static function createAttendee(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'slug' => Str::slug($data['name'] . " " . $data['email']),
            'event_id' => $data['event_id'],
        ]);
    }

    public static function getAttendee($slug)
    {
        $attendee = self::where('slug', $slug)->firstorFail();
        return $attendee;
    }

    public static function showAttendee($slug)
    {
        $attendee = self::where('slug', $slug)->firstorFail();
        return $attendee;
    }

    public static function editAttendee($slug)
    {
        $attendee = self::where('slug', $slug)->firstorFail();
        return $attendee;
    }

    public static function updateAttendee(array $data, $slug)
    {
        $attendee = self::where('slug', $slug)->firstorFail();
        $attendee->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'email_id' => $data['email_id'],
            'slug' => Str::slug($data['name'] . " " . $data['email']),
            'event_id' => $data['event_id'],
        ]);
        return $attendee;
    }

    public static function deleteAttendee($slug)
    {
        $attendee = self::where('slug', $slug)->firstorFail();
        $attendee->delete();
        return $attendee;
    }
    
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
