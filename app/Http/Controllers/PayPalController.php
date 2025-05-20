<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    public function paymentCompleted(Request $request)
    {

        $details = $request->input('details');
        $cart = $request->input('cart');

        // Aquí puedes guardar el pedido en la base de datos, enviar confirmación, etc.
        // Muestra lo que llegó al backend
        Log::info('Datos recibidos de PayPal:', [
            'details' => $details
        ]);

        Log::info('Pedido Realizado:', [
            'cart' => $cart
        ]);

        return response()->json(['status' => 'success']);
    }
}
