<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function FetchEvents()
    {
        return self::all();
    }
    public static function createEvent(array $data)
    {
        return self::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'slug' => Str::slug($data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }
    public static function getEvent($slug)
    {
        return self::where('slug', $slug)->firstOrFail();
    }
    public static function editEvent($slug)
    {
        return self::where('slug', $slug)->firstOrFail();
    }
    public static function updateEvent($slug, array $data)
    {
        $event = self::where('slug', $slug)->firstOrFail();

        if (!$event) {
            return $event;
        }
        $event->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'slug' => Str::slug($data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return $event;
    }
    public static function deleteEvent($slug)
    {
        $event = self::where('slug', $slug)->firstOrFail();
        $event->delete();
    }
    public function attendees()
    {
        return $this->belongsToMany(Attendee::class);
    }
}
