<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function events()
    {
        try {
            $events = Event::FetchEvents();
            return response()->json(['events' => $events], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                "title" => "required|unique:events|min:4|max:20",
                "description" => "required|min:4|max:200",
                "slug" => "required",
                "start_date" => "required|date_format:Y-m-d H:i:s|after:now",
                "end_date" => "required|date_format:Y-m-d H:i:s|after:now",
            ]);

            $event = Event::createEvent($data);
            return response()->json(['events' => $event], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
