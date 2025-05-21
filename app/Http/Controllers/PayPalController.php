<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    public function paymentCompleted(Request $request)
    {

        $details = $request->input('details');
        $cart = $request->input('cart');

        // Muestra lo que llegó al backend
        Log::info('Datos recibidos de PayPal:', [
            'details' => $details
        ]);

        Log::info('Pedido Realizado:', [
            'cart' => $cart
        ]);

        //LOGICA PARA GUARDAR LA ORDEN Y LA RELACIÓN DE ORDEN CON PRODUCTOS
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado.'], 401);
        }

        $total = 0;

        // Calculamos el total y validamos productos
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado.'], 404);
            }

            if ($product->stock < $item['quantity']) {
                return response()->json(['error' => 'Stock insuficiente para el producto.'], 400);
            }

            $total += $product->price * $item['quantity'];
        }

        // Creamos la orden
        $order = new Order();
        $order->user_id = $user->id;
        $order->total = $total;
        $order->status = 'Pendiente';
        $order->address = $details['purchase_units'][0]['shipping']['address']['address_line_1'] ?? 'Dirección no especificada';
        $order->save();

        // Asociamos productos
        foreach ($cart as $item) {
            $order->products()->attach($item['id'], ['quantity' => $item['quantity']]);

            // Reducimos el stock
            $product = Product::find($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }

        Log::info('Pedido completado y guardado.', ['order_id' => $order->id]);

        return response()->json(['status' => 'success']);
    }
}
