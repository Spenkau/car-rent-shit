@extends('layouts.app')

@section('main')
    <section class="our-cars bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">Наши автомобили</h1>

            <form method="GET" action="{{ route('products.index') }}" class="mb-10">
                <div
                    class="bg-gray-800 rounded-lg p-4 mb-4 flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="w-full md:w-1/3">
                        <input type="text" name="name" placeholder="Название автомобиля"
                               value="{{ request('name') }}"
                               class="w-full bg-gray-700 text-white px-3 py-2 rounded-md focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <button type="button" id="toggle-filters"
                            class="text-sm bg-cyan-500 text-white px-4 py-2 rounded-full hover:bg-cyan-600 transition-all">
                        Дополнительные фильтры
                    </button>

                    <a href="{{ route('products.index') }}"
                       class="bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 transition-all">
                        Сбросить
                    </a>

                    <button type="submit"
                            class="bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 transition-all">
                        Применить
                    </button>
                </div>

                <div id="extra-filters"
                     class="hidden bg-gray-700 rounded-lg p-6 text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="text-gray-300">Год выпуска</label>
                        <input type="number" name="release_year" value="{{ request('release_year') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Тип КПП</label>
                        <select name="gearbox_type"
                                class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                            <option value="">Любой</option>
                            <option value="0" {{ request('gearbox_type') === '0' ? 'selected' : '' }}>Механика</option>
                            <option value="1" {{ request('gearbox_type') === '1' ? 'selected' : '' }}>Автомат</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-300">Объём двигателя (л)</label>
                        <input type="number" step="0.1" name="engine_volume" value="{{ request('engine_volume') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Тип двигателя</label>
                        <input type="number" name="engine_type" value="{{ request('engine_type') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Привод</label>
                        <input type="number" name="drive_type" value="{{ request('drive_type') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Мощность</label>
                        <input type="number" name="power" value="{{ request('power') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Количество дверей</label>
                        <input type="number" name="doors_count" value="{{ request('doors_count') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Количество мест</label>
                        <input type="number" name="seats_count" value="{{ request('seats_count') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Цвет</label>
                        <input type="text" name="color" value="{{ request('color') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">Цена</label>
                        <input type="number" step="0.01" name="price" value="{{ request('price') }}"
                               class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                </div>
            </form>

            <div class="flex justify-end mb-4 gap-2">
                <button type="button" id="grid-view"
                        class="toggle-view bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    Сетка
                </button>
                <button type="button" id="list-view"
                        class="toggle-view bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    Список
                </button>
            </div>
            <div id="products-wrapper"
                 class="car-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all">
                @forelse ($products as $product)
                    <div
                        class="product-item car-card bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl hover:bg-gray-700 transition-all">
                        <img
                            src="{{ $product->settings->image ? asset('storage/' . $product->settings->image) : asset('images/logo.png') }}"
                            alt="{{ $product->name }}"
                            class="w-full h-48 object-cover rounded-lg mb-4 hover:scale-105 transition-transform"
                            onerror="this.onerror=null; this.src='{{ asset('images/cars/placeholder.png') }}';">
                        <div class="car-info mb-4">
                            <h3 class="text-xl font-bold text-white">{{ $product->name }}</h3>
                            <ul class="list-none p-0 text-gray-400 text-sm mt-2">
                                <li>Год выпуска: {{ $product->settings->release_year ?? 'N/A' }}</li>
                                <li>Тип КПП: {{ $product->settings->gearbox_type ?? 'N/A' }}</li>
                                <li>Объем двигателя: {{ $product->settings->engine_volume ?? 'N/A' }} л</li>
                                <li>Тип двигателя: {{ $product->settings->engine_type ?? 'N/A' }}</li>
                                <li>Привод: {{ $product->settings->drive_type ?? 'N/A' }}</li>
                                <li>Мощность: {{ $product->settings->power ?? 'N/A' }} л.с.</li>
                            </ul>
                        </div>
                        <div class="car-bottom flex justify-between items-center">
                            <div class="mt-4 mx-3">
                                <span class="car-price text-lg font-semibold text-orange-500">70 BYN/сутки</span>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="more-btn bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">Подробнее</a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button data-toggle="modal"
                                    class="book-now-btn w-full bg-cyan-500 hover:bg-cyan-700 text-white px-4 py-2 rounded-full">
                                Забронировать
                            </button>
                        </div>
                    </div>
                    <x-book-car :product="$product"></x-book-car>
                @empty
                    <p class="text-center text-gray-400 col-span-full">Автомобили не найдены.</p>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="pagination mt-8 flex justify-center">
                    {{ $products->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const productsWrapper = document.getElementById('products-wrapper');
        const gridBtn = document.getElementById('grid-view');
        const listBtn = document.getElementById('list-view');

        function setView(mode) {
            if (mode === 'list') {
                productsWrapper.classList.remove('grid', 'sm:grid-cols-2', 'lg:grid-cols-3', 'gap-6');
                productsWrapper.classList.add('flex', 'flex-col', 'gap-4');

                document.querySelectorAll('.product-item').forEach(item => {
                    item.classList.add('flex', 'items-center', 'gap-6');
                    item.querySelector('img').classList.add('w-48', 'h-32', 'object-cover');
                    item.querySelector('img').classList.remove('w-full', 'h-48');
                });
            } else {
                productsWrapper.classList.remove('flex', 'flex-col', 'gap-4');
                productsWrapper.classList.add('grid', 'sm:grid-cols-2', 'lg:grid-cols-3', 'gap-6');

                document.querySelectorAll('.product-item').forEach(item => {
                    item.classList.remove('flex', 'items-center', 'gap-6');
                    item.querySelector('img').classList.remove('w-48', 'h-32');
                    item.querySelector('img').classList.add('w-full', 'h-48');
                });
            }

            localStorage.setItem('viewMode', mode);
            updateButtonStates(mode);
        }

        function updateButtonStates(mode) {
            if (mode === 'list') {
                listBtn.classList.add('bg-cyan-600');
                gridBtn.classList.remove('bg-cyan-600');
            } else {
                gridBtn.classList.add('bg-cyan-600');
                listBtn.classList.remove('bg-cyan-600');
            }
        }

        gridBtn.addEventListener('click', () => setView('grid'));
        listBtn.addEventListener('click', () => setView('list'));

        document.addEventListener('DOMContentLoaded', () => {
            const savedMode = localStorage.getItem('viewMode') || 'grid';
            setView(savedMode);
        });

        document.getElementById('toggle-filters').addEventListener('click', () => {
            document.getElementById('extra-filters').classList.toggle('hidden');
        });
    </script>
@endpush
