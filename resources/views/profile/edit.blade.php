@extends('layouts.app')

@section('main')
    <section class="py-12 bg-gradient-to-r from-gray-800 via-teal-900 to-gray-800 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-2xl bg-gray-800 rounded-2xl p-6 shadow-xl text-white">
            <h2 class="text-2xl font-bold mb-6 text-center">@lang('views.profile.edit_title')</h2>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">@lang('views.profile.name')</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           class="mt-1 w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div>
                    <label for="surname" class="block text-sm font-medium text-gray-300">@lang('views.profile.surname')</label>
                    <input type="text" name="surname" id="surname"
                           value="{{ old('surname', auth()->user()->surname) }}"
                           class="mt-1 w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">@lang('views.profile.email')</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="mt-1 w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-300">@lang('views.profile.phone')</label>
                    <input type="tel" name="phone" id="phone"
                           value="{{ old('phone', auth()->user()->phone) }}"
                           class="mt-1 w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                            class="bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-6 py-2 rounded-full transition-all hover:scale-105">
                        @lang('views.profile.save_changes')
                    </button>
                    <a href="{{ route('profile.index') }}" class="text-sm text-gray-400 hover:text-white">@lang('views.profile.back')</a>
                </div>
            </form>
        </div>
    </section>
@endsection
