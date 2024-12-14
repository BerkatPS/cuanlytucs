<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            margin-left: 16rem; /* Sesuaikan dengan lebar sidebar */
        }

    </style>
    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="bg-gray-100 font-sans">

<!-- Sidebar and Main Content -->
<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-teal-600 text-white p-6 flex flex-col">
        <div class="text-2xl font-semibold mb-8">Dashboard</div>
        <ul class="space-y-6">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-lg hover:bg-teal-700 px-3 py-2 rounded-lg transition">
                    <span class="material-icons-outlined mr-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('account') }}" class="flex items-center space-x-2 text-lg hover:bg-teal-700 px-3 py-2 rounded-lg transition">
                    <span class="material-icons-outlined mr-3">Akun</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaction') }}" class="flex items-center space-x-2 text-lg hover:bg-teal-700 px-3 py-2 rounded-lg transition">
                    <span class="material-icons-outlined mr-3">Transaksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categories') }}" class="flex items-center space-x-2 text-lg hover:bg-teal-700 px-3 py-2 rounded-lg transition">
                    <span class="material-icons-outlined mr-3">Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('budgets.index') }}" class="flex items-center space-x-2 text-lg hover:bg-teal-700 px-3 py-2 rounded-lg transition">
                    <span class="material-icons-outlined mr-3">Budgeting</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>

        <!-- Content -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            @yield('content')
        </div>
    </div>

</div>

</body>
</html>
