<?php

namespace App\Http\Controllers;

use App\Enums\BookPayment;
use App\Models\Booking;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @param Request $request
     * @return View|RedirectResponse
     * @throws Exception
     */
    public function show(Request $request): View|RedirectResponse
    {
        if (! $request->query('booking_id')) {
            throw new Exception('Ошибка создания оплаты для заказа!');
        }

        $booking = Booking::query()->with(['product.settings', 'user'])->findOrFail($request->query('booking_id'));

        if ($booking->user->id !== auth()->id()) {
            return view('index');
        }

        if ($booking->payment_status === BookPayment::PAID->value) {
            return redirect('/')->with('info', 'Бронирование уже оплачено.');
        }

        return view('payment.show', compact('booking'));
    }

    /**
     * @param Request $request
     * @return View
     * @throws Exception
     */
    public function confirm(Request $request): View
    {
        $bookingId = $request->input('booking_id');

        if (! $request->query('booking_id')) {
            throw new Exception('Ошибка создания оплаты для заказа!');
        }

        $booking = Booking::query()->with('user')->findOrFail($bookingId);

        if ($booking->user->id !== auth()->id()) {
            return view('index');
        }

        $booking->update(['payment_status' => BookPayment::PAID->value]);

        return view('payment.success', compact('booking'));
    }
}
