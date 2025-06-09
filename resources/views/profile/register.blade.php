@extends('layouts.app')

@section('main')
    <section class="register bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-white mb-10 text-center">@lang('views.register.title')</h1>

            <div class="register-form bg-gray-800 rounded-2xl p-6 shadow-lg max-w-md mx-auto">
                <form id="register-form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-white">@lang('views.register.name')</label>
                        <input type="text" id="name" name="name"
                               class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                               oninput="this.value = this.value.replace(/[0-9]/g, '')">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="surname" class="block text-sm font-medium text-white">@lang('views.register.surname')</label>
                        <input type="text" id="surname" name="surname"
                               class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                               oninput="this.value = this.value.replace(/[0-9]/g, '')">
                        @error('surname')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-white">@lang('views.register.email')</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-white">@lang('views.register.password')</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500">
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white hover:text-cyan-500">
                                <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.163-3.825M9.879 14.121A3 3 0 1014.121 9.879M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-1.827 0-3.542-.593-4.975-1.607M15 12l6 6M9 12l-6-6"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-white">@lang('views.register.password_confirmation')</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500">
                            <button type="button" id="toggle-password-confirmation" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white hover:text-cyan-500">
                                <svg id="eye-icon-confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.163-3.825M9.879 14.121A3 3 0 1014.121 9.879M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-1.827 0-3.542-.593-4.975-1.607M15 12l6 6M9 12l-6-6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-cyan-500 text-white text-lg px-8 py-3 rounded-full hover:bg-cyan-600 hover:scale-105 transition-all shadow-lg">@lang('views.header.register')</button>
                </form>
                <p class="text-white text-center mt-4">
                    @lang('views.register.has_account') <a href="{{ route('login') }}" class="text-cyan-500 hover:underline">@lang('views.header.login')</a>
                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.163-3.825M9.879 14.121A3 3 0 1014.121 9.879M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-1.827 0-3.542-.593-4.975-1.607M15 12l6 6M9 12l-6-6"/>';
            }
        });

        // Toggle password confirmation visibility
        document.getElementById('toggle-password-confirmation').addEventListener('click', function () {
            const passwordInput = document.getElementById('password_confirmation');
            const eyeIcon = document.getElementById('eye-icon-confirmation');
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
