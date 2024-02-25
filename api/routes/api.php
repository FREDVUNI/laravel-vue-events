<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "auth"], function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('signin', [AuthController::class, 'signin']);

    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
    });
});

//users
Route::group(["prefix" => "users"], function () {
    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::get("/", [UserController::class, 'users']);
        Route::get('/users-count', [UserController::class, 'count']);
        Route::get('show/{id}', [UserController::class, 'show']);
        Route::get('edit/{id}', [UserController::class, 'edit']);
        Route::patch('update/{id}', [UserController::class, 'update']);
        Route::delete('delete/{id}', [UserController::class, 'delete']);
    });
});

//events
Route::group(["prefix" => "events"], function () {
    Route::get("/", [EventController::class, 'events']);

    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::post('/', [EventController::class, 'store']);
        Route::get('/events-count', [EventController::class, 'count']);
        Route::get('/upcoming-events-count', [EventController::class, 'countUpcomingEvents']);
        Route::get('show/{slug}', [EventController::class, 'show']);
        Route::get('edit/{slug}', [EventController::class, 'edit']);
        Route::patch('update/{slug}', [EventController::class, 'update']);
        Route::delete('delete/{slug}', [EventController::class, 'delete']);
    });
});

//attendees 
Route::group(["prefix" => "attendees"], function () {
    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::get("/", [AttendeeController::class, 'attendees']);
        Route::post('/', [AttendeeController::class, 'store']);
        Route::get('show/{slug}', [AttendeeController::class, 'show']);
        Route::get('edit/{slug}', [AttendeeController::class, 'edit']);
        Route::patch('update/{slug}', [AttendeeController::class, 'update']);
        Route::delete('delete/{slug}', [AttendeeController::class, 'delete']);
    });
});

//tickets
Route::group(["prefix" => "tickets"], function () {
    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::post('/', [TicketController::class, 'store']);
        Route::get("/", [TicketController::class, 'tickets']);
        Route::get('/sold-tickets-count', [TicketController::class, 'countTicketsSold']);
        Route::get('show/{slug}', [TicketController::class, 'show']);
        Route::get('edit/{slug}', [TicketController::class, 'edit']);
        Route::patch('update/{slug}', [TicketController::class, 'update']);
        Route::delete('delete/{slug}', [TicketController::class, 'delete']);
    });

    // Payments endpoints
    Route::post('{slug}/payments', [PaymentController::class, 'makePayment']);
    Route::get('{slug}/payments', [PaymentController::class, 'getPayment']);
    Route::patch('{slug}/payments', [PaymentController::class, 'updatePayment']);
    Route::delete('{slug}/payments', [PaymentController::class, 'cancelPayment']);
});