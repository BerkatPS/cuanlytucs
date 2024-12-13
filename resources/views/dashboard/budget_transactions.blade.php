@extends('dashboard.layout')

@section('title', 'Daftar Transaksi Anggaran')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Transaksi Anggaran</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Anggaran</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Transaksi</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Jumlah</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($budgetTransactions as $budgetTransaction)
                <tr class="border-t border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $budgetTransaction->budget->category->name }}</td>
                    <td class="px-4 py-2">{{ $budgetTransaction->transaction->description }}</td>
                    <td class="px-4 py-2">{{ number_format($budgetTransaction->amount, 2) }} {{ $budgetTransaction->budget->currency }}</td>
                    <td class="px-4 py-2">
                        <!-- Button delete or edit actions here -->
                        <a href="" class="text-teal-600 hover:text-teal-700">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
