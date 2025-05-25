<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(Request $request)
    {
        $query = Product::with('settings');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $query->whereHas('settings', function ($q) use ($request) {
            foreach ([
                 'release_year', 'gearbox_type', 'engine_volume', 'engine_type', 'drive_type',
                 'power', 'doors_count', 'seats_count', 'color', 'price'
             ] as $field) {
                if ($request->filled($field)) {
                    $q->where($field, $request->$field);
                }
            }
        });

        $products = $query->paginate(9)->withQueryString();

        return view('product.index', compact('products'));
    }

    /**
     * @param $slug
     * @return View
     */
    public function show($slug): View
    {
        $product = Product::with(['settings', 'comments' => fn ($query) => $query->approved()])->where('slug', '=', $slug)->firstOrFail();
        return view('product.show', compact('product'));
    }
}
