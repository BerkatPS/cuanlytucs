<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="flex justify-center space-x-6">
        <a href="{{ route('login') }}" id="loginTab" class="py-2 px-4 text-gray-500 hover:text-teal-500">
            Login
        </a>
        <a href="{{ route('register') }}" id="registerTab" class="py-2 px-4 text-teal-500 border-b-2 border-teal-500 font-semibold">
            Register
        </a>
    </div>

    <form id="registerForm" class="space-y-4 mt-6" action="{{ route('register') }}" method="POST">
        @csrf
        <h2 class="text-2xl font-bold text-gray-700 text-center">Register</h2>

        <div class="space-y-2">
            <label for="registerUsername" class="block text-sm font-medium text-gray-600">Username</label>
            <input id="registerUsername" type="text" name="username" value="{{ old('username') }}" placeholder="Enter your username"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('username') border-red-500 @enderror">
            @error('username')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="registerEmail" class="block text-sm font-medium text-gray-600">Email</label>
            <input id="registerEmail" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('email') border-red-500 @enderror">
            @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="registerPassword" class="block text-sm font-medium text-gray-600">Password</label>
            <input id="registerPassword" type="password" name="password" placeholder="Enter your password"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('password') border-red-500 @enderror">
            @error('password')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm your password"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('password_confirmation') border-red-500 @enderror">
            @error('password_confirmation')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-teal-500 text-white py-2 px-4 rounded-lg hover:bg-teal-600 transition">
            Register
        </button>
    </form>
@endsection
