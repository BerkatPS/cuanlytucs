@extends('dashboard.layout')

@section('title', 'Tambah Transaksi Anggaran')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Transaksi Anggaran</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('budget_transactions.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <!-- Pilih Anggaran -->
                <div>
                    <label for="budget_id" class="block text-lg">Pilih Anggaran</label>
                    <select name="budget_id" id="budget_id" class="w-full px-4 py-2 border rounded-lg" required>
                        @foreach($budgets as $budget)
                            <option value="{{ $budget->id }}">{{ $budget->name }} ({{ $budget->currency }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Transaksi -->
                <div>
                    <label for="transaction_id" class="block text-lg">Pilih Transaksi</label>
                    <select name="transaction_id" id="transaction_id" class="w-full px-4 py-2 border rounded-lg" required>
                        @foreach($transactions as $transaction)
                            <option value="{{ $transaction->id }}">{{ $transaction->description }} ({{ $transaction->type == 1 ? 'Pemasukan' : 'Pengeluaran' }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah Transaksi -->
                <div>
                    <label for="amount" class="block text-lg">Jumlah</label>
                    <input type="number" name="amount" id="amount" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-teal-600 text-white py-2 px-6 rounded-md hover:bg-teal-700">Simpan Transaksi</button>
                </div>
            </div>
        </form>
    </div>
@endsection
