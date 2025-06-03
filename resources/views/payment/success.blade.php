<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@lang('views.payment.success_title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">
<div class="max-w-md mx-auto p-6 mt-12 border rounded shadow text-center">
    <h1 class="text-2xl font-bold text-green-600">@lang('views.payment.success_title')</h1>
    <p class="mt-4 text-gray-700">@lang('views.payment.success_message')</p>

    <a href="{{ route('site.index') }}"
       class="inline-block mt-6 text-blue-600 hover:underline font-medium">
        @lang('views.payment.return_home')
    </a>
</div>
</body>
</html>
