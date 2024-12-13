@extends('dashboard.layout')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="flex flex-col lg:flex-row h-full bg-gray-100 p-6 space-y-6 lg:space-y-0 lg:space-x-6">
        <!-- Main Content -->
        <div class="flex-1 overflow-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold text-teal-600 mb-6">Riwayat Transaksi</h1>
            <a href="{{ route('transactions') }}" class="bg-teal-600 text-white py-2 px-6 rounded-md mb-4 inline-block hover:bg-teal-700 transition duration-300">Tambah Transaksi</a>

            <!-- Transaction History -->
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-teal-500">
                <h3 class="text-xl font-semibold text-teal-600 mb-4">Daftar Transaksi</h3>
                @if($transactions->isEmpty())
                    <p class="text-center text-gray-500">Belum ada transaksi yang terdaftar.</p>
                @else
                    <div class="space-y-4">
                        @foreach($transactions as $transaction)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <div class="flex-1">
                                    <span class="block text-lg font-medium">{{ $transaction->description }}</span>
                                    <span class="text-sm text-gray-500">
                                        {{ $transaction->created_at->format('d M Y, H:i') }} <!-- Format tanggal dan waktu -->
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="block font-medium text-sm text-gray-500">
                                        {{ $transaction->type == 0 ? 'Pengeluaran' : 'Pemasukan' }}
                                    </span>
                                    <span class="{{ $transaction->type == 0 ? 'text-red-500' : 'text-green-500' }} font-semibold text-lg">
                                        {{ number_format($transaction->amount, 2) }} {{ $transaction->account->currency }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Filters (optional) -->
        <div class="w-full lg:w-96 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-teal-600 mb-4">Filter Transaksi</h3>
            <form method="GET" action="{{ route('transaction') }}">
                <div class="space-y-4">
                    <!-- Filter by Date -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-600">Tanggal Mulai</label>
                        <input type="date" name="date_from" id="date_from" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ request()->get('date_from') }}">
                    </div>

                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-600">Tanggal Selesai</label>
                        <input type="date" name="date_to" id="date_to" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ request()->get('date_to') }}">
                    </div>

                    <!-- Filter by Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-600">Kategori</label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Transaction Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-600">Tipe Transaksi</label>
                        <select id="type" name="type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="">Semua Tipe</option>
                            <option value="0" {{ request()->get('type') == '0' ? 'selected' : '' }}>Pengeluaran</option>
                            <option value="1" {{ request()->get('type') == '1' ? 'selected' : '' }}>Pemasukan</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-teal-600 text-white py-2 px-6 rounded-lg hover:bg-teal-700 transition duration-300">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>
@endsection
