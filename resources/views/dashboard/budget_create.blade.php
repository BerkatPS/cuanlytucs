@extends('dashboard.layout')

@section('title', 'Tambah Anggaran')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100 p-6">
        <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-xl border-t-4 border-teal-500">
            <h2 class="text-3xl font-semibold text-teal-600 mb-6">Tambah Anggaran Baru</h2>

            <!-- Form for Creating Budget -->
            <form action="{{ route('budgets.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Select Category -->
                <div class="flex flex-col space-y-2">
                    <label for="category" class="text-lg font-medium text-gray-700">Pilih Kategori</label>
                    <select name="category_id" id="category" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-teal-500">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Budget Amount -->
                <div class="flex flex-col space-y-2">
                    <label for="amount" class="text-lg font-medium text-gray-700">Jumlah Anggaran</label>
                    <input type="number" name="limit_amount" id="amount" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-teal-500" value="{{ old('limit_amount') }}" required>
                    @error('limit_amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Start Date -->
                <div class="flex flex-col space-y-2">
                    <label for="start_date" class="text-lg font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-teal-500" value="{{ old('start_date') }}" required>
                    @error('start_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="flex flex-col space-y-2">
                    <label for="end_date" class="text-lg font-medium text-gray-700">Tanggal Berakhir</label>
                    <input type="date" name="end_date" id="end_date" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-teal-500" value="{{ old('end_date') }}" required>
                    @error('end_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-teal-600 text-white py-3 px-8 rounded-lg hover:bg-teal-700 transition duration-300">
                        Simpan Anggaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
