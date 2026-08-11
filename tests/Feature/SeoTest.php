<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    private function product(): Product
    {
        $category = Category::create([
            'name' => 'Pneus',
            'slug' => 'pneus',
            'description' => 'Catégorie pneus',
            'is_active' => true,
        ]);

        return Product::create([
            'name' => 'Pneu arrière 16.9R34',
            'slug' => 'pneu-arriere-169r34',
            'sku' => 'TP-PNEU-169R34',
            'price' => 890.00,
            'category_id' => $category->id,
            'description' => 'Pneu agricole radial arrière.',
            'brand' => 'Michelin',
            'image' => 'products/pneu.jpg',
            'is_active' => true,
            'rating' => 4.5,
            'review_count' => 12,
            'stock_quantity' => 10,
            'meta_title' => 'Pneu arrière 16.9R34 — La Boutique du Tracteur',
            'meta_description' => 'Pneu agricole radial arrière.',
        ]);
    }

    public function test_product_page_has_json_ld_and_open_graph(): void
    {
        $product = $this->product();

        $response = $this->get(route('product.show', $product->slug));

        $response->assertOk();
        $content = $response->getContent();

        $this->assertStringContainsString('<meta property="og:type" content="product">', $content);
        $this->assertStringContainsString('og:title', $content);
        $this->assertStringContainsString('og:image', $content);
        $this->assertStringContainsString('og:url', $content);
        $this->assertStringContainsString('twitter:card', $content);
        $this->assertStringContainsString('application/ld+json', $content);
        $this->assertStringContainsString('"@type":"Product"', $content);
        $this->assertStringContainsString('"@type":"AggregateRating"', $content);
        $this->assertStringContainsString('"@type":"Offer"', $content);
        $this->assertStringContainsString('"@type":"BreadcrumbList"', $content);
        $this->assertStringContainsString('"priceCurrency":"EUR"', $content);
        $this->assertStringContainsString('"sku":"TP-PNEU-169R34"', $content);
    }

    public function test_home_page_has_open_graph(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $content = $response->getContent();

        $this->assertStringContainsString('<meta property="og:type" content="website">', $content);
        $this->assertStringContainsString('og:title', $content);
        $this->assertStringContainsString('og:image', $content);
    }

    public function test_shop_page_has_open_graph(): void
    {
        $response = $this->get(route('shop'));

        $response->assertOk();
        $content = $response->getContent();

        $this->assertStringContainsString('<meta property="og:type" content="website">', $content);
        $this->assertStringContainsString('og:title', $content);
        $this->assertStringContainsString('og:image', $content);
    }

    public function test_sitemap_includes_categories_images_and_lastmod(): void
    {
        $this->product();

        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');

        $content = $response->getContent();
        $this->assertStringContainsString('xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"', $content);
        $this->assertStringContainsString('<image:loc>', $content);
        $this->assertStringContainsString('category=pneus', $content);
        $this->assertStringContainsString('<lastmod>', $content);
    }
}
