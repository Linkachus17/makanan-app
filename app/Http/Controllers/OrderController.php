<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'pending')->simplePaginate(6);
        return view('operator.order.index', compact('orders'));
    }

    public function riwayat()
    {
        $orders = Order::whereIn('status', ['completed', 'canceled'])->simplePaginate(6);
        return view('operator.riwayat.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validasi status yang diterima
        $request->validate([
            'status' => 'required|in:completed,canceled',
        ]);

        // Update status order
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('message', 'Order status updated successfully!');
    }
}
