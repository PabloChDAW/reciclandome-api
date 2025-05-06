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
    // Hacer un método que devuelva un JSON con order y sus productos ESTÁ
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
     * Crear un nuevo pedido para el usuario autenticado.
     * Al crearse se pedirá la dirección de envío y se guardará un pedido
     * vacío. ESTÁ
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|min:1|integer',
        ]);

        $validated['status'] = 'pending';
        $validated['total'] = 0;

        $total = 0;
        foreach ($validated['products'] as $productData) {
            $product = Product::where("id", $productData['product_id'])->first();
            if($product == null){
                return response()->json(['error' => 'El producto no existe'], 404);
            }
            $price = $product->price;
            $stock = $product->stock;
            $quantity = $productData['quantity'];

            if($stock < $quantity){
                return response()->json(['error' => 'No hay productos suficientes en stock'], 404);
            }
            $total = $total + $price*$quantity;
        }

        $order = $request->user()->orders()->create($validated);
        $orderWithUser = Order::with('user')->find($order->id);
        $order->total = $total;

        foreach ($validated['products'] as $productData) {
            //Quantity hay que pasarlo así porque necesita saber el valor que le estamos pasando
            $order->products()->attach($productData['product_id'], ['quantity' => $productData['quantity']]);
        }

        //TODO Llamar a la parasela, confirmar que se realiza el pago, en función de
        //TODO cambiar el estado a completed o cancelled y finalmente ->
        $order->save();

        return ['order' => $orderWithUser];
    }

    /**
     * Agregar productos a un pedido del usuario autenticado.
     *
     */
    // public function updateProductsInOrder(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'products' => 'required|array',
    //         'products.*.product_id' => 'required|exists:products,id',
    //     ]);



    //     // Eliminar todos los productos del pedido
    //     $order->products()->detach();

    //     $total = 0;

    //     foreach ($validated['products'] as $productData) {
    //         $price = Product::where("id", $productData['product_id'])->first()?->price;
    //         $total = $total + $price;
    //         $order->products()->attach($productData['product_id']);
    //     }

    //     $order->total = $total;
    //     $order->save();

    //     return response()->json([
    //         'message' => 'Productos actualizados correctamente en el pedido.',
    //         'order' => $order
    //     ]);
    // }

    //funcion para modificar los pedidos a "Completed". ESTÁ
    public function updateStatus($id)
    {
        //TODO LÓGICA DE LA PASARELA
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
