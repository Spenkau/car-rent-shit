<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::resource('profile', ProfileController                                                                                                                            ::class);

Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::view('terms', 'terms')->name('terms.index');

Route::view('privacy', 'privacy')->name('privacy.index');
Route::view('contacts', 'contacts')->name('contacts.index');
