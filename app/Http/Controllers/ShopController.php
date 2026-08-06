<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        if ($request->query('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->query('category')));
        }

        if ($request->query('brand')) {
            $query->where('brand', $request->query('brand'));
        }

        $sort = $request->query('sort', 'newest');
        $query->when($sort === 'price_asc', fn($q) => $q->orderBy('price'))
            ->when($sort === 'price_desc', fn($q) => $q->orderByDesc('price'))
            ->when($sort === 'name', fn($q) => $q->orderBy('name'))
            ->when($sort === 'newest', fn($q) => $q->orderByDesc('created_at'));

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->where('is_active', true)->orderBy('name')->get();
        $brands = Product::where('is_active', true)->distinct()->pluck('brand')->filter()->values();

        return view('pages.shop', compact('products', 'categories', 'brands'));
    }

    public function categories()
    {
        $categories = Category::withCount('products')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn($c) => $c->products_count > 0);

        return view('pages.categories', compact('categories'));
    }
}