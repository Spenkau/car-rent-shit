<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Успешная оплата</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">
<div class="max-w-md mx-auto p-6 mt-12 border rounded shadow text-center">
    <h1 class="text-2xl font-bold text-green-600">Оплата прошла успешно!</h1>
    <p class="mt-4 text-gray-700">Спасибо за бронирование. Мы с вами свяжемся в ближайшее время.</p>

    <a href="{{ route('site.index') }}"
       class="inline-block mt-6 text-blue-600 hover:underline font-medium">
        Вернуться на главную
    </a>
</div>
</body>
</html>
