<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col">
    <div class="bg-gray-100 py-4 text-center text-2xl font-bold">List Makanan</div>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 place-items-center">
            @foreach($makanans as $food)
            <div class="bg-gray-100 rounded-lg shadow-lg overflow-hidden w-96">
                <img src="{{ asset($food->image) }}" alt="{{ $food->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">Rp{{ number_format($food->price, 0, ',', '.') }}</h3>
                    <h2 class="text-lg font-bold mb-2">{{ $food->name }}</h2>
                    <button class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600" onclick="addToCart({{ json_encode($food) }})">
                        Add
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="checkout-container" class="fixed bottom-0 w-full bg-blue-400 text-center py-4 hidden" style="padding-top: 10px;">
        <a id="checkout-link" href="#" class="text-black text-lg font-bold" onclick="goToCheckout(event)">
            CHECKOUT (0)
        </a>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let checkoutCount = cart.reduce((total, item) => total + item.quantity, 0);

        function updateCheckout() {
            const checkoutContainer = document.getElementById('checkout-container');
            const checkoutLink = document.getElementById('checkout-link');

            if (checkoutCount > 0) {
                checkoutContainer.classList.remove('hidden');
                checkoutLink.innerText = `CHECKOUT (${checkoutCount})`;
            } else {
                checkoutContainer.classList.add('hidden');
            }
        }

        function addToCart(foodItem) {
            const existingItem = cart.find(item => item.id === foodItem.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                foodItem.quantity = 1;
                cart.push(foodItem);
            }
            checkoutCount++;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCheckout();
        }

        function goToCheckout(event) {
            if (checkoutCount === 0) {
                event.preventDefault(); // Prevent navigation
                alert("Keranjang kosong! Silakan tambahkan makanan sebelum checkout.");
            } else {
                window.location.href = "/checkout"; // Navigate to checkout
            }
        }

        document.addEventListener('DOMContentLoaded', updateCheckout);
    </script>
</body>

</html>
