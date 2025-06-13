<?php

namespace App\Http\Controllers;

use App\Enums\BookStatus;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(Request $request)
    {
        $query = Product::with(['settings', 'images']);

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
        $products = Product::all();
        $product = Product::with([
            'settings',
            'images',
            'bookings' => fn ($query) => $query->with('comments')->where('status', '=', BookStatus::FINISHED->value)
        ])->where('slug', '=', $slug)->firstOrFail();

        return view('product.show', [
            'products' => $products,
            'product' => $product,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function suggestions(Request $request): JsonResponse
    {
        $query = $request->get('query', '');

        if (trim($query) === '') {
            return response()->json();
        }

        $matches = Product::query()->where('name', 'LIKE', "%{$query}%")
            ->orderBy('name')
            ->limit(10)
            ->pluck('name');

        return response()->json($matches);
    }
}
