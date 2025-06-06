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
                    <div class="slider">
                        @php
                            $imageCount = $product->images->count() ?: 1; // Количество изображений или 1 для плейсхолдера
                        @endphp
                        @for ($i = 0; $i < $imageCount; $i++)
                            <input type="radio" name="slide_switch" id="slide{{ $i + 1 }}" {{ $i === 0 ? 'checked' : '' }}>
                        @endfor

                        <div class="slides">
                            @foreach($product->images as $i => $image)
                                <img
                                    src="{{ $image->path ? asset('storage/' . $image->path) : asset('images/cars/placeholder.png') }}"
                                    alt="{{ $product->name }}"
                                    class="slide-img img{{ $i + 1 }}"
                                >
                            @endforeach
                            @if($product->images->isEmpty())
                                <img
                                    src="{{ asset('images/cars/placeholder.png') }}"
                                    alt="{{ $product->name }}"
                                    class="slide-img img1"
                                >
                            @endif
                        </div>

                        <div class="thumbnails">
                            @foreach($product->images as $i => $image)
                                <label for="slide{{ $i + 1 }}">
                                    <img
                                        src="{{ $image->path ? asset('storage/' . $image->path) : asset('images/cars/placeholder.png') }}"
                                        alt="thumb-{{ $product->name }}"
                                    >
                                </label>
                            @endforeach
                            @if($product->images->isEmpty())
                                <label for="slide1">
                                    <img
                                        src="{{ asset('images/cars/placeholder.png') }}"
                                        alt="thumb-{{ $product->name }}"
                                    >
                                </label>
                            @endif
                        </div>
                    </div>
                @endif
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="car-info bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.car_detail.specifications')</h2>
                    <ul class="list-none p-0 text-gray-300 text-base">
                        <li class="mb-2"><strong>@lang('views.car_detail.release_year', ['value' => $product->settings->release_year ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.gearbox_type', ['value' => $product->settings->gearbox_type ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.engine_volume', ['value' => $product->settings->engine_volume ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.engine_type', ['value' => $product->settings->engine_type ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.drive_type', ['value' => $product->settings->drive_type ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.power', ['value' => $product->settings->power ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.mileage', ['value' => $product->settings->mileage ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.doors_count', ['value' => $product->settings->doors_count ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.seats_count', ['value' => $product->settings->seats_count ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.color', ['value' => $product->settings->color ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.vin', ['value' => $product->settings->vin ?? 'N/A'])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.customs_cleared', ['value' => $product->settings->is_customs_cleared ? __('views.car_detail.yes') : __('views.car_detail.no')])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.crashed', ['value' => $product->settings->on_crashed ? __('views.car_detail.yes') : __('views.car_detail.no')])</strong></li>
                        <li class="mb-2"><strong>@lang('views.car_detail.on_credit', ['value' => $product->settings->is_on_credit ? __('views.car_detail.yes') : __('views.car_detail.no')])</strong></li>
                    </ul>
                    <div class="mt-6 text-center">
                        <span class="text-xl font-semibold text-orange-500">@lang('views.car_detail.price_per_day', ['price' => $product->settings->price])</span>
                    </div>
                    <button class="btn reserve-btn bg-cyan-500 text-white text-lg px-8 py-4 rounded-full w-full mt-4 hover:bg-cyan-600 hover:scale-105 transition-all shadow-lg"
                            @if(auth()->check())
                                data-toggle="modal"
                            @else
                                onclick="window.location.href='{{ route('login') }}'"
                        @endif
                    >
                        @lang('views.cars.book')
                    </button>
                </div>

                <div class="car-tabs lg:col-span-2 bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <div class="tab-buttons flex border-b border-gray-700 mb-4">
                        <button class="tab-button active px-4 py-2 text-sm font-semibold text-white border-b-2 border-cyan-500" data-tab="description">@lang('views.car_detail.description_tab')</button>
                        <button class="tab-button px-4 py-2 text-sm font-semibold text-gray-400 hover:text-white" data-tab="comments">@lang('views.car_detail.comments_tab')</button>
                    </div>
                    <div class="tab-content">
                        <div id="description" class="tab-pane active text-gray-300 leading-relaxed">
                            {{ $product->description ?: __('views.car_detail.no_description') }}
                        </div>
                        <div id="comments" class="tab-pane hidden text-gray-300">
                            @forelse ($product->bookings as $booking)
                                @if($booking->comments->isNotEmpty())
                                    <div class="comment bg-gray-700 rounded-lg p-4 mb-4">
                                        <p class="text-sm text-gray-400">{{ $booking->comments->first()->created_at->format('d.m.Y H:i') }}</p>
                                        <p>@lang('views.car_detail.comment.rating', ['rating' => $booking->rating])</p>
                                        <p>@lang('views.car_detail.comment.comment', ['body' => $booking->comments->first()->body])</p>
                                    </div>
                                @endif
                            @empty
                                <p>@lang('views.car_detail.no_comments')</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-book-car :product="$product"></x-book-car>
    </section>

    <style>
        .slider {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        .slider input {
            display: none;
        }

        .slides {
            position: relative;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
        }

        .slide-img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        {!! collect($products)->map(function($_, $i) {
        $i = $i + 1;
        return "#slide{$i}:checked ~ .slides .img{$i} { opacity: 1; z-index: 10; }";
    })->implode("\n") !!}

    .thumbnails {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .thumbnails label {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .thumbnails label:hover {
            transform: scale(1.1);
        }

        .thumbnails img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid transparent;
        }

        input:checked + label img {
            border-color: #0e7490; /* cyan-700 */
        }
    </style>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active', 'border-cyan-500', 'border-b-2');
                    btn.classList.add('text-gray-400', 'hover:text-white');
                });
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));

                button.classList.add('active', 'border-cyan-500', 'border-b-2');
                button.classList.remove('text-gray-400', 'hover:text-white');
                document.getElementById(button.dataset.tab).classList.remove('hidden');
            });
        });
    </script>
@endpush
