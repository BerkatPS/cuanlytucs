@extends('dashboard.layout')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="flex flex-col lg:flex-row h-full bg-gray-100 p-6 space-y-6 lg:space-y-0 lg:space-x-6">
        <!-- Main Content -->
        <div class="flex-1 overflow-auto bg-white p-6 rounded-lg shadow-lg">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-teal-600">Daftar Kategori</h2>

                <!-- Add Category Button -->
                <a href="{{ route('categories.create') }}" class="bg-teal-600 text-white py-2 px-6 rounded-md hover:bg-teal-700 transition duration-300">Tambah Kategori</a>
            </div>

            <!-- Notifikasi jika ada -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Daftar Kategori -->
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-teal-500">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Kategori</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">{{ $category->description }}</td>
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="text-teal-600 hover:text-teal-700 transition">Edit</a> |
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Filters (optional) -->
        <div class="w-full lg:w-96 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-teal-600 mb-4">Filter Kategori</h3>
            <form method="GET" action="{{ route('categories') }}">
                <div class="space-y-4">
                    <!-- Search by Name -->
                    <div>
                        <label for="search_name" class="block text-sm font-medium text-gray-600">Nama Kategori</label>
                        <input type="text" name="search_name" id="search_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Cari berdasarkan nama" value="{{ request()->get('search_name') }}">
                    </div>

                    <!-- Search by Description -->
                    <div>
                        <label for="search_description" class="block text-sm font-medium text-gray-600">Deskripsi</label>
                        <input type="text" name="search_description" id="search_description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Cari berdasarkan deskripsi" value="{{ request()->get('search_description') }}">
                    </div>

                    <button type="submit" class="w-full bg-teal-600 text-white py-2 px-6 rounded-lg hover:bg-teal-700 transition duration-300">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>
@endsection
