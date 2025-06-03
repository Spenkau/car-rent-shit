<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('index', ['products' => Product::query()
            ->with('settings')
            ->orderBy('popularity')
            ->get()
        ]);
    }
}
