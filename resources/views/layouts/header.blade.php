<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Link ke file CSS jika ada -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Menggunakan CDN untuk Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Sidebar dan Konten Utama -->
<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-1/4 md:w-1/5 lg:w-1/6 bg-teal-600 text-white p-6">
        <div class="text-2xl font-semibold mb-8">Dashboard</div>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center text-lg hover:bg-teal-700 p-2 rounded-md">
                    <span class="material-icons-outlined mr-3">dashboard</span> Overview
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ route('budget') }}" class="flex items-center text-lg hover:bg-teal-700 p-2 rounded-md">--}}
{{--                    <span class="material-icons-outlined mr-3">attach_money</span> Budget--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('transaction') }}" class="flex items-center text-lg hover:bg-teal-700 p-2 rounded-md">
                    <span class="material-icons-outlined mr-3">credit_card</span> Transactions
                </a>
            </li>
            <li>
                <a href="{{ route('account') }}" class="flex items-center text-lg hover:bg-teal-700 p-2 rounded-md">
                    <span class="material-icons-outlined mr-3">account_circle</span> Account
                </a>
            </li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="flex-1 p-6 overflow-y-auto">
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

        <!-- Konten Halaman -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            @yield('content')
        </div>
    </div>

</div>

</body>
</html>
