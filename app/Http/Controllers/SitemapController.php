<?php

namespace App\Http\Controllers;

use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $static = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('shop'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('categories.all'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('about'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('contact'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('delivery'), 'priority' => '0.4', 'changefreq' => 'monthly'],
            ['loc' => route('returns'), 'priority' => '0.4', 'changefreq' => 'monthly'],
            ['loc' => route('terms'), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => route('warranty'), 'priority' => '0.4', 'changefreq' => 'monthly'],
            ['loc' => route('privacy'), 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        $products = Product::where('is_active', true)
            ->orderByDesc('updated_at')
            ->get();

        return response()->view('sitemap', compact('static', 'products'))
            ->header('Content-Type', 'application/xml');
    }
}
