<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;

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

// Grup Rute untuk Otentikasi -> Cocok dengan folder "Auth" di Postman
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    // POST /auth/login
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:login');

    // POST /auth/logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // GET /auth/me
    Route::get('me', [AuthController::class, 'me'])->name('me');
});


// Rute untuk Event -> Cocok dengan folder "Event" di Postman
// Perintah ini secara otomatis membuat endpoint berikut:
// GET /events          (Get Events)
// POST /events         (Store Events)
// GET /events/{id}     (Get Events by Id)
// PUT /events/{id}     (Update Events)
// DELETE /events/{id}  (Delete Events)
Route::apiResource('events', EventController::class);


// Rute Health Check (opsional, tapi baik untuk ada)
Route::get('/health', function() {
    return response()->json(['status' => 'ok']);
});
