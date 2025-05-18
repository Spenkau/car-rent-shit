@extends('layouts.app')

@section('main')
    <section class="car-detail bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">{{ $product->name }}</h1>

            <div class="car-media bg-gray-800 rounded-2xl p-6 mb-8 shadow-lg">
                @if ($product->settings->model_3d)
                    <model-viewer
                        src="{{ asset($product->settings->model_3d) }}"
                        alt="{{ $product->name }}"
                        auto-rotate
                        camera-controls
                        ar
                        shadow-intensity="1"
                        class="w-full h-[400px] rounded-lg"
                    ></model-viewer>
                @else
                    <img
                        src="{{ $product->settings->image ? asset('storage/' . $product->settings->image) : asset('images/cars/placeholder.png') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-[400px] object-cover rounded-lg hover:scale-105 transition-transform"
                    >
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="car-info bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Характеристики</h2>
                    <ul class="list-none p-0 text-gray-300 text-base">
                        <li class="mb-2"><strong>Год выпуска:</strong> {{ $product->settings->release_year ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Тип КПП:</strong> {{ $product->settings->gearbox_type ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Объем двигателя:</strong> {{ $product->settings->engine_volume ?? 'N/A' }} л</li>
                        <li class="mb-2"><strong>Тип двигателя:</strong> {{ $product->settings->engine_type ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Привод:</strong> {{ $product->settings->drive_type ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Мощность:</strong> {{ $product->settings->power ?? 'N/A' }} л.с.</li>
                        <li class="mb-2"><strong>Пробег:</strong> {{ $product->settings->mileage ?? 'N/A' }} км</li>
                        <li class="mb-2"><strong>Количество дверей:</strong> {{ $product->settings->doors_count ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Количество мест:</strong> {{ $product->settings->seats_count ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Цвет:</strong> {{ $product->settings->color ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>VIN:</strong> {{ $product->settings->vin ?? 'N/A' }}</li>
                        <li class="mb-2"><strong>Растаможен:</strong> {{ $product->settings->is_customs_cleared ? 'Да' : 'Нет' }}</li>
                        <li class="mb-2"><strong>Битый:</strong> {{ $product->settings->is_crashed ? 'Да' : 'Нет' }}</li>
                        <li class="mb-2"><strong>В кредите:</strong> {{ $product->settings->is_on_credit ? 'Да' : 'Нет' }}</li>
                    </ul>
                    <div class="mt-6 text-center">
                        <span class="text-xl font-semibold text-orange-500">{{ $product->settings->price }} BYN/сутки</span>
                    </div>
                    <button data-toggle="modal"
                            class="reserve-btn
                                   cursor-pointer
                                   bg-cyan-500
                                   text-white
                                   text-lg
                                   px-8
                                   py-4
                                   rounded-full
                                   w-full
                                   mt-4
                                   hover:bg-cyan-600
                                   hover:scale-105
                                   transition-all
                                   shadow-lg
                            "
                    >
                        Забронировать
                    </button>
                </div>

                <div class="car-tabs lg:col-span-2 bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <div class="tab-buttons flex border-b border-gray-700 mb-4">
                        <button class="tab-button active px-4 py-2 text-sm font-semibold text-white border-b-2 border-cyan-500" data-tab="description">Описание</button>
                        <button class="tab-button px-4 py-2 text-sm font-semibold text-gray-400 hover:text-white" data-tab="comments">Комментарии ({{ $product->comments->count() }})</button>
                    </div>
                    <div class="tab-content">
                        <div id="description" class="tab-pane active text-gray-300 leading-relaxed">
                            {!! $product->description ?: '<p>Описание отсутствует.</p>' !!}
                        </div>
                        <div id="comments" class="tab-pane hidden text-gray-300">
                            @forelse ($product->comments as $comment)
                                <div class="comment bg-gray-700 rounded-lg p-4 mb-4">
                                    <p class="text-sm text-gray-400">{{ $comment->created_at->format('d.m.Y H:i') }}</p>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p>Комментариев пока нет.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-book-car :product="$product"></x-book-car>
    </section>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('border-cyan-500');
                    btn.classList.remove('border-b-2');
                    btn.classList.add('text-gray-400', 'hover:text-white');
                });
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));

                button.classList.add('active', 'border-cyan-500', 'border-b-2');
                button.classList.remove('text-gray-400', 'hover:text-white');
                document.getElementById(button.dataset.tab).classList.remove('hidden');
            });
        });
    </script>
@endsection
