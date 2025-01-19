@extends('layouts.app')

@section('title', 'Riwayat Order')

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
    </div>
    @endforeach
</div>

<!-- Link Pagination -->
<div class="mt-6">
    {{ $orders->links() }} <!-- Menampilkan link pagination -->
</div>
@endsection