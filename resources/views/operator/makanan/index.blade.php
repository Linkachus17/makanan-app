@extends('layouts.app')

@section('title', 'Food List')

@section('content')
<div class="w-full max-w-7xl grid grid-cols-2 mb-6">
    <div class="flex items-center">
        <span class="text-yellow-500">Operator</span>
        <span class="text-blue-500 mx-2">></span>
        <span class="text-white">View Makanan</span>
    </div>
    <div class="flex justify-end">
        <button id="openModal" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Add
        </button>
    </div>
</div>

<div class="w-full max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($makanans as $makanan)
    <div class="bg-white rounded-lg shadow-md p-4">
        <img src="{{ asset($makanan->image) }}" alt="{{ $makanan->name }}" class="w-full h-48 object-cover" />
        <div class="py-4">
            <div class="text-lg font-bold mb-2">
                {{ $makanan->name }}
            </div>
            <p class="text-lg font-bold">
                Rp{{ number_format($makanan->price, 0, ',', '.') }}
            </p>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Add Makanan</h2>
        <form action="{{ route('makanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" name="image" id="image" accept="image/*" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">View Image</label>
                <img id="imagePreview" src="" alt="Image Preview" class="mt-2 w-full h-48 object-cover hidden" />
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('openModal').onclick = function() {
        document.getElementById('modal').classList.remove('hidden');
    }

    document.getElementById('closeModal').onclick = function() {
        document.getElementById('modal').classList.add('hidden');
    }

    document.getElementById('image').onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const URL = URL.createObjectURL(file);
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = URL;
            imagePreview.classList.remove('hidden');
        }
    }
</script>
@endsection