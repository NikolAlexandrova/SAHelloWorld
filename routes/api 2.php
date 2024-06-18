<?php

use App\Http\Controllers\CalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//calendar

Route::get('/calendars', [CalendarController::class, 'fetchCalendars']);
Route::post('/calendars', [CalendarController::class, 'store']);
Route::put('/calendars/{id}', [CalendarController::class, 'update']);
Route::delete('/calendars/{id}', [CalendarController::class, 'destroy']);
