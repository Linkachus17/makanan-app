<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Process</title>
    <style>
        /* Style untuk loading */
        .loading {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #ffffff, #e6e6ff);
            font-family: Arial, sans-serif;
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #000;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .text {
            font-size: 16px;
            color: #000;
        }

        /* Style untuk selesai */
        .finished {
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column; /* Mengatur arah konten menjadi kolom */
            justify-content: center; /* Pusatkan konten secara vertikal */
            align-items: center; /* Pusatkan konten secara horizontal */
            background: linear-gradient(to bottom, #ffffff, #a8f0b8);
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            display: none; /* Sembunyikan awalnya */
        }

        .container {
            display: flex;
            flex-direction: column; /* Mengatur arah konten menjadi kolom */
            justify-content: center; /* Pusatkan konten secara vertikal */
            align-items: center; /* Pusatkan konten secara horizontal */
            text-align: center; /* Pusatkan teks */
        }

        .checkmark {
            font-size: 100px;
            color: #00cc44;
        }

        .message {
            font-size: 20px;
            color: #333;
        }

        .arrow {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 30px;
            color: #333;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

    <!-- View Loading -->
    <div class="loading" id="loadingView">
        <div class="container">
            <div class="spinner"></div>
            <div class="text">Membuat pesanan...</div>
        </div>
    </div>

    <!-- View Selesai -->
    <div class="finished" id="finishedView">
        <div class="container">
            <div class="checkmark">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="message">
                <p>Pesanan anda telah diproses!</p>
                <p>Silahkan menunggu pesanan anda datang~</p>
            </div>
        </div>
        <div class="arrow">
            <i class="fas fa-chevron-up"></i>
        </div>
    </div>

    <script>
        // Simulasi proses loading
        setTimeout(function() {
            // Sembunyikan view loading
            document.getElementById('loadingView').style.display = 'none';
            // Tampilkan view selesai
            document.getElementById('finishedView').style.display = 'flex';
        }, 3000); // Ganti 3000 dengan waktu loading yang diinginkan (dalam milidetik)
    </script>

</body>
</html>