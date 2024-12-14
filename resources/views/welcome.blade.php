<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di CuanLytics</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
<!-- Container -->
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-3xl mx-auto">
        <!-- Image Section -->
        <div class="bg-teal-600 p-6 text-center">
            <img src="https://images.unsplash.com/photo-1567427018141-0584cfcbf1b8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400&h=200" alt="Ilustrasi Keuangan" class="mx-auto rounded-lg">
        </div>

        <!-- Text Section -->
        <div class="p-6 text-center">
            <h1 class="text-3xl font-bold text-teal-600 mb-4">Selamat Datang di CuanLytics</h1>
            <p class="text-gray-700 mb-6">Kelola keuangan Anda dengan mudah, efektif, dan bijak. Dengan CuanLytics, Anda dapat mengontrol pendapatan, pengeluaran, dan anggaran kapan saja di mana saja.</p>
            <p class="text-gray-700 mb-6">Mulai perjalanan Anda menuju keuangan yang lebih sehat hari ini!</p>

            <!-- Buttons -->
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-teal-600 text-white py-2 px-6 rounded-lg font-medium hover:bg-teal-700 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-gray-100 text-teal-600 py-2 px-6 rounded-lg font-medium hover:bg-gray-200 transition">Register</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
