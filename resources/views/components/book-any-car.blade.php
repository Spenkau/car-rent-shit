@props(['products'])

<div id="booking-any-modal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-2 sm:px-4 overflow-y-auto">
    <div class="modal-content bg-gray-800 rounded-2xl p-4 sm:p-6 w-full max-w-md sm:max-w-lg my-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-white">
                Бронирование автомобиля
            </h2>
            <button id="close-modal" class="text-gray-400 hover:text-white text-xl">×</button>
        </div>

        <form method="POST" action="{{ route('booking.store') }}" id="booking-form">
            @csrf

            <div class="mb-4">
                <label for="car_id" class="block text-sm font-medium text-gray-300 mb-2">Выберите автомобиль</label>
                <div class="space-y-2 max-h-64 overflow-y-auto">
                    @foreach($products as $product)
                        <label class="flex items-center p-3 bg-gray-700 rounded-lg hover:bg-gray-600 cursor-pointer transition group">
                            <input type="radio" name="product_id" value="{{ $product->id }}" class="mr-4">
                            <img src="{{ $product->settings->image ? asset('storage/' . $product->settings->image) : asset('images/logo.png') }}" alt="{{ $product->name }}"
                                 class="w-16 h-12 object-cover rounded mr-3 border-2 border-transparent group-hover:border-cyan-500">
                            <div>
                                <div class="text-white font-semibold">{{ $product->name }}</div>
                                <div class="text-sm text-gray-300">
                                    {{ $product->settings->release_year }} • {{ $product->settings->power }} л.с. • {{ $product->settings->engine_type }}
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-300">Дата начала</label>
                <input type="date"
                       id="start_date"
                       name="start_date"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-300">Дата окончания</label>
                <input type="date"
                       id="end_date"
                       name="end_date"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
            </div>

            <div class="mb-4">
                <label for="full_name" class="block text-sm font-medium text-gray-300">ФИО</label>
                <input type="text"
                       id="full_name"
                       name="full_name"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       placeholder="Иванов Иван"
                       required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-300">Телефон</label>
                <input type="tel"
                       id="phone"
                       name="phone"
                       placeholder="+375(29)191-91-19"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">
                Забронировать и оплатить
            </button>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('booking-any-modal');
            const closeModalBtn = document.getElementById('close-modal');

            document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            });

            const closeModal = () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
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
