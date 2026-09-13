<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC routes (landing page — no auth)
|--------------------------------------------------------------------------
*/
Route::get('/events',           [EventController::class, 'events']);
Route::get('/events/show/{slug}', [EventController::class, 'show']);

/*
|--------------------------------------------------------------------------
| AUTH routes
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('signin', [AuthController::class, 'signin']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user',    [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED (any role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Dashboard stats (controller filters by role)
    Route::get('/dashboard-stats', [DashboardController::class, 'getDashboardStats']);

    // Attendee: RSVP to an event
    Route::post('/attendees', [AttendeeController::class, 'store']);

    // Attendee: own tickets
    Route::get('/tickets',      [TicketController::class, 'tickets']);
    Route::post('/tickets',     [TicketController::class, 'store']);
    Route::get('/tickets/show/{slug}', [TicketController::class, 'show']);

    // Payments
    Route::post('/payments',          [PaymentController::class, 'store']);
    Route::get('/payments',           [PaymentController::class, 'index']);
    Route::get('/payments/{slug}',    [PaymentController::class, 'show']);
    Route::patch('/payments/{slug}',  [PaymentController::class, 'update']);
    Route::delete('/payments/{slug}', [PaymentController::class, 'cancel']);
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('users')->group(function () {
    Route::get('/',              [UserController::class, 'users']);
    Route::get('/users-count',   [UserController::class, 'count']);
    Route::get('show/{id}',      [UserController::class, 'show']);
    Route::get('edit/{id}',      [UserController::class, 'edit']);
    Route::patch('update/{id}',  [UserController::class, 'update']);
    Route::delete('delete/{id}', [UserController::class, 'delete']);
});

/*
|--------------------------------------------------------------------------
| ADMIN + ORGANIZER (event management)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'role:admin,organizer'])->group(function () {

    // Events CRUD
    Route::post('/events',                [EventController::class, 'store']);
    Route::patch('/events/update/{slug}', [EventController::class, 'update']);
    Route::delete('/events/delete/{slug}',[EventController::class, 'delete']);
    Route::get('/events/edit/{slug}',     [EventController::class, 'edit']);

    // Counts for dashboards
    Route::get('/events-count',            [EventController::class, 'count']);
    Route::get('/upcoming-events-count',   [EventController::class, 'countUpcomingEvents']);
    Route::get('/tickets/sold-tickets-count', [TicketController::class, 'count']);

    // Attendee management (view/edit/delete — creation happens via RSVP above)
    Route::get('/attendees',                [AttendeeController::class, 'attendees']);
    Route::get('/attendees/show/{slug}',    [AttendeeController::class, 'show']);
    Route::get('/attendees/edit/{slug}',    [AttendeeController::class, 'edit']);
    Route::patch('/attendees/update/{slug}',[AttendeeController::class, 'update']);
    Route::delete('/attendees/delete/{slug}',[AttendeeController::class, 'delete']);
});