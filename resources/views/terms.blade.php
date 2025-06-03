@extends('layouts.app')

@section('main')
    <section class="terms bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">@lang('views.terms.title')</h1>

            <div class="intro mb-12 text-center">
                <p class="text-gray-300 text-lg leading-relaxed max-w-3xl mx-auto">
                    @lang('views.terms.intro')
                </p>
            </div>

            <div class="conditions grid grid-cols-1 gap-8">
                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.terms.driver_requirements.title')</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>@lang('views.terms.driver_requirements.age')</li>
                        <li>@lang('views.terms.driver_requirements.experience')</li>
                        <li>@lang('views.terms.driver_requirements.documents')</li>
                        <li>@lang('views.terms.driver_requirements.foreign_citizens')</li>
                    </ul>
                </div>

                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.terms.rental_process.title')</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>@lang('views.terms.rental_process.select_car')</li>
                        <li>@lang('views.terms.rental_process.sign_contract')</li>
                        <li>@lang('views.terms.rental_process.payment_deposit')</li>
                        <li>@lang('views.terms.rental_process.receive_car')</li>
                    </ul>
                </div>

                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.terms.financial_conditions.title')</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>@lang('views.terms.financial_conditions.rental_cost', ['cost' => number_format(80, 2, ',', ' ')])</li>
                        <li>@lang('views.terms.financial_conditions.deposit', ['deposit' => 200])</li>
                        <li>@lang('views.terms.financial_conditions.payment_methods')</li>
                        <li>@lang('views.terms.financial_conditions.additional_services', ['cost' => 5])</li>
                    </ul>
                </div>

                <div class="condition bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.terms.usage_rules.title')</h2>
                    <ul class="list-disc pl-6 text-gray-300 text-base leading-relaxed">
                        <li>@lang('views.terms.usage_rules.territory')</li>
                        <li>@lang('views.terms.usage_rules.no_smoking')</li>
                        <li>@lang('views.terms.usage_rules.fuel_level')</li>
                        <li>@lang('views.terms.usage_rules.traffic_rules')</li>
                    </ul>
                </div>
            </div>

            <div class="accordion mt-12">
                <h2 class="text-2xl font-semibold text-orange-500 mb-6 text-center">@lang('views.terms.faq.title')</h2>
                <div class="faq-item bg-gray-800 rounded-2xl p-6 mb-4 cursor-pointer shadow-lg hover:bg-gray-700 transition-all">
                    <div class="faq-question flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">@lang('views.terms.faq.accident.question')</h3>
                        <span class="text-cyan-500 text-xl">+</span>
                    </div>
                    <div class="faq-answer text-gray-300 mt-4 hidden">
                        <p>@lang('views.terms.faq.accident.answer', ['phone' => '+375 (29) 123-45-67'])</p>
                    </div>
                </div>
                <div class="faq-item bg-gray-800 rounded-2xl p-6 mb-4 cursor-pointer shadow-lg hover:bg-gray-700 transition-all">
                    <div class="faq-question flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">@lang('views.terms.faq.international_travel.question')</h3>
                        <span class="text-cyan-500 text-xl">+</span>
                    </div>
                    <div class="faq-answer text-gray-300 mt-4 hidden">
                        <p>@lang('views.terms.faq.international_travel.answer')</p>
                    </div>
                </div>
                <div class="faq-item bg-gray-800 rounded-2xl p-6 mb-4 cursor-pointer shadow-lg hover:bg-gray-700 transition-all">
                    <div class="faq-question flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-white">@lang('views.terms.faq.insurance.question')</h3>
                        <span class="text-cyan-500 text-xl">+</span>
                    </div>
                    <div class="faq-answer text-gray-300 mt-4 hidden">
                        <p>@lang('views.terms.faq.insurance.answer')</p>
                    </div>
                </div>
            </div>

            <div class="cta text-center mt-12">
                <p class="text-gray-300 text-lg mb-6">@lang('views.terms.cta.text')</p>
                <a href="{{ route('contacts.index') }}" class="bg-cyan-500 text-white text-lg px-8 py-4 rounded-full inline-block hover:bg-cyan-600 hover:scale-105 transition-all shadow-lg">@lang('views.terms.cta.button')</a>
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
