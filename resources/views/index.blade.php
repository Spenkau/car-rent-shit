@extends('layouts.app')

@section('main')
    <section class="main-banner bg-gradient-to-r from-gray-800 via-teal-900 to-gray-800 py-20 text-center h-[400px] flex items-center justify-center" id="home">
        <div class="banner-content max-w-2xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-white mb-6">аренда автомобилей в Гродно</h1>
            <button
                data-toggle="modal"
                class="cursor-pointer reserve-btn bg-orange-500 text-white text-lg px-6 py-3 rounded-full border-2 border-orange-500 hover:bg-orange-600 hover:border-orange-600 hover:scale-105 transition-all focus:ring-4 focus:ring-orange-500/50"
            >
                Забронировать
            </button>
        </div>
    </section>

    <section class="offers bg-white py-16 text-gray-900 text-center">
        <h2 class="text-3xl font-semibold text-orange-500 mb-10">Лучшие предложения</h2>
        <div class="car-list max-w-7xl mx-auto flex justify-center gap-6 flex-wrap">
            @foreach($products->take(3) as $product)
                <div class="car-card bg-gray-800 rounded-2xl p-6 w-full sm:w-80 shadow-lg hover:shadow-xl hover:bg-gray-700 transition-all">
                    <img src="{{ $product->settings->image ? asset('storage/' . $product->settings->image) : asset('images/logo.png') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4 hover:scale-105 transition-transform">
                    <div class="car-info mb-4">
                        <h3 class="text-xl font-bold text-white">{{ $product->name }}</h3>
                        <ul class="list-none p-0 text-gray-400 text-sm">
                            <li>Год выпуска: {{ $product->settings->release_year ?? 'N/A' }}</li>
                            <li>{{ $product->settings->engine_volume
                                    ? 'Объем двигателя: ' . $product->settings->engine_volume : null
                                }}
                                {{
                                    $product->settings->gearbox_type
                                        ? 'Тип КПП: ' . $product->settings->gearbox_type
                                        : null
                                }}
                            </li>
                        </ul>
                    </div>
                    <div class="car-bottom flex justify-center items-center gap-4">
                        <span class="car-price text-lg font-semibold text-orange-500">{{ $product->price }}</span>
                        <a href="{{ route('products.show', $product->slug) }}" class="more-btn bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="autopark-button-wrapper mt-8">
            <a href="{{ route('products.index') }}" class="autopark-btn bg-cyan-500 text-white px-6 py-3 rounded-full text-base font-semibold hover:bg-cyan-600 hover:scale-105 transition-all">Наш автопарк</a>
        </div>
    </section>

    <section class="advantages bg-white py-20">
        <div class="advantages-wrapper max-w-7xl mx-auto px-4 grid gap-10">
            <div class="text-block max-w-3xl mx-auto">
                <h2 class="section-title text-3xl font-semibold text-gray-900 border-l-4 border-gray-900 pl-4 mb-6">Почему выбирают CarGrodno</h2>
                <p class="section-description text-lg text-gray-600 leading-relaxed mb-5">
                    Услуги аренды автомобилей для частных лиц, компаний и гостей Беларуси.<br>
                    Простой и удобный сервис, гибкие условия — от одного дня до нескольких месяцев.
                </p>
                <ul class="guarantees list-none p-0">
                    @foreach(['Технически исправные автомобили', 'Всегда чистые и ухоженные салоны', 'Персональный подход к каждому'] as $guarantee)
                        <li class="relative pl-6 mb-2 text-base text-gray-600 before:content-[''] before:absolute before:left-0 before:top-2 before:w-2 before:h-2 before:bg-gray-900 before:rounded-full">{{ $guarantee }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="icon-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['icon' => 'fleet.png', 'text' => 'Большой автопарк'],
                    ['icon' => 'ac.png', 'text' => 'Кондиционер в каждой машине'],
                    ['icon' => 'child-seat.png', 'text' => 'Детское кресло бесплатно'],
                    ['icon' => 'insurance.png', 'text' => 'Страховка включена'],
                    ['icon' => 'highway.png', 'text' => 'Бесплатный проезд по трассам'],
                    ['icon' => 'comfort.png', 'text' => 'Максимальный комфорт']
                ] as $icon)
                    <div class="icon-block bg-gray-100 rounded-lg p-6 text-center border border-gray-200 hover:bg-gray-200 transition-colors">
                        <img src="{{ asset('images/icons/' . $icon['icon']) }}" alt="{{ $icon['text'] }}" class="w-11 h-11 mx-auto mb-3 filter grayscale brightness-50">
                        <h4 class="text-sm font-medium text-gray-900">{{ $icon['text'] }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="rental-terms bg-blue-50 py-16 text-gray-800" id="terms">
        <div class="rental-terms-container max-w-7xl mx-auto px-4 text-center">
            <h2 class="section-title text-4xl font-bold text-blue-900 mb-10">Условия проката автомобиля</h2>
            <div class="rental-grid grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="terms-list bg-white p-6 rounded-2xl shadow-lg">
                    @foreach(['Паспорт', 'Водительское удостоверение', 'Оплата аренды авто', 'Стаж вождения не менее 1 года', 'Залог*'] as $index => $term)
                        <div class="term-item text-lg font-semibold text-gray-800 mb-4 hover:translate-x-2 transition-transform">
                            <span class="text-xl font-bold text-cyan-500">{{ $index + 1 }}</span> {{ $term }}
                        </div>
                    @endforeach
                </div>
                <div class="terms-image p-4">
                    <img src="{{ asset('images/car-top.png') }}" alt="Вид сверху на автомобиль" class="w-full rounded-lg object-cover hover:scale-105 transition-transform">
                </div>
                <div class="terms-info bg-white p-6 rounded-2xl shadow-lg">
                    <p class="text-base mb-4">В стоимость суток аренды включено <strong>300 км пробега</strong>, каждые последующие 100 км — <strong>10 бел. рублей</strong>.</p>
                    <p class="text-base mb-4"><strong>Мойка автомобиля в стоимость аренды не включена!</strong></p>
                    <p class="note text-sm text-gray-500">
                        *Необходим залог, который возвращается при возврате авто в прежнем состоянии (топливо, чистота, техническое состояние).<br>
                        <strong>Для граждан РБ:</strong> 300 бел. рублей<br>
                        <strong>Для иностранных граждан:</strong> 600 бел. рублей
                    </p>
                </div>
            </div>
{{--            <div class="rental-button-wrap mt-8">--}}
{{--                <button class="reserve-btn bg-cyan-500 text-white text-lg px-8 py-4 rounded-full hover:bg-cyan-600 hover:scale-110 transition-all shadow-lg">Оставить заявку</button>--}}
{{--            </div>--}}
        </div>
    </section>

    <section class="faq-section bg-gray-800 py-16 text-white text-center border-t-4 border-orange-500" id="faq">
        <div class="faq-container max-w-7xl mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-orange-500 mb-10">Часто задаваемые вопросы</h2>
            <div class="faq-items flex flex-col gap-6">
                @foreach([
                    ['question' => 'Как я могу забронировать автомобиль?', 'answer' => 'Для бронирования автомобиля выберите нужный автомобиль на нашем сайте, заполните форму и оставьте заявку. Мы свяжемся с вами для подтверждения бронирования.'],
                    ['question' => 'Какие документы необходимы для аренды?', 'answer' => 'Для аренды автомобиля вам нужно предоставить паспорт, водительское удостоверение, а также оплатить аренду и залог, если требуется.'],
                    ['question' => 'Есть ли ограничение по возрасту для арендаторов?', 'answer' => 'Да, для аренды автомобиля необходимо быть старше 21 года и иметь стаж вождения не менее 1 года.'],
                    ['question' => 'Как я могу вернуть автомобиль?', 'answer' => 'Вы можете вернуть автомобиль в пункт проката в течение согласованного срока. Важно вернуть автомобиль в хорошем состоянии, с полным баком и без повреждений.']
                ] as $faq)
                    <div class="faq-item bg-gray-700 rounded-lg p-6 shadow-lg hover:bg-teal-600 hover:-translate-y-1 transition-all cursor-pointer">
                        <div class="faq-header flex justify-between items-center">
                            <p class="faq-question text-lg font-semibold text-white m-0 flex-grow">{{ $faq['question'] }}</p>
                            <span class="faq-toggle-icon text-2xl text-white">+</span>
                        </div>
                        <div class="faq-answer text-base text-gray-300 mt-3 p-4 rounded-lg bg-gray-800 hidden">{{ $faq['answer'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-book-any-car :products="$products"></x-book-any-car>
@endsection
