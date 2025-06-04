@extends('layouts.guest')

@section('content')
@if (session('status'))
<div class="mb-4 text-sm text-green-600">
    {{ session('status') }}
</div>
@endif

<div class="login_register_form">
    <h1>Login</h1>
    <br>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500"
                type="password"
                name="password"
                required autocomplete="current-password">
            @error('password')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        <br>
        <div>
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>
        <br>
        <button type="submit" class=" butao button">
            {{ __('Log in') }}
        </button>
    </form>
</div>

@endsection