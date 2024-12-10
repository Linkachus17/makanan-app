<html>

<head>
    <title>
        Order
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="{{asset('css/makanan.css')}}"> -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #ffffff, #ffccff);
        }

        .header {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 20px;
        }

        .food-item {
            background-color: #f1f1f1;
            border-radius: 10px;
            margin: 10px;
            text-align: center;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .food-item img {
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .food-item .name {
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .food-item .add-button {
            background-color: #00cc00;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 0 0 10px 10px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .food-item .add-button.added {
            background-color: #00cc00;
        }

        .checkout {
            background-color: #3399ff;
            color: black;
            text-align: center;
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="header">Order</div>
    <div class="container" id="food-container">
        @foreach($makanans as $food)
        <div class="food-item">
            <img src="{{ asset($food->image) }}" alt="{{ $food->name }}" height="200" width="200" />
            <div class="name">{{ $food->name }}</div>
            <button class="add-button" onclick="addToCart({{ json_encode($food)}})">Add</button>
        </div>
        @endforeach
    </div>
    <div class="checkout">
        <a class="button" href="#" id="checkout-link" onclick="goToCheckout(event)">
            CHECKOUT (0)
        </a>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let checkoutCount = cart.reduce((total, item) => total + item.quantity, 0);

        function updateCheckout() {
            document.getElementById('checkout-link').innerText = `CHECKOUT (${checkoutCount})`;
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