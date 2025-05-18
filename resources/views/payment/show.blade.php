<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оплата</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">
<div class="max-w-md mx-auto p-6 mt-12 border rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Оплата бронирования</h1>
    <div class="space-y-2 mb-2">
        <p><span class="font-semibold">Товар:</span> {{ $booking->product->name }}</p>
        <p><span class="font-semibold">Даты:</span> {{ $booking->start_date }} — {{ $booking->end_date }}</p>
        <p><span class="font-semibold">Цена:</span> {{ $booking->product->settings->price }} BYN / сутки</p>
        <p>
            <span class="font-semibold">Итого:</span>
            {{ \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date) *  $booking->product->settings->price  }} BYN
        </p>
    </div>

    <small>После оплаты заказа мы вам позвоним на номер телефона {{ $booking->phone }}</small>

    <form method="POST" action="{{ route('payment.confirm') . '?' . http_build_query(['booking_id' => $booking->id]) }}" class="mt-6">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded font-semibold transition">
            Оплатить
        </button>
    </form>
</div>
</body>
</html>
