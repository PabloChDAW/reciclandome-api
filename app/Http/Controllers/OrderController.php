<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class OrderController extends Controller implements HasMiddleware
{


    //TODO Hacer un método que devuelva un JSON con order y sus productos ESTÁ

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum')
        ];
    }

    /**
     * Mostrar todos los pedidos del usuario autenticado. ESTÁ
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return response()->json($orders);
    }

    /**
     * Mostrar un pedido específico del usuario autenticado. ESTÁ
     */
    public function show(Order $order)
    {
        $orderWithUser = Order::with('user')->find($order->id);
        return ['order' => $orderWithUser];
    }

    /**
     * Crear un nuevo pedido para el usuario autenticado. ESTÁ
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $validated['status'] = 'pending';
        $validated['total'] = 0;

        $order = $request->user()->orders()->create($validated);
        $orderWithUser = Order::with('user')->find($order->id);


        // 2 cosas
        // Método UpdateProductsInOrder: Resta el stock de los productos porque ingresamos un nuevo producto en order y se valida que haya stock (stock -1)
        // Método UpdateStatus: Cuando se ejecute restar el n de productos que haya (restar stock)

        return ['order' => $orderWithUser];
    }

    /**
     * Actualizar un pedido del usuario autenticado. ESTÁ
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

        $total = 0;

        foreach ($validated['products'] as $productData) {
            $price = Product::where("id", $productData['product_id'])->first()?->price;
            $total = $total + $price;
            $order->products()->attach($productData['product_id']);
        }
        $order->total = $total;
        $order->save();

        return response()->json(['message' => 'Productos actualizados correctamente en el pedido.', 'order' => $order]);
    }

    //funcion para modificar los pedidos a "Completed". ESTÁ
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
     * Eliminar un pedido del usuario autenticado. ESTÁ
     */
    public function destroy(Order $order)
    {
        Gate::authorize('modify', $order);

        $order->delete();

        return ['message' => 'El pedido ha sido eliminado.'];
    }
}
