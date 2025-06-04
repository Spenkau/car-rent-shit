<?php

namespace App\Http\Controllers;

use App\Enums\BookStatus;
use App\Models\Booking;
use Illuminate\Http\Request;

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
                    "before_or_equal:{$nextYear}-12 detriment31"
                ],
                'end_date' => [
                    'required',
                    'date',
                    'after_or_equal:start_date',
                    "after_or_equal:{$currentYear}-01-01",
                    "before_or_equal:{$nextYear}-12-31"
                ],
                'full_name' => ['required', 'string'],
                'phone' => ['nullable', 'string']
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
                'end_date.after_or_equal' => trans('views.booking.errors.end_date.after_or_equal', ['currentYear' => $currentYear, 'nextYear' => $nextYear]),
                'end_date.before_or_equal' => trans('views.booking.errors.end_date.before_or_equal', ['nextYear' => $nextYear]),
                'full_name.required' => trans('views.booking.errors.full_name.required'),
                'full_name.string' => trans('views.booking.errors.full_name.string'),
                'phone.string' => trans('views.booking.errors.phone.string'),
            ]);

            $user = auth()->user();

            if (empty($data['phone']) && empty($user->phone)) {
                return response()->json(['errors' => ['phone' => [trans('views.booking.errors.phone.required')]]], 422);
            }

            $booking = Booking::query()->create([
                'user_id' => $user->id,
                'product_id' => $data['product_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'phone' => $data['phone'] ?: $user->phone
            ]);

            return response()->json(['success' => true, 'booking_id' => $booking->id]);
        } catch (\Illuminate\Validation\ValidationException $e) {
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
}
