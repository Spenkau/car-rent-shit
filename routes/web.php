<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::prefix('products')->name('products.')->group(function ()  {
    Route::get('/suggestions', [ProductController::class, 'suggestions'])->name('suggestions');
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

Route::resource('booking', BookingController::class);
Route::patch('/bookings/{booking}/rate', [BookingController::class, 'rate'])->name('booking.rate');

Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');


Route::view('terms', 'terms')->name('terms.index');

Route::view('privacy', 'privacy')->name('privacy.index');

Route::prefix('contacts')->name('contacts.')->group(function ()  {
    Route::view('', 'contacts')->name('index');
    Route::post('', [ContactController::class, 'store'])->name('store');
});

Route::get('login', [ProfileController::class, 'showLoginForm'])->name('login');
Route::get('register', [ProfileController::class, 'showRegisterForm'])->name('register');

Route::name('profile.')->group(function ()  {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('', [ProfileController::class, 'update'])->name('update');
    Route::post('login', [ProfileController::class, 'login'])->name('login');
    Route::post('register', [ProfileController::class, 'register'])->name('register');
    Route::post('logout', [ProfileController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'index'])->middleware('auth')->name('index');
});

Route::get('/lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');
