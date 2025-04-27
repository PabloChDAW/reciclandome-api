<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OrderController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Las rutas necesarias para un CRUD completo (listarlas con `php artisan route:list`)
Route::apiResource('points', PointController::class);

// Rutas para la autenticación con Sanctum
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


//Ruta para el ProductController:

Route::apiResource('products', ProductController::class);


