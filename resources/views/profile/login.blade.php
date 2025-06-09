@extends('layouts.app')

@section('main')
    <section class="login bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-white mb-10 text-center">@lang('views.login.title')</h1>

            <div class="login-form bg-gray-800 rounded-2xl p-6 shadow-lg max-w-md mx-auto">
                <form id="login-form" action="{{ route('profile.login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="debug_session_id" value="{{ session()->getId() }}">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-white">@lang('views.login.email')</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-white">@lang('views.login.password')</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500" required>
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white hover:text-cyan-500">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.163-3.825M9.879 14.121A3 3 0 1014.121 9.879M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-1.827 0-3.542-.593-4.975-1.607M15 12l6 6M9 12l-6-6"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-cyan-500 text-white text-lg px-8 py-3 rounded-full hover:bg-cyan-600 hover:scale-105 transition-all shadow-lg">@lang('views.header.login')</button>
                </form>
                <p class="text-white text-center mt-4">
                    @lang('views.login.no_account') <a href="{{ route('register') }}" class="text-cyan-500 hover:underline">@lang('views.header.register')</a>
                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.163-3.825M9.879 14.121A3 3 0 1014.121 9.879M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-1.827 0-3.542-.593-4.975-1.607M15 12l6 6M9 12l-6-6"/>';
            }
        });
    </script>
@endpush
