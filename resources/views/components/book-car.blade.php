@props(['product'])

<div id="booking-modal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden px-2 sm:px-4 overflow-y-auto">
    <div class="modal-content bg-gray-800 rounded-2xl p-4 sm:p-6 w-full max-w-md sm:max-w-lg my-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-white">
                @lang('views.booking.title_single', ['name' => $product->name])
            </h2>
            <button id="close-modal" class="text-gray-400 hover:text-white text-xl">×</button>
        </div>

        <div class="text-white text-sm sm:text-base mb-4">
            <p>@lang('views.booking.car', ['name' => $product->name])</p>
            <p>@lang('views.booking.price_per_day', ['price' => $product->settings->price])</p>
        </div>

        <form method="POST" action="{{ route('booking.store') }}" id="booking-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-300">@lang('views.booking.start_date')</label>
                <input type="date"
                       id="start_date"
                       name="start_date"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-300">@lang('views.booking.end_date')</label>
                <input type="date"
                       id="end_date"
                       name="end_date"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       required>
            </div>

            <script>
                const start = document.getElementById('start_date');
                const end = document.getElementById('end_date');

                start.addEventListener('change', () => {
                    end.min = start.value;
                });
            </script>

            <div class="mb-4">
                <label for="full_name" class="block text-sm font-medium text-gray-300">@lang('views.booking.full_name')</label>
                <input type="text"
                       id="full_name"
                       name="full_name"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       placeholder="{{ __('views.booking.full_name_placeholder') }}"
                       value="{{ auth()->check() ? auth()->user()->name . ' ' . auth()->user()->surname : '' }}"
                       required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-300">@lang('views.booking.phone')</label>
                <input type="tel"
                       id="phone"
                       name="phone"
                       placeholder="{{ __('views.booking.phone_placeholder') }}"
                       class="w-full bg-gray-700 text-white rounded-md px-4 py-2 mt-1 focus:ring-2 focus:ring-cyan-500"
                       value="{{ auth()->check() ? auth()->user()->phone : '' }}"
                       required>
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
            const modal = document.getElementById('booking-modal');
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
