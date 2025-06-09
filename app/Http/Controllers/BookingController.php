<?php

namespace App\Http\Controllers;

use App\Enums\BookStatus;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $currentYear = now()->year; // 2025
        $nextYear = $currentYear + 1; // 2026

        try {
            $data = $request->validate([
                'product_id' => ['required', 'integer', 'exists:products,id'],
                'start_date' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                    "after_or_equal:{$currentYear}-01-01",
                    "before_or_equal:{$nextYear}-12-30"
                ],
                'end_date' => [
                    'required',
                    'date',
                    'after:start_date',
                    "after_or_equal:{$currentYear}-01-01",
                    "before_or_equal:{$nextYear}-12-31"
                ],
                'full_name' => ['required', 'string'],
                'phone' => ['nullable', 'string'],
                'request_token' => ['nullable', 'string', 'unique:bookings,request_token']
            ], [
                'product_id.required' => trans('views.booking.errors.product_id.required'),
                'product_id.integer' => trans('views.booking.errors.product_id.integer'),
                'product_id.exists' => trans('views.booking.errors.product_id.exists'),
                'start_date.required' => trans('views.booking.errors.start_date.required'),
                'start_date.date' => trans('views.booking.errors.start_date.date'),
                'start_date.after_or_equal' => trans('views.booking.errors.start_date.after_or_equal', ['currentYear' => $currentYear, 'nextYear' => $nextYear]),
                'start_date.before_or_equal' => trans('views.booking.errors.start_date.before_or_equal', ['nextYear' => $nextYear]),
                'end_date.required' => trans('views.booking.errors.end_date.required'),
                'end_date.date' => trans('views.booking.errors.end_date.date'),
                'end_date.after' => trans('views.booking.errors.end_date.after'),
                'end_date.before_or_equal' => trans('views.booking.errors.end_date.before_or_equal', ['nextYear' => $nextYear]),
                'full_name.required' => trans('views.booking.errors.full_name.required'),
                'full_name.string' => trans('views.booking.errors.full_name.string'),
                'phone.string' => trans('views.booking.errors.phone.string'),
                'request_token.unique' => trans('views.booking.errors.request_token.unique'),
            ]);

            $user = auth()->user();

            if (empty($data['phone']) && empty($user->phone)) {
                return response()->json(['errors' => ['phone' => [trans('views.booking.errors.phone.required')]]], 422);
            }

            // Приведение дат к началу дня
            $startDate = \Carbon\Carbon::parse($data['start_date'])->startOfDay();
            $endDate = \Carbon\Carbon::parse($data['end_date'])->startOfDay();

            // Проверка на пересечение дат
            $overlappingBooking = Booking::where('product_id', $data['product_id'])
                ->where('user_id', $user->id)
                ->where('id', '!=', $request->input('booking_id', 0))
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                })
                ->first();

            // Логирование
            Log::info('Booking store attempt', [
                'user_id' => $user->id,
                'product_id' => $data['product_id'],
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'overlapping_booking' => $overlappingBooking ? [
                    'id' => $overlappingBooking->id,
                    'start_date' => $overlappingBooking->start_date ? $overlappingBooking->start_date->toDateString() : null,
                    'end_date' => $overlappingBooking->end_date ? $overlappingBooking->end_date->toDateString() : null,
                ] : null,
                'request_data' => $request->all(),
                'server_timezone' => config('app.timezone'),
                'current_date' => now()->toDateString()
            ]);

            if ($overlappingBooking) {
                return response()->json([
                    'errors' => [
                        'dates' => [trans('views.booking.errors.dates.overlap', [
                            'existing_start' => $overlappingBooking->start_date->toDateString(),
                            'existing_end' => $overlappingBooking->end_date->toDateString()
                        ])]
                    ]
                ], 422);
            }

            $booking = Booking::query()->create([
                'user_id' => $user->id,
                'product_id' => $data['product_id'],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'phone' => $data['phone'] ?: $user->phone,
                'request_token' => $data['request_token'] ?? uniqid()
            ]);

            return response()->json(['success' => trans('views.booking.success.booked'), 'booking_id' => $booking->id]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Booking store validation failed', ['errors' => $e->errors(), 'request' => $request->all()]);
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function rate(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'rating' => ['required', 'numeric', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ], [
            'rating.required' => trans('views.booking.errors.rating.required'),
            'rating.numeric' => trans('views.booking.errors.rating.numeric'),
            'rating.between' => trans('views.booking.errors.rating.between'),
            'comment.required' => trans('views.booking.errors.comment.required'),
            'comment.string' => trans('views.booking.errors.comment.string'),
            'comment.max' => trans('views.booking.errors.comment.max'),
        ]);

        if ($booking->status !== BookStatus::FINISHED->value) {
            return response()->json(['error' => trans('views.booking.errors.booking.not_finished')], 403);
        }

        if ($booking->rating) {
            return response()->json(['error' => trans('views.booking.errors.booking.already_rated')], 403);
        }

        $booking->update(['rating' => $data['rating']]);
        $booking->comments()->create([
            'user_id' => auth()->id(),
            'body' => $data['comment'],
        ]);

        return response()->json(['success' => trans('views.booking.success.rating')]);
    }

    public function cancelBooking(Request $request, int $bookingId): \Illuminate\Http\RedirectResponse
    {
        $booking = Booking::query()->where('id', $bookingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($booking->status !== BookStatus::WAIT_FOR_APPROVE->value) {
            return redirect()->route('profile.index')->with('error', 'Бронь можно отменить только в статусе "Ожидание подтверждения".');
        }

        $booking->delete();

        return redirect()->route('profile.index')->with('success', 'Бронь успешно отменена.');
    }
}
