@extends('layouts.app')

@section('main')
    <section class="profile bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-white mb-10 text-center">@lang('views.profile.title')</h1>

            <div class="profile-info bg-gray-800 rounded-2xl p-6 shadow-lg max-w-md mx-auto mb-12">
                <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.profile.user_info')</h2>
                <ul class="list-none p-0 text-white text-base leading-relaxed">
                    <li class="mb-2">@lang('views.profile.name') {{ auth()->user()->name }}</li>
                    <li class="mb-2">@lang('views.profile.email') {{  auth()->user()->email }}</li>
                    <li class="mb-2">@lang('views.profile.registration_date') {{ auth()->user()->created_at->format('d.m.Y') }}</li>
                    @if($favProduct = auth()->user()->product()->first())
                        <li class="mb-2">
                            <a href="{{ route('products.show', ['slug' => $favProduct->value('slug')]) }}"
                               class="flex items-center gap-3">
                                <img src="{{ asset($favProduct->settings()->value('image')) }}"
                                     alt="{{ $favProduct->value('name') }}"
                                     class="w-16 h-10 object-cover rounded-md">
                                <div>
                                    @lang('views.profile.favorite_car', ['name' => $favProduct->value('name')])
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="mt-6 text-center">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-block bg-orange-500 text-white px-5 py-2 rounded-full font-medium hover:bg-orange-600 hover:scale-105 transition-all">
                        @lang('views.profile.edit_profile')
                    </a>
                </div>
            </div>

            <div class="bookings bg-gray-800 rounded-2xl p-6 shadow-lg max-w-4xl mx-auto">
                <h2 class="text-2xl font-semibold text-orange-500 mb-6">@lang('views.profile.bookings')</h2>

                @if($bookings->isNotEmpty())
                    <form method="GET" action="{{ route('profile.index') }}"
                          class="mb-6 flex flex-col md:flex-row items-center justify-between gap-4 bg-gray-800 p-4 rounded-xl">
                        <label for="payment_status" class="text-white text-sm font-medium">@lang('views.profile.payment_filter')</label>
                        <select name="payment_status" id="payment_status" onchange="this.form.submit()"
                                class="bg-gray-700 text-white rounded px-4 py-2 focus:ring-2 focus:ring-cyan-500">
                            <option value="">@lang('views.profile.payment_filter_options.all')</option>
                            <option value="1" {{ request('payment_status') === '1' ? 'selected' : '' }}>@lang('views.profile.payment_filter_options.paid')</option>
                            <option value="0" {{ request('payment_status') === '0' ? 'selected' : '' }}>@lang('views.profile.payment_filter_options.not_paid')</option>
                        </select>
                    </form>
                    @forelse($bookings as $booking)
                        <div class="mb-6 border border-gray-700 rounded-xl p-4 bg-gray-700">
                            <h3 class="text-xl font-bold text-cyan-400">{{ $booking->product->name }}</h3>
                            <p class="text-sm text-gray-300 mt-1">
                                @lang('views.profile.booking_dates', [
                                    'start_date' => \Carbon\Carbon::parse($booking->start_date)->format('d.m.Y'),
                                    'end_date' => \Carbon\Carbon::parse($booking->end_date)->format('d.m.Y')
                                ])
                            </p>
                            <p class="text-sm text-gray-400">{{ \App\Enums\BookStatus::tryFrom($booking->status)->name() }}</p>
                            @if($booking->payment_status  === \App\Enums\BookPayment::PAID->value)
                                <p class="text-sm text-gray-400">@lang('views.profile.payment_status_title'):
                                    <span class="font-medium text-green-400">{{ \App\Enums\BookPayment::PAID->name() }}</span>
                                </p>
                            @elseif($booking->payment_status  === \App\Enums\BookPayment::NOT_PAID->value)
                                <p class="text-sm text-gray-400">@lang('views.profile.payment_status_title'):
                                    <span class="font-medium text-red-400">{{ \App\Enums\BookPayment::NOT_PAID->name() }}</span>
                                </p>
                                <a class="btn w-full bg-gray-800 border border-gray-700 text-white text-sm px-1 py-1 mt-2 rounded"
                                   href="{{ route('payment.show') . '?booking_id=' . $booking->id }}">
                                    @lang('views.profile.pay_button')
                                </a>
                            @endif
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div class="mt-3">
                                    <button class="flex items-center justify-between bg-yellow-500 text-black font-semibold py-2 px-4 rounded cursor-pointer hover:bg-yellow-600 transition"
                                            @if(auth()->check()) data-toggle="modal" @else onclick="window.location.href='{{ route('login') }}'" @endif>
                                        @lang('views.profile.rebook')
                                    </button>
                                </div>
                                @if($booking->status === \App\Enums\BookStatus::WAIT_FOR_APPROVE->value)
                                    <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}" class="mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" btn bg-red-500 text-white font-semibold py-2 px-4 rounded cursor-pointer hover:bg-red-600 transition"
                                                onclick="return confirm('@lang('views.profile.confirm_cancel')')">
                                            @lang('views.profile.cancel_booking')
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <x-book-car :product="$booking->product"></x-book-car>
                            @php $uniqueId = 'rate-toggle-' . $booking->id; @endphp

                            @if($booking->status === \App\Enums\BookStatus::FINISHED->value && is_null($booking->rating))
                                <div class="mt-4">
                                    <input type="checkbox" id="{{ $uniqueId }}" class="hidden peer">
                                    <label for="{{ $uniqueId }}"
                                           class="w-full flex items-center justify-between bg-yellow-500 text-black font-semibold py-2 px-4 rounded cursor-pointer hover:bg-yellow-600 transition"
                                           data-booking-id="{{ $booking->id }}">
                                        @lang('views.profile.rate_trip')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 transition-transform duration-300 peer-checked:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </label>
                                    <div class="mt-4 hidden peer-checked:block bg-gray-700 border border-gray-600 p-4 rounded-lg">
                                        <form id="rate-form-{{ $booking->id }}" class="space-y-4" data-form-id="{{ $booking->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <div>
                                                <label for="rating-{{ $booking->id }}" class="block thext-sm font-medium text-white mb-1">@lang('views.profile.rating_label')</label>
                                                <select name="rating" id="rating-{{ $booking->id }}"
                                                        class="w-full bg-gray-800 border border-gray-700 text-white py-2 px-3 rounded">
                                                    <option value="" disabled>@lang('views.profile.select_rating')</option>
                                                    @for($i = 5; $i >= 1; $i--)
                                                        <option value="{{ $i }}">@lang('views.profile.stars', ['count' => $i])</option>
                                                    @endfor
                                                </select>
                                                <div id="rating-error-{{ $booking->id }}" class="text-red-500 text-sm mt-1"></div>
                                            </div>
                                            <div>
                                                <label for="comment-{{ $booking->id }}" class="block text-sm font-medium text-white mb-1">@lang('views.profile.comment_label')</label>
                                                <textarea name="comment" id="comment-{{ $booking->id }}" rows="3"
                                                          class="w-full bg-gray-800 border border-gray-700 text-white py-2 px-3 rounded"
                                                          placeholder="{{ __('views.profile.comment_placeholder') }}"></textarea>
                                                <div id="comment-error-{{ $booking->id }}" class="text-red-500 text-sm mt-1"></div>
                                            </div>
                                            <button type="submit"
                                                    class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 px-4 rounded transition">
                                                @lang('views.profile.submit_review')
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-400 text-center">@lang('views.profile.no_bookings')</p>
                    @endforelse
                @else
                    <p class="text-gray-400 text-center">@lang('views.profile.no_bookings')</p>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            document.querySelectorAll('[data-form-id]').forEach(form => {
                const bookingId = form.getAttribute('data-form-id');
                const ratingError = document.getElementById(`rating-error-${bookingId}`);
                const commentError = document.getElementById(`comment-error-${bookingId}`);
                const checkbox = document.getElementById(`rate-toggle-${bookingId}`);
                const ratingSelect = form.querySelector(`#rating-${bookingId}`);
                const commentTextarea = form.querySelector(`#comment-${bookingId}`);

                // Восстановление данных из localStorage
                const savedData = localStorage.getItem(`form-data-${bookingId}`);
                if (savedData) {
                    const { rating, comment } = JSON.parse(savedData);
                    if (rating) ratingSelect.value = rating;
                    if (comment) commentTextarea.value = comment;
                }

                // Сохранение данных при изменении
                form.addEventListener('change', () => {
                    localStorage.setItem(`form-data-${bookingId}`, JSON.stringify({
                        rating: ratingSelect.value,
                        comment: commentTextarea.value
                    }));
                });

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    // Сбрасываем предыдущие ошибки
                    ratingError.textContent = '';
                    commentError.textContent = '';

                    try {
                        const response = await fetch(`/bookings/${bookingId}/rate`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                rating: ratingSelect.value,
                                comment: commentTextarea.value,
                                _method: 'PATCH'
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            if (response.status === 422) {
                                // Обработка ошибок валидации
                                if (data.errors.rating) {
                                    ratingError.textContent = data.errors.rating[0];
                                }
                                if (data.errors.comment) {
                                    commentError.textContent = data.errors.comment[0];
                                }
                            } else {
                                throw new Error(data.message || '@lang("views.profile.error")');
                            }
                            return;
                        }

                        alert(data.success);
                        form.reset();
                        if (checkbox) checkbox.checked = false;
                        localStorage.removeItem(`form-data-${bookingId}`);
                        localStorage.removeItem(`form-open-${bookingId}`);

                        setTimeout(() => window.location.reload(), 100);

                    } catch (error) {
                        console.error('@lang("views.profile.error"):', error);
                        alert('@lang("views.profile.error") ' + error.message);
                    }
                });
            });
        });
    </script>
@endpush
