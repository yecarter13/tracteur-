<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $static = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily', 'lastmod' => now()->toDateString()],
            ['loc' => route('shop'), 'priority' => '0.9', 'changefreq' => 'daily', 'lastmod' => now()->toDateString()],
            ['loc' => route('categories.all'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => now()->toDateString()],
            ['loc' => route('about'), 'priority' => '0.6', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['loc' => route('contact'), 'priority' => '0.6', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['loc' => route('delivery'), 'priority' => '0.4', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['loc' => route('returns'), 'priority' => '0.4', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['loc' => route('terms'), 'priority' => '0.3', 'changefreq' => 'yearly', 'lastmod' => now()->toDateString()],
            ['loc' => route('warranty'), 'priority' => '0.4', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['loc' => route('privacy'), 'priority' => '0.3', 'changefreq' => 'yearly', 'lastmod' => now()->toDateString()],
        ];

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $products = Product::where('is_active', true)
            ->orderByDesc('updated_at')
            ->get();

        return response()->view('sitemap', compact('static', 'categories', 'products'))
            ->header('Content-Type', 'application/xml');
    }
}
