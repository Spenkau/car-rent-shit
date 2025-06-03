@extends('layouts.app')

@section('main')
    <section class="contacts bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold uppercase text-center text-white mb-10">@lang('views.contacts.title')</h1>

            <!-- Introduction -->
            <div class="intro mb-12 text-center">
                <p class="text-gray-300 text-lg leading-relaxed max-w-3xl mx-auto">
                    @lang('views.contacts.intro')
                </p>
            </div>

            <!-- Contact Info and Form -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Info -->
                <div class="contact-info bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-orange-500 mb-4">@lang('views.contacts.title')</h2>
                    <ul class="list-none p-0 text-gray-300 text-base leading-relaxed">
                        <li class="mb-4 flex items-center">
                            <svg class="w-6 h-6 text-cyan-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:+375291234567" class="hover:text-cyan-500 transition-colors">@lang('views.contacts.phone')</a>
                        </li>
                        <li class="mb-4 flex items-center">
                            <svg class="w-6 h-6 text-cyan-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:info@company.by" class="hover:text-cyan-500 transition-colors">@lang('views.contacts.email')</a>
                        </li>
                        <li class="mb-4 flex items-center">
                            <svg class="w-6 h-6 text-cyan-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>@lang('views.contacts.address')</span>
                        </li>
                    </ul>
                    <div class="social-links mt-6">
                        <h3 class="text-lg font-semibold text-orange-500 mb-3">@lang('views.contacts.social_links')</h3>
                        <div class="flex gap-4">
                            <a href="https://t.me/vlnebelenchuk"><img src="{{ asset('images/icons/telegram.png') }}" alt="Telegram" class="w-8 h-8 hover:scale-110 transition-transform"></a>
                            <a href="https://www.instagram.com/ssadovsskaya/"><img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram" class="w-8 h-8 hover:scale-110 transition-transform"></a>
                            <a href="viber://add?number=+375256756976"><img src="{{ asset('images/icons/viber.png') }}" alt="Viber" class="w-8 h-8 hover:scale-110 transition-transform"></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="map mt-12">
                <h2 class="text-2xl font-semibold text-orange-500 mb-4 text-center">@lang('views.contacts.where_to_find_us')</h2>
                <iframe
                    class="w-full h-[400px] rounded-2xl shadow-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2394.818693614609!2d23.8258193157991!3d53.68834598005364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dfd9e7e6f7f3b1%3A0x2e8b7e9c6f7e9d3a!2z0YPQuy4g0KHQvtCy0LXRgNC90YvQuSDQldC90L7Qs9C-0LTQutC-0LkgMTAsINCV0YHQv9C10YMsINCR0LXQu9Cw0YDRg9C0!5e0!3m2!1sru!2sby!4v1697644321987!5m2!1sru!2sby"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('contact-form')?.addEventListener('submit', function (e) {
            const name = document.getElementById('name')?.value.trim();
            const email = document.getElementById('email')?.value.trim();
            const message = document.getElementById('message')?.value.trim();

            if (!name || !email || !message) {
                e.preventDefault();
                alert('@lang("views.contacts.form.validation.fill_all_fields")');
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                e.preventDefault();
                alert('@lang("views.contacts.form.validation.invalid_email")');
            }
        });
    </script>
@endsection
