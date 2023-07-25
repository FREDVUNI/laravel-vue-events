<?php

namespace App\Http\Controllers;

use \App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function attendees()
    {
        try {
            $attendees = Attendee::fetchAttendees();
            return response()->json(['attendees' => $attendees],200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function store(Request $request, $data)
    {
        try {
            $data = $request->validate([
                'name' => 'required|min:5|alphanumeric',
                'phone' => 'required|min:10|max:14|unique:attendees',
                'email' => 'required|email|unique:attendees',
                'slug' => 'required'
            ]);
            $attendee = Attendee::createAttendee($data);
            return response()->json(['attendees' => $attendee, 201]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function show($slug)
    {
        try {
            $attendee = Attendee::getAttendee($slug);
            return response()->json(['attendee' => $attendee, 200]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function edit($slug)
    {
        try {
            $attendee = Attendee::editAttendee($slug);
            return response()->json(['attendee' => $attendee, 200]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
    public function update(Request $request, $slug)
    {
        try {
            $data = $request->validate([
                'name' => 'required|min:5|alphanumeric',
                'phone' => 'required|min:10|max:14',
                'email' => 'required|email',
                'slug' => 'required'
            ]);
            $attendee = Attendee::getAttendee($slug);
            $update = Attendee::updateAttendee($data, $slug);
            return response()->json(['attendee' => $update], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found.'], 404);
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
            return response()->json(['message' => 'Event not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
