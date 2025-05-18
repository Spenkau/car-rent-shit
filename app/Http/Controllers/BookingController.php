<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'full_name' => ['required', 'string'],
            'phone' => ['nullable', 'string']
        ]);

        $user = auth()->user();

        if (empty($data['phone']) && empty($user->phone)) {
            return back()->withErrors(['phone' => 'Необходим ваш номер телефона!']);
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'product_id' => $data['product_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'phone' => $data['phone'] ?: $user->phone
        ]);

        return redirect()->to('/payment?booking_id=' . $booking->id);
    }

    public function rate(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $booking->update(['rating' => $data['rating']]);
        $booking->product()->first()->comments()->create([
            'user_id' => auth()->id(),
            'body' => $data['comment']
        ]);

        return back()->with('success', 'Спасибо за вашу оценку!');
    }
}
