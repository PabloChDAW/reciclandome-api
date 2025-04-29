<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TypeController;



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


//Ruta para el OrderController
Route::apiResource('orders', OrderController::class);

//Rutas para actualizar el estado de cada producto (Por defecto, los estados de los pedidos van a quedarse en pendiente hasta q el usuario haga click desde el frontend en realizar pedido para no tener que hacer peticiones cada vez que el usuario quiera modificar o alterar el pedido)
Route::middleware('auth:sanctum')->put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
//Esto es más de lo mismo, al actualizar mi carrito lo que se hace internamente es eliminar todo del carrito e insertar lo nuevo para no hacer peticiones de más a la bbdd
Route::middleware('auth:sanctum')->put('/orders/{id}/update-products', [OrderController::class, 'updateProductsInOrder']);



Route::get('/types', [TypeController::class, 'index']);
