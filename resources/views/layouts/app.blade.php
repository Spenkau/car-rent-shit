<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аренда автомобилей в Гродно</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white antialiased flex flex-col min-h-screen">
<div class="flex flex-col min-h-screen">
    <header class="site-header bg-gray-900/80 border-b border-white/5 sticky top-0 z-50 py-5">
        <nav class="navbar max-w-7xl mx-auto px-4 flex items-center justify-between">
            <a href="/" class="logo">
                <svg width="200" height="60" viewBox="0 0 200 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-12">
                    <path d="M30 45H20C18.8954 45 18 44.1046 18 43V35H32V43C32 44.1046 31.1046 45 30 45Z" fill="#06B6D4"/>
                    <path d="M50 45H40C38.8954 45 38 44.1046 38 43V35H52V43C52 44.1046 51.1046 45 50 45Z" fill="#06B6D4"/>
                    <path d="M48 35H22C20.8954 35 20 34.1046 20 33V25C20 23.8954 20.8954 23 22 23H48C49.1046 23 50 23.8954 50 25V33C50 34.1046 49.1046 35 48 35Z" fill="white"/>
                    <circle cx="25" cy="45" r="5" fill="white"/>
                    <circle cx="45" cy="45" r="5" fill="white"/>
                    <text x="60" y="40" font-family="Nunito, sans-serif" font-size="28" font-weight="900" fill="white">Car</text>
                    <text x="100" y="40" font-family="Nunito, sans-serif" font-size="28" font-weight="900" fill="#06B6D4">Grodno</text>
                </svg>
            </a>
            <nav class="main-nav">
                <ul class="flex list-none gap-7">
                    <li><a href="{{ route('site.index') }}" class="{{ request()->routeIs('site.index') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Главная</a></li>
                    <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('product.index') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Наш автопарк</a></li>
                    <li><a href="{{ route('terms.index') }}" class="{{ request()->routeIs('terms.index') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Условия</a></li>
                    <li><a href="{{ route('contacts.index') }}" class="{{ request()->routeIs('contacts.index') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Контакты</a></li>
                    @auth
                        <li><a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Профиль</a></li>
                        <li>
                            <form action="{{ route('profile.logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-white font-medium relative hover:text-cyan-500 transition-colors">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('profile.login') }}" class="{{ request()->routeIs('login') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Вход</a></li>
                        <li><a href="{{ route('profile.register') }}" class="{{ request()->routeIs('register') ? 'text-cyan-500' : 'text-white' }} font-medium relative hover:text-cyan-500 transition-colors">Регистрация</a></li>
                    @endauth
                </ul>
            </nav>
        </nav>
    </header>

    <main class="flex-grow">
        @yield('main')
    </main>
</div>

<footer class="site-footer bg-gray-900 py-16" id="contacts">
    <div class="footer-container max-w-7xl mx-auto text-center px-4 flex justify-between  gap-10">
        <div class="footer-about w-full md:w-1/3 min-w-[250px]">
            <h3 class="text-2xl font-semibold text-orange-500 mb-5">Компания</h3>
            <p class="text-white leading-relaxed">Мы предоставляем качественные услуги аренды автомобилей по доступным ценам. Быстро, удобно и надежно.</p>
        </div>
        <div class="footer-links w-full md:w-1/3 min-w-[250px]">
            <h3 class="text-2xl font-semibold text-orange-500 mb-5">Навигация</h3>
            <ul class="list-none p-0 m-0 text-white">
                <li class="mb-3"><a href="{{ route('site.index') }}" class="text-white hover:text-cyan-500 transition-colors">Главная</a></li>
                <li class="mb-3"><a href="{{ route('site.index') . '#faq' }}" class="text-white hover:text-cyan-500 transition-colors">Вопросы</a></li>
                <li class="mb-3"><a href="{{ route('contacts.index') }} class="text-white hover:text-cyan-500 transition-colors">Контакты</a></li>
                <li class="mb-3"><a href="{{ route('terms.index') }}" class="text-white hover:text-cyan-500 transition-colors">Условия аренды</a></li>
            </ul>
        </div>
        <div class="footer-contacts w-full md:w-1/3 min-w-[250px]">
            <h3 class="text-2xl font-semibold text-orange-500 mb-5">Контакты</h3>
            <p class="text-white mb-2">+375 (29) 123-45-67</p>
            <p class="text-white mb-2">info@company.by</p>
            <p class="text-white mb-4">Гродно, Беларусь</p>
            <div class="footer-social flex justify-center gap-3">
                <a href="https://t.me/vlnebelenchuk"><img src="{{ asset('images/icons/telegram.png') }}" alt="Telegram" class="w-6 h-6 hover:scale-110 transition-transform"></a>
                <a href="https://www.instagram.com/ssadovsskaya/"><img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram" class="w-6 h-6 hover:scale-110 transition-transform"></a>
                <a href="viber://add?number=+375256756976"><img src="{{ asset('images/icons/viber.png') }}" alt="Viber" class="w-6 h-6 hover:scale-110 transition-transform"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center mt-10 text-white text-sm">
        <p>© 2025 Все права защищены. ООО «АвтоПрокат»</p>
    </div>
</footer>

@stack('scripts')
<script>
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('open');
            const answer = item.querySelector('.faq-answer');
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
</body>
</html>
