<html>

<head>
    <title>
        Checkout
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="{{asset('css/checkout.css')}}"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            background-color: #f8f8f8;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header i {
            font-size: 24px;
            margin-right: 10px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .food-list {
            width: 60%;
        }

        .food-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .food-item img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .food-item .food-name {
            flex-grow: 1;
            font-size: 18px;
        }

        .food-item .quantity-controls {
            display: flex;
            align-items: center;
        }

        .food-item .quantity-controls button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            margin: 0 5px;
            cursor: pointer;
        }

        .food-item .quantity-controls button.minus {
            background-color: #f44336;
        }

        .summary {
            width: 35%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .summary h2 {
            font-size: 18px;
            margin-top: 0;
        }

        .summary ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .summary ul li {
            margin-bottom: 10px;
        }

        .summary .total {
            font-size: 24px;
            margin: 20px 0;
        }

        .summary .dine-in {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .summary .dine-in input {
            margin-right: 10px;
        }

        .summary button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="/makanan" style="text-decoration: none; color: black;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1>Checkout</h1>
    </div>
    <div class="container">
        <div class="food-list" id="food-list"></div>
        <div class="summary">
            <h2>Summary</h2>
            <ul id="summary-list"></ul>
            <div class="total" id="total-price">Rp. 0</div>
            <div class="dine-in">
                <input id="dine-in" type="checkbox" />
                <label for="dine-in">Dine-in?</label>
            </div>
            <button id="order-button">ORDER</button>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCheckout() {
            const foodList = document.getElementById('food-list');
            const summaryList = document.getElementById('summary-list');
            const totalPrice = document.getElementById('total-price');
            foodList.innerHTML = '';
            summaryList.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const foodItem = document.createElement('div');
                foodItem.className = 'food-item';
                foodItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" height="80" width="80" />
                    <div class="food-name">${item.name}</div>
                    <div class="quantity-controls">
                        <button class="plus" onclick="changeQuantity(${index}, 1)">+</button>
                        <span>${item.quantity}</span>
                        <button class="minus" onclick="changeQuantity(${index}, -1)">-</button>
                    </div>
                `;
                foodList.appendChild(foodItem);

                const summaryItem = document.createElement('li');
                summaryItem.innerText = `${item.name} (qty: ${item.quantity}) - Rp. ${item.price * item.quantity}`;
                summaryList.appendChild(summaryItem);

                total += item.price * item.quantity;
            });

            totalPrice.innerText = `Rp. ${total}`;
        }

        function changeQuantity(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCheckout();
        }

        document.addEventListener('DOMContentLoaded', updateCheckout);
    </script>
</body>

</html>