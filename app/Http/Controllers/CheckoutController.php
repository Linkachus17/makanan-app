<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'dine_in' => 'required|boolean',
            'table_number' => 'nullable|integer',
        ]);

        $order = new Order();
        $order->items = json_encode($request->items); // Simpan items sebagai JSON
        $order->dine_in = $request->dine_in;
        $order->table_number = $request->table_number;
        $order->status = 'pending'; // Set status default
        $order->save();

        return response()->json(['message' => 'Order saved successfully!']);
    }
}
