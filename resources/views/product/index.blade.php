@extends('layouts.app')

@section('main')
    <section class="our-cars bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">Наши автомобили</h1>

            <!-- Filter Bar -->
            <div class="filter-bar bg-gray-800 rounded-lg p-4 mb-8 flex flex-wrap gap-4 justify-between items-center">
                <div class="filter-group">
                    <label for="gearbox" class="text-sm font-medium text-gray-300 mr-2">Тип CP:</label>
                    <select id="gearbox"
                            class="bg-gray-700 text-white rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-cyan-500">
                        <option value="">Все</option>
                        <option value="manual">Механика</option>
                        <option value="automatic">Автомат</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="sort" class="text-sm font-medium text-gray-300 mr-2">Сортировка:</label>
                    <select id="sort"
                            class="bg-gray-700 text-white rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-cyan-500">
                        <option value="price-asc">Цена: по возрастанию</option>
                        <option value="price-desc">Цена: по убыванию</option>
                        <option value="year-desc">Год: новые</option>
                        <option value="year-asc">Год: старые</option>
                    </select>
                </div>
                <button
                    class="bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">
                    Применить
                </button>
            </div>

            <div class="car-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div
                        class="car-card bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl hover:bg-gray-700 transition-all">
                        <img src="{{ $product->settings->image ? asset('storage/' . $product->settings->image) : asset('images/logo.png') }}" alt="{{ $product->name }}"
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
                            <span class="car-price text-lg font-semibold text-orange-500">70 BYN/сутки</span>
                            <a href="{{ route('products.show', $product->slug) }}"
                               class="more-btn bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">Подробнее</a>
                        </div>
                        <div class="mt-4">
                            <button data-toggle="modal"
                                    class="book-now-btn w-full bg-cyan-500 hover:bg-cyan-700 text-white px-4 py-2 rounded-full">
                                Забронировать
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-400 col-span-full">Автомобили не найдены.</p>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="pagination mt-8 flex justify-center">
                    {{ $products->links('vendor.pagination.tailwind') }}
                </div>
            @endif

            <x-book-car :product="$product"></x-book-car>
        </div>
    </section>
@endsection
