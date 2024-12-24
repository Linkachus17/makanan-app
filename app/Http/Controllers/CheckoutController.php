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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'dine_in' => 'required|boolean',
            'table_number' => 'nullable|integer',
        ]);

        $order = new Order();
        $order->name = $request->name;
        $order->price = $request->price;
        $order->qty = $request->qty;
        $order->dine_in = $request->dine_in;
        $order->table_number = $request->table_number;
        $order->save();

        return response()->json(['message' => 'Order saved successfully!']);
    }
}
