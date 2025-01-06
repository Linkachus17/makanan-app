<html>

<head>
    <title>Checkout</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0-alpha.2/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="font-sans">
    <!-- Header -->
    <div class="flex items-center bg-gray-100 p-4 shadow-md">
        <a href="/" class="text-black no-underline">
            <i class="fas fa-arrow-left text-xl mr-2"></i>
        </a>
        <h1 class="text-xl font-semibold">Checkout</h1>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row justify-between p-4 lg:p-8">
        <!-- Food List Section -->
        <div class="w-full lg:w-2/3">
            <div id="food-list"></div>
        </div>

        <!-- Summary Section -->
        <div class="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow-md mt-4 lg:mt-0 lg:ml-5">
            <h2 class="text-lg font-semibold">Summary</h2>
            <table class="min-w-full mt-4">
                <thead>
                    <tr>
                        <th class="border-b-2 border-gray-300 text-left p-2">Item</th>
                        <th class="border-b-2 border-gray-300 text-left p-2">Quantity</th>
                        <th class="border-b-2 border-gray-300 text-left p-2">Price</th>
                    </tr>
                </thead>
                <tbody id="summary-list"></tbody>
            </table>
            <div class="text-xl font-semibold mt-6" id="total-price">Rp. 0</div>
            <div class="flex items-center mt-4">
                <input id="dine-in" type="checkbox" class="mr-2" />
                <label for="dine-in">Dine-in?</label>
            </div>
            <!-- Table Number Input (Dropdown) -->
            <div id="table-number-container" class="mt-4 hidden">
                <label for="table-number" class="block mb-2">Table Number:</label>
                <select id="table-number" class="border-2 border-gray-300 rounded w-full py-2 px-4">
                    <option value="">Select Table Number</option>
                    <!-- Generate options from 1 to 20 -->
                    <script>
                        for (let i = 1; i <= 20; i++) {
                            document.write(`<option value="${i}">${i}</option>`);
                        }
                    </script>
                </select>
            </div>
            <button id="order-button" class="bg-green-500 text-white w-full py-3 rounded mt-6 text-lg">
                ORDER
            </button>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Function to format numbers as currency
        function formatCurrency(amount) {
            return `Rp. ${amount.toLocaleString()}`;
        }

        function updateCheckout() {
            const foodList = document.getElementById('food-list');
            const summaryList = document.getElementById('summary-list');
            const totalPrice = document.getElementById('total-price');
            foodList.innerHTML = '';
            summaryList.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const foodItem = document.createElement('div');
                foodItem.className = 'flex items-center bg-white p-4 mb-4 rounded-lg shadow-md';
                foodItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}" class="w-20 h-20 rounded-lg mr-4" onerror="this.onerror=null; this.src='/images/image-not-found.png';" />
            <div class="flex-grow text-lg">${item.name}</div>
            <div class="flex items-center">
                <button class="border-2 border-green-500 text-black rounded-full w-8 h-8 text-lg mx-2" onclick="changeQuantity(${index}, 1)">+</button>
                <span class="text-lg">${item.quantity}</span>
                <button class="border-2 border-red-500 text-black rounded-full w-8 h-8 text-lg mx-2" onclick="changeQuantity(${index}, -1)">-</button>
            </div>
        `;
                foodList.appendChild(foodItem);

                const summaryItem = document.createElement('tr');
                summaryItem.innerHTML = `
            <td class="border-b border-gray-300 p-2">${item.name}</td>
            <td class="border-b border-gray-300 p-2">${item.quantity}</td>
            <td class="border-b border-gray-300 p-2">${formatCurrency(item.price * item.quantity)}</td>
        `;
                summaryList.appendChild(summaryItem);

                total += item.price * item.quantity;
            });

            totalPrice.innerText = formatCurrency(total);
        }

        function changeQuantity(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCheckout();
        }

        // Handle Dine-in Checkbox Toggle
        document.getElementById('dine-in').addEventListener('change', function(event) {
            const tableNumberContainer = document.getElementById('table-number-container');
            if (event.target.checked) {
                tableNumberContainer.classList.remove('hidden');
            } else {
                tableNumberContainer.classList.add('hidden');
            }
        });

        document.getElementById('order-button').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Cart is empty!');
                return;
            }

            const dineIn = document.getElementById('dine-in').checked;
            const tableNumber = dineIn ? document.getElementById('table-number').value : null;

            // Tambahkan pemeriksaan untuk memastikan nomor meja dipilih jika dine-in dicentang
            if (dineIn && !tableNumber) {
                alert('Please select a table number before ordering.');
                return;
            }

            // Buat array untuk menyimpan semua promise dari fetch
            const orderPromises = cart.map(item => {
                const orderData = {
                    name: item.name,
                    price: item.price,
                    qty: item.quantity,
                    dine_in: dineIn,
                    table_number: tableNumber
                };

                return fetch('/order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan CSRF token ditambahkan
                    },
                    body: JSON.stringify(orderData)
                });
            });

            // Tunggu semua permintaan selesai
            Promise.all(orderPromises)
                .then(responses => {
                    // Periksa apakah semua permintaan berhasil
                    return Promise.all(responses.map(response => response.json()));
                })
                .then(dataArray => {
                    // Jika semua order berhasil, arahkan ke halaman view order
                    localStorage.removeItem('cart'); // Hapus cart setelah berhasil
                    updateCheckout();
                    window.location.href = '/checkout-success'; // Ganti dengan URL halaman view order Anda
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        document.addEventListener('DOMContentLoaded', updateCheckout);
    </script>
</body>

</html>