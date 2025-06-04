@extends('layouts.app')

@section('main')
    <section class="our-cars bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">@lang('views.cars.title')</h1>

            <form method="GET" action="{{ route('products.index') }}" class="mb-10">
                <div class="bg-gray-800 rounded-lg p-4 mb-4 flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="w-full md:w-1/3 relative">
                        <input
                            type="text"
                            name="name"
                            placeholder="@lang('views.cars.search_placeholder')"
                            value="{{ request('name') }}"
                            class="w-full bg-gray-700 text-white px-3 py-2 rounded-md focus:ring-2 focus:ring-cyan-500"
                            id="product-search"
                            autocomplete="off"
                        >
                        <!-- Контейнер для выпадающих подсказок -->
                        <div
                            id="suggestions"
                            class="absolute z-10 w-full bg-gray-800 border border-gray-700 rounded-md mt-1 hidden"
                        ></div>
                    </div>

                    <button type="button" id="toggle-filters" class="text-sm bg-cyan-500 text-white px-4 py-2 rounded-full hover:bg-cyan-600 transition-all">
                        @lang('views.cars.extra_filters')
                    </button>

                    <a href="{{ route('products.index') }}" class="bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 transition-all">
                        @lang('views.cars.reset')
                    </a>

                    <button type="submit" class="bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 transition-all">
                        @lang('views.cars.apply')
                    </button>
                </div>

                <div id="extra-filters" class="hidden bg-gray-700 rounded-lg p-6 text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="text-gray-300">@lang('views.cars.release_year')</label>
                        <input type="number" name="release_year" value="{{ request('release_year') }}" min="1980" max="2025" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.gearbox_type')</label>
                        <select name="gearbox_type" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                            <option value="">@lang('views.cars.gearbox_options.any')</option>
                            <option value="1" {{ request('gearbox_type') === '1' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.manual')</option>
                            <option value="2" {{ request('gearbox_type') === '2' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.automatic')</option>
                            <option value="3" {{ request('gearbox_type') === '3' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.robotic')</option>
                            <option value="4" {{ request('gearbox_type') === '4' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.variator')</option>
                            <option value="5" {{ request('gearbox_type') === '5' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.dual_clutch')</option>
                            <option value="6" {{ request('gearbox_type') === '6' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.semiautomatic')</option>
                            <option value="7" {{ request('gearbox_type') === '7' ? 'selected' : '' }}>@lang('views.cars.gearbox_options.sequential')</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.engine_volume')</label>
                        <input type="number" step="0.1" name="engine_volume" value="{{ request('engine_volume') }}" min="0.5" max="8.0" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.engine_type')</label>
                        <select name="engine_type" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                            <option value="">@lang('views.cars.engine_options.any')</option>
                            <option value="1" {{ request('engine_type') === '1' ? 'selected' : '' }}>@lang('views.cars.engine_options.petrol')</option>
                            <option value="2" {{ request('engine_type') === '2' ? 'selected' : '' }}>@lang('views.cars.engine_options.diesel')</option>
                            <option value="3" {{ request('engine_type') === '3' ? 'selected' : '' }}>@lang('views.cars.engine_options.electric')</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.drive_type')</label>
                        <select name="drive_type" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                            <option value="">@lang('views.cars.drive_options.any')</option>
                            <option value="1" {{ request('drive_type') === '1' ? 'selected' : '' }}>@lang('views.cars.drive_options.front')</option>
                            <option value="2" {{ request('drive_type') === '2' ? 'selected' : '' }}>@lang('views.cars.drive_options.rear')</option>
                            <option value="3" {{ request('drive_type') === '3' ? 'selected' : '' }}>@lang('views.cars.drive_options.electric')</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.power')</label>
                        <input type="number" name="power" value="{{ request('power') }}" min="50" max="2000" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.doors_count')</label>
                        <select name="doors_count" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                            <option value="">@lang('views.cars.doors_options.any')</option>
                            <option value="2" {{ request('doors_count') === '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ request('doors_count') === '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ request('doors_count') === '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ request('doors_count') === '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.seats_count')</label>
                        <input type="number" name="seats_count" value="{{ request('seats_count') }}" min="1" max="50" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.color')</label>
                        <input type="text" name="color" value="{{ request('color') }}" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="text-gray-300">@lang('views.cars.price')</label>
                        <input type="number" step="0.01" name="price" value="{{ request('price') }}" min="1" max="1000000000" class="w-full bg-gray-800 text-white px-3 py-2 rounded-md">
                    </div>
                </div>
            </form>

            <div class="flex justify-end mb-4 gap-2">
                <button type="button" id="grid-view" class="toggle-view bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    @lang('views.cars.grid_view')
                </button>
                <button type="button" id="list-view" class="toggle-view bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    @lang('views.cars.list_view')
                </button>
            </div>
            <div id="products-wrapper" class="car-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all">
                @forelse ($products as $product)
                    <div class="product-item car-card bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl hover:bg-gray-700 transition-all">
                        <img
                            src="{{ $product->images->first()?->path ? asset('storage/' . $product->images->first()->path) : asset('images/cars/placeholder.png') }}"
                            alt="{{ $product->name }}"
                            class="w-full h-48 object-cover rounded-lg mb-4 hover:scale-105 transition-transform"
                            onerror="this.onerror=null; this.src='{{ asset('images/cars/placeholder.png') }}';"
                        >
                        <div class="car-info mb-4">
                            <h3 class="text-xl font-bold text-white">{{ $product->name }}</h3>
                            <ul class="list-none p-0 text-gray-400 text-sm mt-2">
                                <li>@lang('views.car_detail.release_year', ['value' => $product->settings->release_year ?? 'N/A'])</li>
                                <li>@lang('views.car_detail.gearbox_type', ['value' => $product->settings->gearbox_type ?? 'N/A'])</li>
                                <li>@lang('views.car_detail.engine_volume', ['value' => $product->settings->engine_volume ?? 'N/A'])</li>
                                <li>@lang('views.car_detail.engine_type', ['value' => $product->settings->engine_type ?? 'N/A'])</li>
                                <li>@lang('views.car_detail.drive_type', ['value' => $product->settings->drive_type ?? 'N/A'])</li>
                                <li>@lang('views.car_detail.power', ['value' => $product->settings->power ?? 'N/A'])</li>
                            </ul>
                        </div>
                        <div class="car-bottom flex justify-between items-center">
                            <div class="mt-4 mx-3">
                                <span class="car-price text-lg font-semibold text-orange-500">@lang('views.cars.price_per_day', ['price' => $product->settings->price])</span>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('products.show', $product->slug) }}" class="more-btn bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">@lang('views.cars.more')</a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="book-now-btn w-full bg-cyan-500 hover:bg-cyan-700 text-white px-4 py-2 rounded-full" @if(auth()->check()) data-toggle="modal" @else onclick="window.location.href='{{ route('login') }}'" @endif>
                                @lang('views.cars.book')
                            </button>
                        </div>
                    </div>
                    <x-book-car :product="$product"></x-book-car>
                @empty
                    <p class="text-center text-gray-400 col-span-full">@lang('views.cars.no_cars')</p>
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

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('product-search');
            const suggestionsBox = document.getElementById('suggestions');

            let activeRequest = null; // чтобы отменять предыдущий AJAX (если нужно)

            /**
             * Функция: получить подсказки с сервера
             * @param {string} query — введённая часть названия
             */
            function fetchSuggestions(query) {
                // Если предыдущий запрос ещё в процессе — можно отменить (необязательно)
                if (activeRequest) {
                    activeRequest.abort();
                }

                // Создаём объект XMLHttpRequest
                activeRequest = new XMLHttpRequest();
                activeRequest.open('GET', '{{ route('products.suggestions') }}' + '?query=' + encodeURIComponent(query), true);

                activeRequest.onreadystatechange = function () {
                    if (activeRequest.readyState === 4) {
                        if (activeRequest.status === 200) {
                            // Парсим JSON
                            const data = JSON.parse(activeRequest.responseText);
                            showSuggestions(data);
                        } else {
                            // В случае ошибки просто скрываем подсказки
                            hideSuggestions();
                        }
                        activeRequest = null;
                    }
                };

                activeRequest.send();
            }

            /**
             * Функция: отображает блок подсказок
             * @param {Array<string>} items — массив названий для автодополнения
             */
            function showSuggestions(items) {
                // Если подсказок нет — скрываем
                if (!items || items.length === 0) {
                    hideSuggestions();
                    return;
                }

                // Формируем HTML-список подсказок
                let html = '<ul class="list-none m-0 p-0">';
                items.forEach(function (item) {
                    html += '<li class="px-3 py-2 hover:bg-gray-600 cursor-pointer suggestion-item">' +
                        item +
                        '</li>';
                });
                html += '</ul>';

                suggestionsBox.innerHTML = html;
                suggestionsBox.classList.remove('hidden');
            }

            /**
             * Скрыть блок подсказок
             */
            function hideSuggestions() {
                suggestionsBox.innerHTML = '';
                suggestionsBox.classList.add('hidden');
            }

            // При клике на одно из предложений — подставляем значение в input и отправляем форму
            suggestionsBox.addEventListener('click', function (e) {
                if (e.target && e.target.matches('.suggestion-item')) {
                    searchInput.value = e.target.textContent.trim();
                    hideSuggestions();
                    // После выбора можно, например, автоматически отправить форму:
                    // searchInput.closest('form').submit();
                }
            });

            // Если кликнули вне поля ввода или блока подсказок — прячем подсказки
            document.addEventListener('click', function (e) {
                if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                    hideSuggestions();
                }
            });

            // При вводе текста в input
            searchInput.addEventListener('input', function () {
                const query = this.value.trim();

                if (query.length >= 2) {
                    // Запрашиваем подсказки, только если введено не менее 2 символов
                    fetchSuggestions(query);
                } else {
                    hideSuggestions();
                }
            });

        });
    </script>
@endpush
