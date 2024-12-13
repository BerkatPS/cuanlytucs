@extends('dashboard.layout')

@section('title', 'Tambah Kategori')

@section('content')
    <h2 class="text-4xl font-bold text-gray-900 mb-8">Tambah Kategori Baru</h2>

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-8">
        @csrf
        <div class="bg-white p-10 rounded-xl shadow-2xl max-w-4xl mx-auto">
            <div class="space-y-6">
                <!-- Nama Kategori -->
                <div class="flex flex-col">
                    <label for="name" class="text-lg font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" placeholder="Masukkan nama kategori" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi Kategori -->
                <div class="flex flex-col">
                    <label for="description" class="text-lg font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" class="mt-2 px-4 py-3 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300" rows="5" placeholder="Masukkan deskripsi kategori"></textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <button type="submit" class="bg-teal-600 text-white py-3 px-8 rounded-xl font-semibold hover:bg-teal-700 transition-all duration-300">
                        Simpan Kategori
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
