@extends('dashboard.layout')

@section('title', 'Anggaran Saya')

@section('content')
    <div class="flex flex-col lg:flex-row h-full bg-gray-100 p-6 space-y-6 lg:space-y-0 lg:space-x-6">
        <!-- Main Content -->
        <div class="flex-1 overflow-auto bg-white p-6 rounded-lg shadow-lg">

            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-teal-600">Anggaran Saya</h2>
                <a href="{{ route('budgets.create') }}" class="bg-teal-600 text-white py-2 px-6 rounded-md hover:bg-teal-700 transition duration-300">Tambah Anggaran</a>
            </div>
            <!-- Success Notification -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Budget Table -->
            <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg border-t-4 border-teal-500">
                <div class="min-w-full">
                    <table class="table-auto w-full text-sm text-gray-700">
                        <thead class="bg-teal-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Nama Kategori</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Jumlah Anggaran</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal Mulai</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal Berakhir</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($budgets as $budget)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-6 py-4">{{ $budget->category->name }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($budget->limit_amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $budget->start_date }}</td>
                                <td class="px-6 py-4">{{ $budget->end_date }}</td>
                                <td class="px-6 py-4">
                                    @if($budget->is_over_budget)
                                        <span class="text-red-500 font-semibold">Melebihi Batas</span>
                                    @else
                                        <span class="text-green-500 font-semibold">Dalam Batas</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('budgets.edit', $budget->id) }}" class="text-teal-600 hover:text-teal-700 transition">Edit</a> |
                                    <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Budget Summary Section -->
        <div class="w-full lg:w-96 bg-white p-6 rounded-lg shadow-lg border-t-4 border-teal-500">
            <h3 class="text-xl font-semibold text-teal-600 mb-4">Ringkasan Anggaran</h3>

            <!-- Active Budget Summary -->
            <ul class="space-y-4">
                @foreach($budgets as $budget)
                    <li class="flex justify-between items-center">
                        <span class="text-gray-600">{{ $budget->category->name }}</span>
                        <span class="{{ $budget->is_over_budget ? 'text-red-500' : 'text-green-500' }} font-semibold">
                    {{ $budget->is_over_budget ? 'Melebihi Batas' : 'Dalam Batas' }}
                </span>
                    </li>
                @endforeach
            </ul>
            <!-- Total Budgeted Amount -->
            <div class="mt-6 border-t pt-6">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-700">Total Anggaran</span>
                    <span class="text-xl font-semibold text-teal-600">
            @if($budgets->isNotEmpty() && $budgets->first()->user && $budgets->first()->user->account)
                            {{ number_format($budgets->sum('limit_amount'), 2) }} {{ $budgets->first()->user->account }}
                        @else
                            <span class="text-lg font-semibold text-teal-600">0</span>
                        @endif
                    </span>
                </div>
            </div>


        </div>
    </div>

@endsection
