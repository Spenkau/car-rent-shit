<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        if (in_array($locale, ['ru', 'en'])) {
            session()->put('locale', $locale);
        }
        return redirect('/'); // вернёт на главную страницу напрямую
    }

}

