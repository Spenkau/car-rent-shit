@extends('layouts.app')

@section('main')
    <section
        class="main-banner bg-gradient-to-r from-gray-800 via-teal-900 to-gray-800 py-20 text-center h-[400px] flex items-center justify-center"
        id="home">
        <div class="banner-content max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-5xl font-bold uppercase text-white mb-6">@lang('views.home.main_banner.title')</h1>
            <button
                class="cursor-pointer reserve-btn bg-orange-500 text-white text-lg px-6 py-3 rounded-full border-2 border-orange-500 hover:bg-orange-600 hover:border-orange-600 hover:scale-105 transition-all focus:ring-4 focus:ring-orange-500/50"
                @if(auth()->check())
                    data-toggle="modal"
                @else
                    onclick="window.location.href='{{ route('login') }}'"
                @endif
            >
                @lang('views.home.main_banner.reserve_button')
            </button>
        </div>
    </section>

    <section class="offers bg-white py-16 text-gray-900 text-center">
        <h2 class="text-3xl font-semibold text-orange-500 mb-10">@lang('views.home.offers.title')</h2>
        <div class="car-list max-w-7xl mx-auto flex justify-center gap-6 flex-wrap">
            @foreach($products->take(3) as $product)
                <div
                    class="car-card bg-gray-800 rounded-2xl p-6 w-full sm:w-80 shadow-lg hover:shadow-xl hover:bg-gray-700 transition-all">
                    <img
                        src="{{ $product->settings->image ? asset('storage/' . $product->settings->image) : asset('images/logo.png') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-48 object-cover rounded-lg mb-4 hover:scale-105 transition-transform">
                    <div class="car-info mb-4">
                        <h3 class="text-xl font-bold text-white">{{ $product->name }}</h3>
                        <ul class="list-none p-0 text-gray-400 text-sm">
                            <li>@lang('views.home.offers.year', ['value' => $product->settings->release_year ?? 'N/A'])</li>
                            <li>
                                @if($product->settings->engine_volume)
                                    @lang('views.home.offers.engine_volume', ['value' => $product->settings->engine_volume])
                                @endif
                            </li>
                            <li>
                                @if($product->settings->gearbox_type)
                                    @lang('views.home.offers.gearbox_type', ['value' => $product->settings->gearbox_type])
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="car-bottom flex justify-center items-center gap-4">
                        <span class="car-price text-lg font-semibold text-orange-500">@lang('views.cars.price_per_day', ['price' => $product->price])</span>
                        <a href="{{ route('products.show', $product->slug) }}"
                           class="more-btn bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">@lang('views.home.offers.more')</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="autopark-button-wrapper mt-8">
            <a href="{{ route('products.index') }}"
               class="autopark-btn bg-cyan-500 text-white px-6 py-3 rounded-full text-base font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">@lang('views.home.offers.autopark_button')</a>
        </div>
    </section>

    <section class="advantages bg-white py-20">
        <div class="advantages-wrapper max-w-7xl mx-auto px-4 grid gap-10">
            <div class="text-block max-w-3xl mx-auto">
                <h2 class="section-title text-3xl font-semibold text-gray-900 border-l-4 border-gray-900 pl-4 mb-6">
                    @lang('views.home.advantages.title')
                </h2>
                <p class="section-description text-lg text-gray-600 leading-relaxed mb-5">
                    @lang('views.home.advantages.description')
                </p>
                <ul class="guarantees list-none p-0">
                    @foreach(['guarantees.0', 'guarantees.1', 'guarantees.2'] as $key)
                        <li class="relative pl-6 mb-2 text-base text-gray-600 before:content-[''] before:absolute before:left-0 before:top-2 before:w-2 before:h-2 before:bg-gray-900 before:rounded-full">@lang("views.home.advantages.$key")</li>
                    @endforeach
                </ul>
            </div>
            <div class="icon-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['icon' => 'fleet.png', 'key' => 'fleet'],
                    ['icon' => 'ac.png', 'key' => 'ac'],
                    ['icon' => 'child-seat.png', 'key' => 'child_seat'],
                    ['icon' => 'insurance.png', 'key' => 'insurance'],
                    ['icon' => 'highway.png', 'key' => 'highway'],
                    ['icon' => 'comfort.png', 'key' => 'comfort']
                ] as $icon)
                    <div
                        class="icon-block bg-gray-100 rounded-lg p-6 text-center border border-gray-200 hover:bg-gray-200 transition-colors">
                        <img src="{{ asset('images/icons/' . $icon['icon']) }}" alt="@lang('views.home.advantages.icons.' . $icon['key'])"
                             class="w-11 h-11 mx-auto mb-3 filter grayscale brightness-50">
                        <h4 class="text-sm font-medium text-gray-900">@lang('views.home.advantages.icons.' . $icon['key'])</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rental-terms bg-blue-50 py-16 text-gray-800" id="terms">
        <div class="rental-terms-container max-w-7xl mx-auto px-4 text-center">
            <h2 class="section-title text-4xl font-bold text-blue-900 mb-10">@lang('views.home.rental_terms.title')</h2>
            <div class="rental-grid grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="terms-list bg-white p-6 rounded-2xl shadow-lg">
                    @foreach(['terms.0', 'terms.1', 'terms.2', 'terms.3', 'terms.4'] as $index => $key)
                        <div
                            class="term-item text-lg font-semibold text-gray-800 mb-4 hover:translate-x-2 transition-transform">
                            <span class="text-xl font-bold text-cyan-500">{{ $index + 1 }}</span> @lang("views.home.rental_terms.$key")
                        </div>
                    @endforeach
                </div>
                <div class="terms-image p-4">
                    <img src="{{ asset('images/car-top.png') }}" alt="@lang('views.home.rental_terms.title')"
                         class="w-full rounded-lg object-cover hover:scale-105 transition-transform">
                </div>
                <div class="terms-info bg-white p-6 rounded-2xl shadow-lg">
                    <p class="text-base mb-4">@lang('views.home.rental_terms.info.mileage', ['km' => 300, 'extra_cost' => 10])</p>
                    <p class="text-base mb-4"><strong>@lang('views.home.rental_terms.info.washing')</strong></p>
                    <p class="note text-sm text-gray-500">
                        @lang('views.home.rental_terms.info.deposit_note', ['local_deposit' => 300, 'foreign_deposit' => 600])
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section bg-gray-800 py-16 text-white text-center border-t-4 border-orange-500" id="faq">
        <div class="faq-container max-w-7xl mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-orange-500 mb-10">@lang('views.home.faq.title')</h2>
            <div class="faq-items flex flex-col gap-6">
                @foreach(['items.0', 'items.1', 'items.2', 'items.3'] as $key)
                    <div
                        class="faq-item bg-gray-700 rounded-lg p-6 shadow-lg hover:bg-teal-600 hover:-translate-y-1 transition-all cursor-pointer">
                        <div class="faq-header flex justify-between items-center">
                            <p class="faq-question text-lg font-semibold text-white m-0 flex-grow">@lang("views.home.faq.$key.question")</p>
                            <span class="faq-toggle-icon text-2xl text-white">+</span>
                        </div>
                        <div
                            class="faq-answer text-base text-gray-300 mt-3 p-4 rounded-lg bg-gray-800 hidden">@lang("views.home.faq.$key.answer")</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-book-any-car :products="$products"></x-book-any-car>
@endsection
