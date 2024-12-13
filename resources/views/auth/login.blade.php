<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex justify-center space-x-6">
        <a href="{{ route('login') }}" id="loginTab" class="py-2 px-4 text-teal-500 border-b-2 border-teal-500 font-semibold">
            Login
        </a>
        <a href="{{ route('register') }}" id="registerTab" class="py-2 px-4 text-gray-500 hover:text-teal-500">
            Register
        </a>
    </div>

    <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-4 mt-6" >
        @csrf
        <h2 class="text-2xl font-bold text-gray-700 text-center">Login</h2>
        @if($errors->any())
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="space-y-2">
            <label for="loginEmail" class="block text-sm font-medium text-gray-600">Email</label>
            <input id="loginEmail" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('email') border-red-500 @enderror">
            @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="loginPassword" class="block text-sm font-medium text-gray-600">Password</label>
            <input id="loginPassword" type="password" name="password" placeholder="Enter your password"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('password') border-red-500 @enderror">
            @error('password')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600 transition">
            Login
        </button>
    </form>
@endsection

@push('scripts')
    <script>
        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const loginForm = document.getElementById('loginForm');

        loginTab.addEventListener('click', () => {
            loginForm.classList.remove('hidden');
        });
    </script>
@endpush
