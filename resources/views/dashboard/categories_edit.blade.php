@extends('dashboard.layout')

@section('title', 'Edit Kategori')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Kategori</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="space-y-4">
                <!-- Nama Kategori -->
                <div>
                    <label for="name" class="block text-lg">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi Kategori -->
                <div>
                    <label for="description" class="block text-lg">Deskripsi</label>
                    <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg" rows="4">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-lg">Status</label>
                    <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg">
                        <option value="1" {{ $category->status ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$category->status ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                <button type="submit" class="bg-teal-600 text-white py-2 px-6 rounded-md mt-4">Update Kategori</button>
            </div>
        </div>
    </form>
@endsection
