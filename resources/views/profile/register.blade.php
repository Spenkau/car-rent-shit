@extends('layouts.app')

@section('main')
    <section class="register bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-white mb-10 text-center">Регистрация</h1>

            <div class="register-form bg-gray-800 rounded-2xl p-6 shadow-lg max-w-md mx-auto">
                <form id="register-form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-white">Имя</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="surname" class="block text-sm font-medium text-white">Фамилия</label>
                        <input type="text" id="surname" name="surname" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                        @error('surname')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-white">Пароль</label>
                        <input type="password" id="password" name="password" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-white">Подтверждение пароля</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                    </div>
                    <button type="submit" class="w-full bg-cyan-500 text-white text-lg px-8 py-3 rounded-full hover:bg-cyan-600 hover:scale-105 transition-all shadow-lg">Зарегистрироваться</button>
                </form>
                <p class="text-white text-center mt-4">
                    Уже есть аккаунт? <a href="{{ route('login') }}" class="text-cyan-500 hover:underline">Войдите</a>
                </p>
            </div>
        </div>
    </section>
@endsection
