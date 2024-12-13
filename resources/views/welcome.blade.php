<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi Manajemen Keuangan Pribadi yang Mudah dan Efektif. Kelola keuangan Anda dengan lebih baik dan bijak.">
    <title>Manajemen Keuangan Pribadi</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-gradient-main {
            background: linear-gradient(to right, #009688, #00bcd4);
        }
        .bg-gradient-section {
            background: linear-gradient(135deg, #009688 0%, #00bcd4 100%);
        }
        .card-shadow {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }
        .header-transition {
            transition: all 0.3s ease-in-out;
        }
        .sticky-header {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Header -->
<header class="fixed top-0 left-0 w-full z-50 bg-transparent py-4 px-6 header-transition">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold text-teal-600">CuanLytics</div>

        <!-- Navigasi -->
        <nav class="hidden md:flex space-x-6">
            <a href="#features" class="text-gray-600 hover:text-teal-600 transition">Fitur</a>
            <a href="#testimonials" class="text-gray-600 hover:text-teal-600 transition">Testimoni</a>
            <a href="#download" class="text-gray-600 hover:text-teal-600 transition">Unduh</a>
        </nav>

        <!-- Tombol Aksi -->
        <div class="hidden md:flex space-x-4">
            <a href="{{ route('login') }}" class="bg-teal-600 text-teal-600 py-2 px-6 rounded-lg text-sm font-medium hover:bg-teal-700 transition">Login</a>
            <a href="{{ route('register') }}" class="bg-gray-100 text-teal-600 py-2 px-6 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Register</a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
            <button id="mobile-menu-btn" class="text-gray-600 hover:text-teal-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg py-4 px-6">
        <nav class="space-y-4">
            <a href="#features" class="block text-gray-600 hover:text-teal-600 transition">Fitur</a>
            <a href="#testimonials" class="block text-gray-600 hover:text-teal-600 transition">Testimoni</a>
            <a href="#download" class="block text-gray-600 hover:text-teal-600 transition">Unduh</a>
        </nav>
        <div class="mt-4 space-y-4">
            <a href="{{ route('login') }}" class="block bg-teal-600 text-white py-2 px-6 rounded-lg text-sm font-medium text-center hover:bg-teal-700 transition">Login</a>
            <a href="{{ route('register') }}" class="block bg-gray-100 text-teal-600 py-2 px-6 rounded-lg text-sm font-medium text-center hover:bg-gray-200 transition">Register</a>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="bg-gradient-main text-white pt-24 pb-20 px-6">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-5xl font-extrabold leading-snug mb-6">Kelola Keuangan Anda<br> dengan Mudah dan Bijak</h1>
        <p class="text-xl mb-8">Aplikasi yang membantu Anda mengontrol pendapatan, pengeluaran, dan anggaran kapan saja di mana saja.</p>
        <a href="#features" class="bg-white text-teal-600 py-3 px-8 rounded-lg text-lg font-semibold transition duration-300 text-black">Jelajahi Fitur</a>
    </div>
</section>

<!-- Fitur Section -->
<section id="features" class="py-16 px-6">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <h2 class="text-3xl font-bold text-teal-600">Kenali Fitur Kami</h2>
        <p class="text-gray-600 mt-4">Fitur-fitur yang dirancang khusus untuk membantu Anda mengelola keuangan dengan lebih baik.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg card-shadow text-center hover:shadow-xl transition">
            <img src="https://via.placeholder.com/100" alt="Ringkasan Akun" class="mx-auto mb-6">
            <h3 class="text-xl font-semibold mb-2">Ringkasan Akun</h3>
            <p class="text-gray-600">Lihat semua akun Anda dalam satu tempat dengan saldo terkini.</p>
        </div>
        <div class="bg-white p-6 rounded-lg card-shadow text-center hover:shadow-xl transition">
            <img src="https://via.placeholder.com/100" alt="Kategori Keuangan" class="mx-auto mb-6">
            <h3 class="text-xl font-semibold mb-2">Kategori Keuangan</h3>
            <p class="text-gray-600">Kelompokkan pengeluaran dan pendapatan Anda dengan mudah.</p>
        </div>
        <div class="bg-white p-6 rounded-lg card-shadow text-center hover:shadow-xl transition">
            <img src="https://via.placeholder.com/100" alt="Grafik Keuangan" class="mx-auto mb-6">
            <h3 class="text-xl font-semibold mb-2">Grafik Keuangan</h3>
            <p class="text-gray-600">Pantau perkembangan keuangan Anda dalam bentuk visual.</p>
        </div>
        <div class="bg-white p-6 rounded-lg card-shadow text-center hover:shadow-xl transition">
            <img src="https://via.placeholder.com/100" alt="Anggaran" class="mx-auto mb-6">
            <h3 class="text-xl font-semibold mb-2">Manajemen Anggaran</h3>
            <p class="text-gray-600">Tentukan dan kelola anggaran bulanan dengan mudah.</p>
        </div>
    </div>
</section>

<!-- Testimoni Section -->
<section id="testimonials" class="bg-gradient-section py-16 text-white">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8">Apa Kata Pengguna?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white text-gray-800 p-6 rounded-lg card-shadow">
                <p class="text-lg mb-4">"Aplikasi ini sangat membantu saya mengelola keuangan keluarga dengan mudah dan cepat."</p>
                <p class="font-semibold text-teal-600">Dewi, 32</p>
            </div>
            <div class="bg-white text-gray-800 p-6 rounded-lg card-shadow">
                <p class="text-lg mb-4">"Statistik keuangan membuat saya sadar pola pengeluaran saya. Sekarang saya bisa lebih bijak mengatur anggaran."</p>
                <p class="font-semibold text-teal-600">Budi, 28</p>
            </div>
            <div class="bg-white text-gray-800 p-6 rounded-lg card-shadow">
                <p class="text-lg mb-4">"Sangat direkomendasikan untuk siapa saja yang ingin mulai mengatur keuangan pribadi."</p>
                <p class="font-semibold text-teal-600">Rina, 25</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section id="download" class="py-16 px-6 text-center">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-teal-600 mb-6">Siap Mengelola Keuangan Anda?</h2>
        <p class="text-gray-600 text-lg mb-8">Coba aplikasi kami dan mulai perjalanan Anda menuju keuangan yang lebih sehat.</p>
        <a href="{{ route('register') }}" class="bg-gradient-main hover:bg-teal-700 text-white py-3 px-8 rounded-lg text-lg font-semibold transition duration-300">Coba Sekarang</a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8 text-center">
    <p>&copy; 2024 CuanLytics | All rights reserved.</p>
</footer>

<button id="back-to-top" class="fixed bottom-5 right-5 hidden bg-gradient-main text-black py-4 px-6 rounded-full shadow-lg hover:bg-teal-700 focus:outline-none transition text-lg">
    ↑
</button>


<script>
    {{--  Smooth Scrolling  --}}
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    {{--    Mobile Menu Toggle--}}
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Sticky header effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.classList.add('sticky-header');
        } else {
            header.classList.remove('sticky-header');
        }
    });

    // Back to top button
    // Back to Top Button
    const backToTopButton = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 250) {
            backToTopButton.classList.remove('hidden');
        } else {
            backToTopButton.classList.add('hidden');
        }
    });
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

</script>
</body>
</html>
