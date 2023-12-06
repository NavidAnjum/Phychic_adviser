<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json(['orders' => $orders], 200);
    }

    public function create()
    {
        // Add code for showing the create form
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function show(Order $order)
    {
        return response()->json(['order' => $order], 200);
    }

    public function edit(Order $order)
    {
        return response()->json(['order' => $order], 200);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
