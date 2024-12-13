@extends('dashboard.layout')

@section('title', 'Buat Akun Baru')

@section('content')
    <h2 class="text-4xl font-bold text-gray-900 mb-8">Buat Akun Baru</h2>

    <!-- Form untuk Membuat Akun Baru -->
    <div class="bg-white p-10 rounded-lg shadow-xl max-w-4xl mx-auto">
        <h3 class="text-2xl font-bold text-teal-600 mb-6">Buat Akun</h3>
        <form action="{{ route('account.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nama Akun -->
                <div class="flex flex-col">
                    <label for="name" class="text-lg font-medium text-gray-700">Nama Akun</label>
                    <input type="text" name="name" id="name" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" placeholder="Masukkan nama akun" required>
                </div>

                <!-- Jenis Akun -->
                <div class="flex flex-col">
                    <label for="account_type" class="text-lg font-medium text-gray-700">Jenis Akun</label>
                    <select name="account_type" id="account_type" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" required>
                        <option value="tabungan">Tabungan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                        <option value="investasi">Investasi</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Saldo Awal -->
                <div class="flex flex-col">
                    <label for="balance" class="text-lg font-medium text-gray-700">Saldo Awal</label>
                    <input type="text" name="balance" id="balance" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" placeholder="Masukkan saldo awal" required>
                </div>

                <!-- Mata Uang -->
                <div class="flex flex-col">
                    <label for="currency" class="text-lg font-medium text-gray-700">Mata Uang</label>
                    <select name="currency" id="currency" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" required>
                        <option value="IDR">IDR (Rupiah)</option>
                    </select>
                </div>
            </div>

            <div class=" justify-end mt-8">
                <button type="submit" class="bg-teal-600 text-white py-3 px-10 rounded-xl font-semibold hover:bg-teal-700 transition-all duration-300">
                    Buat Akun
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Fungsi untuk memformat saldo menjadi mata uang (contoh IDR)
        function formatCurrency(input) {
            let value = input.value.replace(/[^0-9]/g, ''); // Menghapus karakter selain angka
            if (value) {
                value = parseInt(value).toLocaleString(); // Format angka menjadi IDR
            }
            input.value = value ? 'Rp ' + value : ''; // Menambahkan 'Rp' di depan angka
        }

        document.getElementById('balance').addEventListener('input', function() {
            formatCurrency(this);
        });

        // Menangani pengiriman form untuk menghapus simbol 'Rp' saat submit
        document.querySelector('form').addEventListener('submit', function(e) {
            let balanceField = document.getElementById('balance');
            let balanceValue = balanceField.value.replace(/[^0-9]/g, ''); // Hanya mengambil angka
            balanceField.value = balanceValue; // Set input value menjadi hanya angka
        });
    </script>
@endpush
