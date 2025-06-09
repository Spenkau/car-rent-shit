@props(['products'])

<div id="booking-any-modal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-2 sm:px-4 overflow-y-auto">
    <div class="modal-content bg-gray-800 rounded-2xl p-4 sm:p-6 w-full max-w-md sm:max-w-lg my-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-white">
                @lang('views.booking.title_any')
            </h2>
            <button id="close-modal" class="text-gray-400 hover:text-white text-xl">×</button>
        </div>

        <form method="POST" action="{{ route('booking.store') }}" id="booking-form">
            @csrf

            <div class="mb-4">
                <label for="car_id" class="block text-sm font-medium text-gray-300 mb-2">@lang('views.booking.select_car')</label>
                <div class="space-y-2 max-h-64 overflow-y-auto">
                    @foreach($products as $product)
                        <label class="flex items-center p-3 bg-gray-700 rounded-lg hover:bg-gray-600 cursor-pointer transition group">
                            <input type="radio" name="product_id" value="{{ $product->id }}" class="mr-4">
                            <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->path) : asset('images/logo.png') }}" alt="{{ $product->name }}"
                                 class="w-16 h-12 object-cover rounded mr-3 border-2 border-transparent group-hover:border-cyan-500">
                            <div>
                                <div class="text-white font-semibold">{{ $product->name }}</div>
                                <div class="text-sm text-gray-300">
                                    {{ $product->settings->release_year }} • {{ $product->settings->power }} @lang('views.car_detail.power', ['value' => '']) • @lang('views.car_detail.engine_type', ['value' => $product->settings->engine_type ?? 'N/A'])
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                <div id="error-product_id" class="text-red-500 text-sm mt-1 hidden"></div>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-300">@lang('views.booking.start_date')</label>
                <input type="date"
                       id="start_date"
                       name="start_date"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
                <div id="error-start_date" class="text-red-500 text-sm mt-1 hidden"></div>
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-300">@lang('views.booking.end_date')</label>
                <input type="date"
                       id="end_date"
                       name="end_date"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
                <div id="error-end_date" class="text-red-500 text-sm mt-1 hidden"></div>
            </div>

            <div class="mb-4">
                <label for="full_name" class="block text-sm font-medium text-gray-300">@lang('views.booking.full_name')</label>
                <input type="text"
                       id="full_name"
                       name="full_name"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       placeholder="{{ __('views.booking.full_name_placeholder') }}"
                       required>
                <div id="error-full_name" class="text-red-500 text-sm mt-1 hidden"></div>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-300">@lang('views.booking.phone')</label>
                <input type="tel"
                       id="phone"
                       name="phone"
                       placeholder="{{ __('views.booking.phone_placeholder') }}"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
                <div id="error-phone" class="text-red-500 text-sm mt-1 hidden"></div>
            </div>

            <button type="submit"
                    class="w-full bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">
                @lang('views.booking.book_and_pay')
            </button>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('booking-any-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const form = document.getElementById('booking-form');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            // Функция для проверки года (должен быть ровно 4 цифры)
            const restrictYearToFourDigits = (input, errorElementId) => {
                input.addEventListener('change', () => {
                    const errorElement = document.getElementById(errorElementId);
                    const dateValue = input.value;
                    if (dateValue) {
                        const year = dateValue.split('-')[0]; // Получаем год из формата YYYY-MM-DD
                        if (year.length !== 4 || isNaN(year)) {
                            errorElement.textContent = 'Год должен состоять ровно из 4 цифр.';
                            errorElement.classList.remove('hidden');
                            input.value = ''; // Очищаем поле, если год некорректен
                        } else {
                            errorElement.textContent = '';
                            errorElement.classList.add('hidden');
                        }
                    }
                });
            };

            // Применяем проверку к полям start_date и end_date
            restrictYearToFourDigits(startDateInput, 'error-start_date');
            restrictYearToFourDigits(endDateInput, 'error-end_date');

            // Функция для очистки всех ошибок
            const clearErrors = () => {
                const errorElements = document.querySelectorAll('[id^="error-"]');
                errorElements.forEach(element => {
                    element.classList.add('hidden');
                    element.textContent = '';
                });
            };

            // Обработка отправки формы
            form.addEventListener('submit', (e) => {
                e.preventDefault(); // Предотвращаем стандартную отправку формы
                clearErrors(); // Очищаем предыдущие ошибки

                // Проверка года перед отправкой формы
                const startYear = startDateInput.value.split('-')[0];
                const endYear = endDateInput.value.split('-')[0];
                if (startYear.length !== 4 || isNaN(startYear)) {
                    document.getElementById('error-start_date').textContent = 'Год должен состоять ровно из 4 цифр.';
                    document.getElementById('error-start_date').classList.remove('hidden');
                    return;
                }
                if (endYear.length !== 4 || isNaN(endYear)) {
                    document.getElementById('error-end_date').textContent = 'Год должен состоять ровно из 4 цифр.';
                    document.getElementById('error-end_date').classList.remove('hidden');
                    return;
                }

                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            // Отображаем ошибки под соответствующими полями
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.getElementById(`error-${field}`);
                                if (errorElement) {
                                    errorElement.textContent = data.errors[field].join(' ');
                                    errorElement.classList.remove('hidden');
                                }
                            });
                        } else if (data.success) {
                            // Успешная отправка
                            window.location.href = '/payment?booking_id=' + data.booking_id;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Произошла ошибка при отправке формы.');
                    });
            });

            document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    clearErrors(); // Очищаем ошибки при открытии
                });
            });

            const closeModal = () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                clearErrors(); // Очищаем ошибки при закрытии
            };

            closeModalBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
        });
    </script>
@endpush
