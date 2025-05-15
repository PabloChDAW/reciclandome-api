<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\OrderController;
// use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProductController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Las rutas necesarias para un CRUD completo (listarlas con `php artisan route:list`)
Route::apiResource('points', PointController::class);

// Rutas para la autenticación con Sanctum
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Rutas para el ProductController:
Route::apiResource('products', ProductController::class);

//Rutas para el OrderController
Route::apiResource('orders', OrderController::class);

//Ruta para actualizar el estado del pedido de pending a completed
Route::middleware('auth:sanctum')->put('/orders/{id}/status', [OrderController::class, 'updateStatus']);

//(Obsoleto) Esto es más de lo mismo, al actualizar mi carrito lo que se hace internamente es eliminar todo del carrito e insertar lo nuevo para no hacer peticiones de más a la bbdd
// Route::middleware('auth:sanctum')->put('/orders/{id}/update-products', [OrderController::class, 'updateProductsInOrder']);

//PAYPAL
Route::post('/paypal/payment-completed', [PayPalController::class, 'paymentCompleted']);


Route::apiResource('types', TypeController::class);
// Route::get('/types/{id}/points', [TypeController::class, 'getPointsByType']);
// Route::get('/points-with-types', [PointController::class, 'withTypesIndex']);
// Route::get('/points/{point}/with-types', [PointController::class, 'withTypesShow']);
