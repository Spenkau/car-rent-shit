<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return Factory|View|Application|\Illuminate\View\View|object
     */
    public function index()
    {
        $products = Product::with('settings')->paginate(9);
        return view('product.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['settings', 'comments' => fn ($query) => $query->approved()])->where('slug', '=', $slug)->firstOrFail();
        return view('product.show', compact('product'));
    }
}
