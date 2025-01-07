@extends('layouts.app')

@section('title', 'Riwayat Order')

@section('content')
<div class="w-full max-w-7xl grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Order Card 1 -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <ul class="list-disc pl-5 mb-4">
            <li>Makanan 1 (qty x) Rpxxx,xxx,xxx</li>
            <li>Makanan 2 (qty x) Rpxxx,xxx,xxx</li>
        </ul>
        <p class="font-bold">Total Rpxxx,xxx,xxx</p>
        <p class="font-bold">Status: Selesai</p>
    </div>
    <!-- Order Card 2 -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <ul class="list-disc pl-5 mb-4">
            <li>Makanan 1 (qty x) Rpxxx,xxx,xxx</li>
            <li>Makanan 2 (qty x) Rpxxx,xxx,xxx</li>
        </ul>
        <p class="font-bold">Total Rpxxx,xxx,xxx</p>
        <p class="font-bold">Status: Batal</p>
    </div>
</div>
@endsection