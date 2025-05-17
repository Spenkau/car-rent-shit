<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аренда автомобилей в Гродно</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header dark">
        <div class="navbar">
            <a href="/" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="CarGrodno Logo">
            </a>
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('site.index') }}" class="{{ request()->routeIs('site.index') ? 'active' : '' }}">Главная</a></li>
                    <li><a href="{{ route('product.index') }}" class="{{ request()->routeIs('product.index') ? 'active' : '' }}">Наш автопарк</a></li>
                    <li><a href="{{ route('terms.index') }}" class="{{ request()->routeIs('terms.index') ? 'active' : '' }}">Условия</a></li>
                    <li><a href="{{ route('contacts.index') }}" class="{{ request()->routeIs('contacts.index') ? 'active' : '' }}">Контакты</a></li>
                    <li><a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">Профиль</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('main')
    </main>

    <footer class="site-footer" id="contacts">
        <div class="footer-container">
            <div class="footer-about">
                <h3>Компания</h3>
                <p>Мы предоставляем качественные услуги аренды автомобилей по доступным ценам. Быстро, удобно и
                    надежно.</p>
            </div>

            <div class="footer-links">
                <h3>Навигация</h3>
                <ul>
                    <li><a href="{{ route('site.index') }}">Главная</a></li>
                    <li><a href="#faq">Вопросы</a></li>
                    <li><a href="#contacts">Контакты</a></li>
                    <li><a href="#terms">Условия аренды</a></li>
                </ul>
            </div>

            <div class="footer-contacts">
                <h3>Контакты</h3>
                <p>+375 (29) 123-45-67</p>
                <p>info@company.by</p>
                <p>Гродно, Беларусь</p>

                <div class="footer-social">
                    <a href="https://t.me/vlnebelenchuk"><img src="{{ asset('images/icons/telegram.png') }}"
                                                              alt="Telegram"/></a>
                    <a href="https://www.instagram.com/ssadovsskaya/"><img
                            src="{{ asset('images/icons/instagram.png') }}" alt="Instagram"/></a>
                    <a href="viber://add?number=+375256756976"><img src="{{ asset('images/icons/viber.png') }}"
                                                                    alt="Viber"/></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Все права защищены. ООО «АвтоПрокат»</p>
        </div>
    </footer>
</body>
</html>
