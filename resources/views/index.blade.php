@extends('layouts.app')

@section('main')
    <section class="main-banner" id="home">
        <div class="banner-content">
            <h1 class="uppercase">аренда автомобилей в гродно</h1>
            <button class="reserve-btn">Забронировать</button>
        </div>
    </section>
    <div class="offers">
        <h2>Лучшие предложения</h2>
        <div class="car-list">
            <div class="car-card">
                <img src="{{ asset('images/cars/seat-leon.png') }}" alt="Seat Leon">
                <div class="car-info">
                    <h3>Seat Leon</h3>
                    <ul>
                        <li>Год выпуска: 2018</li>
                        <li>Объем двигателя: 1.5</li>
                    </ul>
                </div>
                <div class="car-bottom">
                    <span class="car-price">70 BYN</span>
                    <a href="#" class="more-btn">Подробнее</a>
                </div>
            </div>
            <div class="car-card">
                <img src="{{ asset("images/cars/toyota-prius.png") }}" alt="Toyota Prius C">
                <div class="car-info">
                    <h3>Toyota Prius C</h3>
                    <ul>
                        <li>Год выпуска: 2015</li>
                        <li>Тип КПП: механика</li>
                    </ul>
                </div>
                <div class="car-bottom">
                    <span class="car-price">60 BYN</span>
                    <a href="#" class="more-btn">Подробнее</a>
                </div>
            </div>
            <div class="car-card">
                <img src="{{ asset("images/cars/hyundai-accent.png") }}" alt="Hyundai Accent">
                <div class="car-info">
                    <h3>Hyundai Accent</h3>
                    <ul>
                        <li>Год выпуска: 2022</li>
                        <li>Объем двигателя: 1.5</li>
                    </ul>
                </div>
                <div class="car-bottom">
                    <span class="car-price">70 BYN</span>
                    <a href="#" class="more-btn">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="autopark-button-wrapper">
            <a href="{{ route('product.index') }}" class="autopark-btn">Наш автопарк</a>
        </div>
    </div>
    <section class="advantages">
        <div class="advantages-wrapper">
            <div class="text-block">
                <h2 class="section-title">Почему выбирают CarGrodno</h2>
                <p class="section-description">
                    Услуги аренды автомобилей для частных лиц, компаний и гостей Беларуси.<br>
                    Простой и удобный сервис, гибкие условия — от одного дня до нескольких месяцев.
                </p>
                <ul class="guarantees">
                    <li>Технически исправные автомобили</li>
                    <li>Всегда чистые и ухоженные салоны</li>
                    <li>Персональный подход к каждому</li>
                </ul>
            </div>

            <div class="icon-grid">
                <div class="icon-block">
                    <img src="{{ asset('images/icons/fleet.png') }}" alt="Автопарк">
                    <h4>Большой автопарк</h4>
                </div>
                <div class="icon-block">
                    <img src="{{ asset('images/icons/ac.png') }}" alt="Кондиционер">
                    <h4>Кондиционер в каждой машине</h4>
                </div>
                <div class="icon-block">
                    <img src="{{ asset('images/icons/child-seat.png') }}" alt="Кресло">
                    <h4>Детское кресло бесплатно</h4>
                </div>
                <div class="icon-block">
                    <img src="{{ asset('images/icons/insurance.png') }}" alt="Страховка">
                    <h4>Страховка включена</h4>
                </div>
                <div class="icon-block">
                    <img src="{{ asset('images/icons/highway.png') }}" alt="Магистрали">
                    <h4>Бесплатный проезд по трассам</h4>
                </div>
                <div class="icon-block">
                    <img src="{{ asset('images/icons/comfort.png') }}" alt="Комфорт">
                    <h4>Максимальный комфорт</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="rental-terms" id="terms">
        <div class="rental-terms-container">
            <h2 class="section-title">Условия проката автомобиля</h2>
            <div class="rental-grid">
                <div class="terms-list">
                    <div class="term-item"><span>1</span> Паспорт</div>
                    <div class="term-item"><span>2</span> Водительское удостоверение</div>
                    <div class="term-item"><span>3</span> Оплата аренды авто</div>
                    <div class="term-item"><span>4</span> Стаж вождения не менее 1 года</div>
                    <div class="term-item"><span>5</span> Залог*</div>
                </div>

                <div class="terms-image">
                    <img src="{{ asset('images/car-top.png') }}" alt="Вид сверху на автомобиль">
                </div>

                <div class="terms-info">
                    <p>В стоимость суток аренды включено <strong>300 км пробега</strong>, каждые последующие 100 км
                        — <strong>10 бел. рублей</strong>.</p>
                    <p><strong>Мойка автомобиля в стоимость аренды не включена!</strong></p>
                    <p class="note">
                        *Необходим залог, который возвращается при возврате авто в прежнем состоянии (топливо,
                        чистота, техническое состояние).<br>
                        <strong>Для граждан РБ:</strong> 300 бел. рублей<br>
                        <strong>Для иностранных граждан:</strong> 600 бел. рублей
                    </p>
                </div>
            </div>

            <div class="rental-button-wrap">
                <button class="reserve-btn">Оставить заявку</button>
            </div>
        </div>
    </section>

    <section class="faq-section" id="faq">
        <div class="faq-container">
            <h2 class="section-title">Часто задаваемые вопросы</h2>

            <div class="faq-items">
                <div class="faq-item">
                    <div class="faq-header">
                        <span class="faq-toggle-icon">+</span>
                        <p class="faq-question">Как я могу забронировать автомобиль?</p>
                    </div>
                    <div class="faq-answer">
                        <p>Для бронирования автомобиля выберите нужный автомобиль на нашем сайте, заполните форму и
                            оставьте заявку. Мы свяжемся с вами для подтверждения бронирования.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <span class="faq-toggle-icon">+</span>
                        <p class="faq-question">Какие документы необходимы для аренды?</p>
                    </div>
                    <div class="faq-answer">
                        <p>Для аренды автомобиля вам нужно предоставить паспорт, водительское удостоверение, а также
                            оплатить аренду и залог, если требуется.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <span class="faq-toggle-icon">+</span>
                        <p class="faq-question">Есть ли ограничение по возрасту для арендаторов?</p>
                    </div>
                    <div class="faq-answer">
                        <p>Да, для аренды автомобиля необходимо быть старше 21 года и иметь стаж вождения не менее 1
                            года.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header">
                        <span class="faq-toggle-icon">+</span>
                        <p class="faq-question">Как я могу вернуть автомобиль?</p>
                    </div>
                    <div class="faq-answer">
                        <p>Вы можете вернуть автомобиль в пункт проката в течение согласованного срока. Важно
                            вернуть автомобиль в хорошем состоянии, с полным баком и без повреждений.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
