<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class OrderController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum')
        ];
    }

    /**
     * Mostrar todos los pedidos del usuario autenticado.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return response()->json($orders);
    }

    /**
     * Mostrar un pedido específico del usuario autenticado.
     */
    public function show(Order $order)
    {
        return ['order' => $order, 'user' => $order->user];

    }

    /**
     * Crear un nuevo pedido para el usuario autenticado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $validated['status'] = 'pending';


        $order = $request->user()->orders()->create($validated);

        return ['order' => $order, 'user' => $order->user];
        }

    /**
     * Actualizar un pedido del usuario autenticado.
     */
    public function updateProductsInOrder(Request $request, $id)
{
    $validated = $request->validate([
        'products' => 'required|array', 
        'products.*.product_id' => 'required|exists:products,id', 
    ]);

    $order = Order::find($id);

    if (!$order) {
        return response()->json(['error' => 'Pedido no encontrado.'], 404);
    }

    if ($order->user_id !== Auth::id()) {
        return response()->json(['error' => 'No tienes permiso para modificar este pedido.'], 403);
    }

    // Eliminar todos los productos del pedido 
    $order->products()->detach();

    foreach ($validated['products'] as $productData) {
        $order->products()->attach($productData['product_id']);
    }

    return response()->json(['message' => 'Productos actualizados correctamente en el pedido.', 'order' => $order]);
}

    //funcion para modificar los pedidos a "Completed"
    public function updateStatus($id)
    {
        $order = Order::find($id);


        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'No tienes permiso para modificar este pedido.'], 403);
        }

        $order->status = 'completed';
        $order->save();

        return response()->json(['message' => 'Estado del pedido actualizado correctamente.', 'order' => $order]);
    }
    /**
     * Eliminar un pedido del usuario autenticado.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('modify', $order);

        $order->delete();

        return ['message' => 'El pedido ha sido eliminado.'];
    }

    
}
