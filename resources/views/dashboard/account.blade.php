@extends('dashboard.layout')

@section('title', 'Akun')

@section('content')
    <div class="flex flex-col lg:flex-row h-full bg-gray-100 p-6 space-y-6 lg:space-y-0 lg:space-x-6">
        <!-- Main Content -->
        <div class="flex-1 overflow-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-semibold text-teal-600 mb-6">Akun Anda</h1>
            <a href="{{ route('account.new') }}" class="bg-teal-600 text-white py-2 px-6 rounded-md mb-4 inline-block hover:bg-teal-700 transition duration-300">Tambah Akun</a>

            <!-- Account Details -->
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-teal-500 mb-6">
                <h3 class="text-xl font-semibold text-teal-600 mb-4">Detail Akun</h3>
                @if($accounts->isEmpty())
                    <p class="text-center text-gray-500">Belum ada akun yang terdaftar.</p>
                @else
                    <div class="space-y-4">
                        @foreach($accounts as $account)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                <div>
                                    <span class="block text-lg font-medium">{{ $account->name }}</span>
                                    <span class="text-sm text-gray-500">Kategori: {{ $account->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-semibold">{{ $account->currency }} {{ number_format($account->balance, 2) }}</span>
                                    <br>
                                    <a href="" class="text-teal-600 hover:underline text-sm mt-1">Edit Akun</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Update Account Form -->
        <div class="w-full lg:w-96 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-teal-600 mb-4">Perbarui Akun</h3>
            <form method="POST" " >
                @csrf
                @method('PUT') <!-- Assuming you are updating the account here -->
                <div class="space-y-4">
                    <!-- Nama Akun -->
                    <div>
                        <label for="accountName" class="block text-sm font-medium text-gray-600">Nama Akun</label>
                        <input id="accountName" type="text" name="name" value="{{ old('name', $account->name ?? '') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>

                    <!-- Saldo Akun -->
                    <div>
                        <label for="balance" class="block text-sm font-medium text-gray-600">Saldo Akun</label>
                        <input id="balance" type="number" name="balance" value="{{ old('balance', $account->balance ?? 0) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                    </div>

                    <!-- Mata Uang -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-600">Mata Uang</label>
                        <select id="currency" name="currency" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="IDR" {{ old('currency', $account->currency ?? 'IDR') == 'IDR' ? 'selected' : '' }}>IDR</option>
                            <option value="USD" {{ old('currency', $account->currency ?? 'USD') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('currency', $account->currency ?? 'EUR') == 'EUR' ? 'selected' : '' }}>EUR</option>
                        </select>
                    </div>

                    <!-- Kategori Akun -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-600">Kategori Akun</label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $account->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-teal-600 text-white py-2 px-6 rounded-lg hover:bg-teal-700 transition duration-300 w-full">Perbarui Akun</button>
                </div>
            </form>
        </div>
    </div>
@endsection
