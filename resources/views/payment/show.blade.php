<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@lang('views.payment.title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">
<div class="max-w-md mx-auto p-6 mt-12 border rounded shadow">
    <h1 class="text-2xl font-bold mb-4">@lang('views.payment.title')</h1>
    <div class="space-y-2 mb-2">
        <p><span class="font-semibold">@lang('views.payment.product', ['name' => $booking->product->name])</span></p>
        <p><span class="font-semibold">@lang('views.payment.dates', ['start_date' => $booking->start_date, 'end_date' => $booking->end_date])</span></p>
        <p><span class="font-semibold">@lang('views.payment.price_per_day', ['price' => $booking->product->settings->price])</span></p>
        <p>
            <span class="font-semibold">@lang('views.payment.total', ['total' => \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date) * $booking->product->settings->price])</span>
        </p>
    </div>

    <small>@lang('views.payment.confirmation', ['phone' => $booking->phone])</small>

    <form method="POST" action="{{ route('payment.confirm') . '?' . http_build_query(['booking_id' => $booking->id]) }}" class="mt-6">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded font-semibold transition">
            @lang('views.payment.pay_button')
        </button>
    </form>
</div>
</body>
</html>
