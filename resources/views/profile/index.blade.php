@extends('layouts.app')

@section('main')
    <section class="profile bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-white mb-10 text-center">Профиль</h1>

            <div class="profile-info bg-gray-800 rounded-2xl p-6 shadow-lg max-w-md mx-auto mb-12">
                <h2 class="text-2xl font-semibold text-orange-500 mb-4">Ваши данные</h2>
                <ul class="list-none p-0 text-white text-base leading-relaxed">
                    <li class="mb-2"><strong>Имя:</strong> {{ auth()->user()->name }}</li>
                    <li class="mb-2"><strong>Email:</strong> {{ auth()->user()->email }}</li>
                    <li class="mb-2"><strong>Дата регистрации:</strong> {{ auth()->user()->created_at->format('d.m.Y') }}</li>
                    @if($favProduct = auth()->user()->product()->first())
                        <li class="mb-2">
                            <a href="{{ route('products.show', ['slug' => $favProduct->value('slug')]) }}" class="flex items-center gap-3">
                                <img src="{{ asset($favProduct->settings()->value('image')) }}"
                                     alt="{{ $favProduct->value('name') }}"
                                     class="w-16 h-10 object-cover rounded-md">
                                <div>
                                    <strong>Любимое авто:</strong> {{ $favProduct->value('name') }}
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="mt-6 text-center">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-block bg-orange-500 text-white px-5 py-2 rounded-full font-medium hover:bg-orange-600 hover:scale-105 transition-all">
                        Редактировать профиль
                    </a>
                </div>
            </div>


            <div class="bookings bg-gray-800 rounded-2xl p-6 shadow-lg max-w-4xl mx-auto">
                <h2 class="text-2xl font-semibold text-orange-500 mb-6">Ваши бронирования</h2>

                <form method="GET" action="{{ route('profile.index') }}" class="mb-6 flex flex-col md:flex-row items-center justify-between gap-4 bg-gray-800 p-4 rounded-xl">
                    <label for="payment_status" class="text-white text-sm font-medium">Фильтр по оплате:</label>
                    <select name="payment_status" id="payment_status" onchange="this.form.submit()"
                            class="bg-gray-700 text-white rounded px-4 py-2 focus:ring-2 focus:ring-cyan-500">
                        <option value="">Все</option>
                        <option value="1" {{ request('payment_status') === '1' ? 'selected' : '' }}>Только оплаченные</option>
                        <option value="0" {{ request('payment_status') === '0' ? 'selected' : '' }}>Только неоплаченные</option>
                    </select>
                </form>


            @forelse($bookings as $booking)
                    <div class="mb-6 border border-gray-700 rounded-xl p-4 bg-gray-700">
                        <h3 class="text-xl font-bold text-cyan-400">{{ $booking->product->name }}</h3>
                        <p class="text-sm text-gray-300 mt-1">С {{ \Carbon\Carbon::parse($booking->start_date)->format('d.m.Y') }}
                            по {{ \Carbon\Carbon::parse($booking->end_date)->format('d.m.Y') }}</p>
                        <p class="text-sm text-gray-400">Статус бронирования:
                            <span class="font-medium text-white">
                                {{ \App\Enums\BookStatus::tryFrom($booking->status)->name() }}
                            </span>
                        </p>
                        @if($booking->payment_status  === \App\Enums\BookPayment::PAID->value)
                            <p class="text-sm text-gray-400">Оплата:
                                <span class="font-medium text-green-400">
                                    Оплачено
                                </span>
                            </p>
                        @elseif($booking->payment_status  === \App\Enums\BookPayment::NOT_PAID->value)
                            <p class="text-sm text-gray-400">Оплата:
                                <span class="font-medium text-red-400">
                                    Не оплачено
                                </span>
                            </p>
                            <a class="btn w-full bg-gray-800 border border-gray-700 text-white text-sm  px-1 py-1 mt-2 rounded"
                               href="{{ route('payment.show') . "?booking_id=" . $booking->id }}"
                            >
                                Оплатить
                            </a>
                        @endif


                        @php $uniqueId = 'rate-toggle-' . $booking->id; @endphp

                        @if($booking->status === \App\Enums\BookStatus::FINISHED->value && is_null($booking->rating))
                            <div class="mt-4">
                                <input type="checkbox" id="{{ $uniqueId }}" class="hidden peer">

                                <label for="{{ $uniqueId }}"
                                       class="w-full flex items-center justify-between bg-yellow-500 text-black font-semibold py-2 px-4 rounded cursor-pointer hover:bg-yellow-600 transition">
                                    Оценить поездку
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transition-transform duration-300 peer-checked:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </label>

                                <div class="mt-4 hidden peer-checked:block bg-gray-700 border border-gray-600 p-4 rounded-lg">
                                    <form action="{{ route('booking.rate', $booking) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PATCH')

                                        <div>
                                            <label for="rating-{{ $booking->id }}" class="block text-sm font-medium text-white mb-1">Оценка:</label>
                                            <select name="rating" id="rating-{{ $booking->id }}" required
                                                    class="w-full bg-gray-800 border border-gray-700 text-white py-2 px-3 rounded">
                                                <option value="" disabled selected>Выберите оценку</option>
                                                @for($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}">{{ $i }} звёзд{{ $i > 1 ? 'ы' : 'а' }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div>
                                            <label for="comment-{{ $booking->id }}" class="block text-sm font-medium text-white mb-1">Комментарий:</label>
                                            <textarea name="comment" id="comment-{{ $booking->id }}" rows="3"
                                                      class="w-full bg-gray-800 border border-gray-700 text-white py-2 px-3 rounded"
                                                      placeholder="Что понравилось или нет..." required></textarea>
                                        </div>

                                        <button type="submit"
                                                class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 px-4 rounded transition">
                                            Отправить отзыв
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-400 text-center">Вы пока ничего не бронировали.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
