@extends('layouts.app')

@section('title', 'Order')

@section('content')
<div class="w-full max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($orders as $order)
    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between h-full">
        <div>
            <table class="min-w-full border-collapse mt-4">
                <thead>
                    <tr>
                        <th class="border-b border-gray-300 px-4 py-2 text-left">Item</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left">Qty</th>
                        <th class="border-b border-gray-300 px-4 py-2 text-left">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode($order->items) as $item)
                    <tr>
                        <td class="border-b border-gray-200 px-4 py-2 text-left">{{ $item->name }}</td>
                        <td class="border-b border-gray-200 px-4 py-2 text-left">{{ $item->qty }}</td>
                        <td class="border-b border-gray-200 px-4 py-2 text-left">Rp. {{ number_format($item->price * $item->qty, 0) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center mt-auto">
            <p class="font-bold mt-6">Total - Rp. {{ number_format(array_sum(array_map(function($item) {
                return $item->price * $item->qty;
            }, json_decode($order->items))), 0) }}</p>
            <p class="font-bold mb-6">Status : {{ ucfirst($order->status) }}</p>
        </div>
        <div class="mt-2 flex space-x-2">
            <div class="flex-1">
                <form action="{{ url('/operator/order/update/' . $order->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin untuk membatalkan orderan ini?');">
                    @csrf
                    <input type="hidden" name="status" value="canceled">
                    <button type="submit" class="bg-red-500 text-white w-full px-4 py-2 rounded hover:bg-red-600">Cancel</button>
                </form>
            </div>
            <div class="flex-1">
                <form action="{{ url('/operator/order/update/' . $order->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin untuk menyelesaikan orderan ini?');">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="bg-green-500 text-white w-full px-4 py-2 rounded hover:bg-green-600">Complete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Link Pagination -->
<div class="mt-6">
    {{ $orders->links() }} <!-- Menampilkan link pagination -->
</div>
@endsection