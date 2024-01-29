<?php

namespace App\Http\Controllers;

use \App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function attendees()
    {
        try {
            $attendees = Attendee::fetchAttendees();
            return response()->json(['attendees' => $attendees], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|min:3|string',
                'phone' => 'required|min:10|max:14|unique:attendees',
                'email' => 'required|email|unique:attendees',
                'slug' => 'required',
                'event_id' => 'required|exists:events,id',
            ]);
            $attendee = Attendee::createAttendee($data);
            $event = Event::findOrFail($data['event_id']);
            $event->attendees()->attach($attendee->id);
            return response()->json(['attendees' => $attendee], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.' . $e], 500);
        }
    }
    public function show($slug)
    {
        try {
            $attendee = Attendee::getAttendee($slug);
            return response()->json(['attendee' => $attendee], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function edit($slug)
    {
        try {
            $attendee = Attendee::editAttendee($slug);
            return response()->json(['attendee' => $attendee], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function update(Request $request, $slug)
    {
        try {
            $data = $request->validate([
                'name' => 'required|min:5',
                'phone' => 'required|min:10|max:14',
                'email' => 'required|email',
                'slug' => 'required',
                'event_id' => 'required|exists:events,id',
            ]);
            $attendee = Attendee::getAttendee($slug);

            $currentEvent = $attendee->events()->first();
            if ($currentEvent) {
                $currentEvent->attendees()->detach($attendee->id);
            }

            $update = Attendee::updateAttendee($data, $slug);

            $newEvent = Event::findOrFail($data['event_id']);
            $newEvent->attendees()->attach($attendee->id);

            return response()->json(['attendee' => $update], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function delete($slug)
    {
        try {
            Attendee::deleteAttendee($slug);
            return response()->json(["message" => "Attendee has been deleted."]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
