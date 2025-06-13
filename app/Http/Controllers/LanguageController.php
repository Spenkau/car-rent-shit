<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * @param string $locale
     * @return RedirectResponse
     */
    public function switchLang(string $locale): RedirectResponse
    {
        if (in_array($locale, ['ru', 'en'])) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}

