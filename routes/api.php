<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransactionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// protected routes
Route::middleware('auth:sanctum')->group(function (){
    route::resource('hotels', HotelController::class)->except(
        ['create', 'edit']
    );
    route::resource('reservations', ReservationController::class)->except(
        ['create', 'edit']
    );
    route::resource('rooms', RoomController::class)->except(
        ['create', 'edit']
    );
    route::resource('transactions', TransactionController::class)->except(
        ['create', 'edit']
    );
    Route::post('logout', [AuthController::class, 'logout']);

});
