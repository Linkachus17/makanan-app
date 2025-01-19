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
    <div class="bg-white rounded-lg shadow-md p-4 food-item" data-id="{{ $makanan->id }}" data-name="{{ $makanan->name }}" data-price="{{ $makanan->price }}" data-image="{{ asset('storage/' . $makanan->image) }}" data-availability="{{ $makanan->availability }}">
        @php
        $imagePath = public_path('storage/' . $makanan->image);
        $defaultImage = asset('images/image-not-found.png'); // Ganti dengan path gambar default Anda
        @endphp
        <img src="{{ file_exists($imagePath) ? asset('storage/' . $makanan->image) : $defaultImage }}" alt="{{ $makanan->name }}" class="w-full h-48 object-fill" />
        <div class="py-4 flex justify-between items-center">
            <div>
                <div class="text-lg font-bold mb-2">
                    {{ $makanan->name }}
                </div>
                <p class="text-lg font-bold">
                    Rp{{ number_format($makanan->price, 0, ',', '.') }}
                </p>
            </div>
            <div class="text-sm font-bold text-right">
                <p>Status :</p>
                <p class="{{ $makanan->availability ? 'text-green-500' : 'text-yellow-500' }}">
                    {{ $makanan->availability ? 'Tersedia' : 'Tidak Tersedia' }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination Links -->
<div class="flex justify-center mt-6">
    {{ $makanans->links() }} <!-- Menampilkan link pagination -->
</div>

<!-- Modal Add -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Add Makanan</h2>
        <form action="{{ url('/operator/makanan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex items-center">
                <label for="availability" class="block text-sm font-medium text-gray-700 mr-2">Masih Tersedia?</label>
                <input type="checkbox" name="availability" id="availability" value="1" class="form-checkbox h-5 w-5 text-blue-600" />
            </div>
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
                <img id="imagePreview" src="{{ asset('images/image-not-found.png') }}" alt="Image Preview" class="mt-2 w-full h-48 object-fill " />
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Edit Makanan</h2>
        <form action="{{ url('/operator/makanan/update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="editId" />
            <div class="mb-4 flex items-center">
                <label for="availability" class="block text-sm font-medium text-gray-700 mr-2">Masih Tersedia?</label>
                <input type="checkbox" name="availability" id="editAvailability" value="1" class="form-checkbox h-5 w-5 text-blue-600" />
            </div>
            <div class="mb-4">
                <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="editName" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="editPrice" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="editPrice" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label for="editImage" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" name="image" id="editImage" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" />
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">View Image</label>
                <img id="editImagePreview" src="{{ asset('images/image-not-found.png') }}" alt="Image Preview" class="mt-2 w-full h-48 object-fill " />
            </div>
            <div class="flex justify-between">
                <button type="button" id="deleteButton" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                <div class="flex">
                    <button type="button" id="closeEditModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('openModal').onclick = function() {
        document.getElementById('modal').classList.remove('hidden');
    }

    document.getElementById('closeModal').onclick = function() {
        clearModalInputs(); // Panggil fungsi untuk membersihkan input
        document.getElementById('modal').classList.add('hidden');
    }

    document.querySelectorAll('.food-item').forEach(item => {
        item.onclick = function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price')).toFixed(0);
            const image = this.getAttribute('data-image');
            const availability = this.getAttribute('data-availability'); // Ambil data availability

            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editImagePreview').src = image;

            // Atur status checkbox availability
            document.getElementById('editAvailability').checked = availability === '1'; // Jika availability adalah '1', centang checkbox

            document.getElementById('editModal').classList.remove('hidden');
        }
    });

    document.getElementById('closeEditModal').onclick = function() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('image').onchange = function(event) {
        const file = event.target.files[0];
        const imageURL = URL.createObjectURL(file);
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = imageURL;
        imagePreview.classList.remove('hidden');
    }

    document.getElementById('editImage').onchange = function(event) {
        const file = event.target.files[0];
        const imageURL = URL.createObjectURL(file);
        const editImagePreview = document.getElementById('editImagePreview');
        editImagePreview.src = imageURL;
        editImagePreview.classList.remove('hidden');
    }

    document.getElementById('deleteButton').onclick = function() {
        const id = document.getElementById('editId').value;

        if (confirm('Are you sure you want to delete this food item?')) {
            fetch(`/operator/makanan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        // Hapus elemen dari DOM
                        const foodItem = document.querySelector(`.food-item[data-id="${id}"]`);
                        if (foodItem) {
                            foodItem.remove();
                        }

                        // Tutup modal
                        document.getElementById('editModal').classList.add('hidden');

                        alert('Food item deleted successfully.');
                    } else {
                        alert('Failed to delete food item.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the food item.');
                });
        }
    };

    function clearModalInputs() {
        document.getElementById('name').value = '';
        document.getElementById('price').value = '';
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').src = "{{ asset('images/image-not-found.png') }}"; // Reset ke gambar default
        document.getElementById('availability').checked = false; // Reset checkbox availability
    }
</script>
@endsection