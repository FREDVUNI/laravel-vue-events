<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EventController;


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
    });
});

//events
Route::group(["prefix" => "events"], function(){
    Route::get("/",[EventController::class,'events']);
    
    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::post('/', [EventController::class, 'store']);
        Route::get('show/{slug}', [EventController::class, 'show']);
        Route::get('edit/{slug}', [EventController::class, 'edit']);
        Route::patch('update/{slug}', [EventController::class, 'update']);
        Route::delete('delete/{slug}', [EventController::class, 'delete']);
    });
});
