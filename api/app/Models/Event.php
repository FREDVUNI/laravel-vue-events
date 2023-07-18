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
            'slug' => Str::slug($data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }
    public static function getEvent($slug){
        return self::FindOrFail($slug);
    }
    public static function editEvent($slug){
        return self::FindOrFail($slug);
    }
    public static function updateEvent($slug, array $data){
        $event = self::FindOrFail($slug);

        return self::update([
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => Str::slug($data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }
    public static function deleteEvent($slug){
        $event = self::delete($slug);
    }
}
