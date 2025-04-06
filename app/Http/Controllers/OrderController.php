<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders;
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:255',
        ]);

        $order = Auth::user()->orders()->create($validated);

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        $this->authorizeOrder($order);
        return response()->json($order);
    }

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
