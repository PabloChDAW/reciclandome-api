<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return 'API';
});

// Las rutas necesarias para un CRUD completo (listarlas con `php artisan route:list`)
Route::apiResource('points', PointController::class);

// HACER PEDIDOS Y PRODUCTOS CON API RESOURCE! :D


// Rutas para la autenticación con Sanctum
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/test', function () {
    return response()->json(['message' => 'Test route is working!']);
});