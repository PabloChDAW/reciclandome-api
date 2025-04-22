<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products', 'user')->get();
        return response()->json($orders);
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'products' => 'required|array',
        'products.*' => 'exists:products,id',
        'status' => 'required|string',
        'address' => 'required|string',
    ]);

    $total = Product::whereIn('id', $validated['products'])->sum('price');

    $order = Order::create([
        'user_id' => Auth::id(), 
        'total' => $total,
        'status' => $validated['status'],
        'address' => $validated['address'],
    ]);

    $order->products()->attach($validated['products']);

    return response()->json($order->load('products'), 201);
}


    public function show(Order $order)
    {
        return response()->json($order->load('products', 'user'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'products' => 'sometimes|array',
            'products.*' => 'exists:products,id',
            'status' => 'sometimes|string',
            'address' => 'sometimes|string',
        ]);

        $order->update($request->only('status', 'address'));

        if ($request->has('products')) {
            $order->products()->sync($validated['products']);
            $total = Product::whereIn('id', $validated['products'])->sum('price');
            $order->update(['total' => $total]);
        }

        return response()->json($order->load('products'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Pedido eliminado correctamente.'
        ]);
    }
}
