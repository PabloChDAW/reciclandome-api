<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    public function paymentCompleted(Request $request)
    {
        $details = $request->input('details');

        // Aquí puedes guardar el pedido en la base de datos, enviar confirmación, etc.
        Log::info('Pago recibido de PayPal', $details);

        return response()->json(['status' => 'success']);
    }
}
