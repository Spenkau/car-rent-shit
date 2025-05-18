@extends('layouts.app')

@section('main')
    <section class="terms bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">Условия аренды</h1>

            <div class="intro mb-12 text-center">
                <p class="text-gray-300 text-lg leading-relaxed max-w-3xl mx-auto">
                    Мы стремимся сделать процесс аренды автомобиля простым и прозрачным. Ознакомьтесь с нашими условиями, чтобы быть уверенными в вашем выборе.
                </p>
            </div>

            <div class="conditions grid grid-cols-1 gap-8">
                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Требования к водителю</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>Возраст: от 21 года.</li>
                        <li>Водительский стаж: не менее 2 лет.</li>
                        <li>Документы: паспорт, водительское удостоверение (действительное в Республике Беларусь).</li>
                        <li>Для иностранных граждан: миграционная карта или виза, если требуется.</li>
                    </ul>
                </div>

                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Процесс аренды</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>Выберите автомобиль на нашем сайте и забронируйте его онлайн или по телефону.</li>
                        <li>Подпишите договор аренды в нашем офисе в Гродно.</li>
                        <li>Внесите оплату и залог (возвращается при возврате автомобиля).</li>
                        <li>Получите автомобиль в чистом виде с полным баком топлива.</li>
                    </ul>
                </div>

                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Финансовые условия</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>Стоимость аренды: от {{ number_format(80, 2, ',', ' ') }} BYN/сутки (зависит от модели).</li>
                        <li>Залог: от 200 BYN (возвращается при отсутствии повреждений).</li>
                        <li>Оплата: наличными, банковской картой или переводом.</li>
                        <li>Дополнительные услуги (GPS, детское кресло): от 5 BYN/сутки.</li>
                    </ul>
                </div>

                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Правила эксплуатации</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>Автомобиль должен использоваться только на территории Республики Беларусь.</li>
                        <li>Запрещено курение в салоне.</li>
                        <li>Возврат автомобиля с тем же уровнем топлива, что при получении.</li>
                        <li>Соблюдайте ПДД и условия договора.</li>
                    </ul>
                </div>
            </div>

            <div class="accordion mt-12">
                <h2 class="text-2xl font-semibold text-orange-500 mb-6 text-center">Часто задаваемые вопросы</h2>
                <div class="faq-item bg-gray-800 rounded-2xl p-6 mb-4 cursor-pointer shadow-lg hover:bg-gray-700 transition-all">
                    <div class="faq-question flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">Что делать в случае ДТП?</h3>
                        <span class="text-cyan-500 text-xl">+</span>
                    </div>
                    <div class="faq-answer text-gray-300 mt-4 hidden">
                        <p>Немедленно сообщите нам по телефону +375 (29) 123-45-67. Вызовите ГАИ, зафиксируйте обстоятельства. Мы поможем с оформлением страхового случая.</p>
                    </div>
                </div>
                <div class="faq-item bg-gray-800 rounded-2xl p-6 mb-4 cursor-pointer shadow-lg hover:bg-gray-700 transition-all">
                    <div class="faq-question flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">Можно ли выезжать за границу?</h3>
                        <span class="text-cyan-500 text-xl">+</span>
                    </div>
                    <div class="faq-answer text-gray-300 mt-4 hidden">
                        <p>Выезд за пределы Беларуси возможен только по предварительному согласованию и с оформлением дополнительной страховки.</p>
                    </div>
                </div>
                <div class="faq-item bg-gray-800 rounded-2xl p-6 mb-4 cursor-pointer shadow-lg hover:bg-gray-700 transition-all">
                    <div class="faq-question flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">Что входит в страховку?</h3>
                        <span class="text-cyan-500 text-xl">+</span>
                    </div>
                    <div class="faq-answer text-gray-300 mt-4 hidden">
                        <p>Базовая страховка покрывает ущерб от ДТП и кражи. Дополнительная страховка (КАСКО) доступна за отдельную плату.</p>
                    </div>
                </div>
            </div>

            <div class="cta text-center mt-12">
                <p class="text-gray-300 text-lg mb-6">Остались вопросы? Свяжитесь с нами!</p>
                <a href="{{ route('contacts.index') }}" class="bg-cyan-500 text-white text-lg px-8 py-4 rounded-full inline-block hover:bg-cyan-600 hover:scale-105 transition-all shadow-lg">Связаться с нами</a>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('open');
                const answer = item.querySelector('.faq-answer');
                const toggle = item.querySelector('.faq-question span');
                answer.classList.toggle('hidden');
                toggle.textContent = answer.classList.contains('hidden') ? '+' : '−';
            });
        });
    </script>
@endsection
