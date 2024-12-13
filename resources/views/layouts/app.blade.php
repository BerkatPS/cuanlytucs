<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gradient-to-r from-teal-500 to-cyan-600 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 space-y-6">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
