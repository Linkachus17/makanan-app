<html>

<head>
    <title>Checkout</title>
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
            <ul id="summary-list" class="list-disc pl-5 mt-4"></ul>
            <div class="text-xl font-semibold mt-6" id="total-price">Rp. 0</div>
            <div class="flex items-center mt-4">
                <input id="dine-in" type="checkbox" class="mr-2" />
                <label for="dine-in">Dine-in?</label>
            </div>
            <!-- Table Number Input (Hidden by Default) -->
            <div id="table-number-container" class="mt-4 hidden">
                <label for="table-number" class="block mb-2">Table Number:</label>
                <input
                    id="table-number"
                    type="number"
                    class="border-2 border-gray-300 rounded w-full py-2 px-4"
                    placeholder="Enter Table Number"
                />
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
                    <img src="${item.image}" alt="${item.name}" class="w-20 h-20 rounded-lg mr-4" />
                    <div class="flex-grow text-lg">${item.name}</div>
                    <div class="flex items-center">
                        <button class="border-2 border-green-500 text-black rounded-full w-8 h-8 text-lg mx-2" onclick="changeQuantity(${index}, 1)">+</button>
                        <span class="text-lg">${item.quantity}</span>
                        <button class="border-2 border-red-500 text-black rounded-full w-8 h-8 text-lg mx-2" onclick="changeQuantity(${index}, -1)">-</button>
                    </div>
                `;
                foodList.appendChild(foodItem);

                const summaryItem = document.createElement('li');
                summaryItem.className = 'mb-2';
                summaryItem.innerText = `${item.name} (qty: ${item.quantity}) - ${formatCurrency(item.price * item.quantity)}`;
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
        document.getElementById('dine-in').addEventListener('change', function (event) {
            const tableNumberContainer = document.getElementById('table-number-container');
            if (event.target.checked) {
                tableNumberContainer.classList.remove('hidden');
            } else {
                tableNumberContainer.classList.add('hidden');
            }
        });

        document.addEventListener('DOMContentLoaded', updateCheckout);
    </script>
</body>

</html>
