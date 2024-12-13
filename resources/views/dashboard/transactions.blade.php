@extends('dashboard.layout')

@section('title', 'Form Transaksi')

@section('content')
    <h2 class="text-4xl font-bold text-gray-900 mb-10">Riwayat Transaksi Anda</h2>

    <!-- Form untuk Menambahkan Transaksi -->
    <div class="bg-white p-10 rounded-lg shadow-xl max-w-3xl mx-auto">
        <h3 class="text-2xl font-bold text-teal-600 mb-6">Tambah Transaksi</h3>
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Deskripsi Transaksi -->
                <div class="flex flex-col">
                    <label for="description" class="text-lg font-medium text-gray-700">Deskripsi Transaksi</label>
                    <input type="text" name="description" id="description" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" placeholder="Masukkan deskripsi transaksi" required>
                </div>

                <!-- Jumlah Transaksi -->
                <div class="flex flex-col">
                    <label for="amount" class="text-lg font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="amount" id="amount" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" placeholder="Masukkan jumlah" required>
                </div>
            </div>

            <!-- Tipe Transaksi -->
            <div class="flex flex-col">
                <label for="type" class="text-lg font-medium text-gray-700">Tipe Transaksi</label>
                <select name="type" id="type" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300">
                    <option value="1">Pemasukan</option>
                    <option value="0">Pengeluaran</option>
                </select>
            </div>

            <!-- Akun yang Terlibat -->
            <div class="flex flex-col">
                <label for="account_id" class="text-lg font-medium text-gray-700">Pilih Akun</label>
                <select name="account_id" id="account_id" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" required>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }} - {{ $account->currency }} {{ number_format($account->balance, 2) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Kategori Transaksi -->
            <div class="flex flex-col">
                <label for="category_id" class="text-lg font-medium text-gray-700">Kategori Transaksi</label>
                <select name="category_id" id="category_id" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Pilih Anggaran -->
            <div class="flex flex-col">
                <label for="budget_id" class="text-lg font-medium text-gray-700">Pilih Anggaran (Opsional)</label>
                <select name="budget_id" id="budget_id" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300">
                    <option value="">-- Tidak Ada --</option>
                    @foreach($budgets as $budget)
                        <option value="{{ $budget->id }}">{{ $budget->category->name }} (Sisa: {{ number_format($budget->remainingAmount(), 2) }})</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between items-center mt-8">
                <button type="submit" class="bg-teal-600 text-white py-3 px-10 rounded-xl font-semibold hover:bg-teal-700 transition-all duration-300">Simpan Transaksi</button>
                <a href="{{ route('transactions') }}" class="bg-transparent border-2 border-teal-600 text-teal-600 py-3 px-10 rounded-xl font-semibold hover:bg-teal-600 hover:text-white transition-all duration-300">Kembali</a>
            </div>
        </form>
    </div>
@endsection
