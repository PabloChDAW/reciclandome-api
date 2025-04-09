<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

class OrderController extends Controller
{

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum')
        ];
    }
    
     /**
     * Muestra todos los pedidos almacenados en la base de datos.
     */
    public function index()
    {
        $orders = Auth::user()->orders;
        return response()->json($orders);
    }

    /**
     * Almacena un nuevo pedido asociado a un usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:20',
            'address' => 'required|string|max:50',
        ]);

        $order = Auth::user()->orders()->create($validated);
        

        return response()->json($order, 201);
    }
    /**
     * Muestra los datos de un pedido específico.
     */
    public function show(Order $order)
    {
        $this->authorizeOrder($order);
        return response()->json($order);
    }

    /**
     * Actualiza los datos de un punto específico.
     */
    public function update(Request $request, Order $order)
    {
        $this->authorizeOrder($order);

        $validated = $request->validate([
            'total' => 'sometimes|required|numeric|min:0',
            'status' => 'nullable|string|max:255',
        ]);

        $order->update($validated);

        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $this->authorizeOrder($order);

        $order->delete();

        return response()->json(['message' => 'Pedido eliminado']);
    }

    protected function authorizeOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para acceder a este pedido.');
        }
    }
}
