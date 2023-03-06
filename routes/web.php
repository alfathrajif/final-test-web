<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PacketController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/unit/aktif/{id}', [DashboardController::class, 'updateAktif']);
Route::post('/dashboard/edit/{id}', [DashboardController::class, 'update']);
Route::post('/dashboard', [DashboardController::class, 'store']);

Route::get('/dashboard/packets', [PacketController::class, 'index']);
Route::post('/dashboard/packets', [PacketController::class, 'store']);

Route::post('/dashboard/packets/update/{id}', [PacketController::class, 'update']);
Route::post('/packet/aktif/{id}', [PacketController::class, 'updateAktif']);
