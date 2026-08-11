<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function category(): Category
    {
        return Category::create([
            'name' => 'Pneus',
            'slug' => 'pneus',
            'description' => 'Catégorie test',
            'is_active' => true,
        ]);
    }

    public function test_create_form_renders_without_removed_fields(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get(route('admin.products.create'));

        $response->assertOk();
        $response->assertSee('Nom du produit', false);
        $response->assertSee('Description', false);
        $response->assertSee('name="image"', false);
        $response->assertSee('générés automatiquement', false);
        $response->assertSee('Parmi d\'autres', false);
        $response->assertSee('<select name="brand"', false);
        $response->assertSee('John Deere', false);
        $response->assertSee('Väderstad', false);

        $this->assertStringNotContainsString('name="sku"', $response->getContent());
        $this->assertStringNotContainsString('Ou coller une URL', $response->getContent());
        $this->assertStringNotContainsString('Spécifications techniques', $response->getContent());
        $this->assertStringNotContainsString('name="image_url"', $response->getContent());
        $this->assertStringNotContainsString('name="brand" placeholder', $response->getContent());
        $this->assertStringNotContainsString('generateSeo', $response->getContent());
    }

    public function test_product_is_created_with_auto_sku_and_auto_seo(): void
    {
        $this->actingAs($this->admin());
        $category = $this->category();

        $response = $this->post(route('admin.products.store'), [
            'name' => 'Pneu arrière 16.9R34',
            'category_id' => $category->id,
            'price' => 890.00,
            'brand' => 'Michelin',
            'description' => 'Pneu agricole radial.',
            'image' => UploadedFile::fake()->image('pneu.jpg', 100, 100),
            'stock_quantity' => 12,
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $product = Product::where('name', 'Pneu arrière 16.9R34')->first();
        $this->assertNotNull($product);
        $this->assertSame('TP-PNEU-ARRIERE-169R34', $product->sku);
        $this->assertNotNull($product->image);
        $this->assertStringContainsString('Pneu arrière 16.9R34', $product->meta_title);
        $this->assertStringContainsString('Michelin', $product->meta_title);
        $this->assertStringContainsString('Pneu agricole radial.', $product->meta_description);
        $this->assertTrue($product->is_active);
    }

    public function test_sku_is_unique_for_identical_names(): void
    {
        $this->actingAs($this->admin());
        $category = $this->category();

        $payload = [
            'name' => 'Kit courroie',
            'category_id' => $category->id,
            'price' => 10.00,
            'description' => 'Test',
        ];

        $this->post(route('admin.products.store'), $payload);
        $this->post(route('admin.products.store'), $payload);

        $products = Product::where('name', 'Kit courroie')->orderBy('id')->get();
        $this->assertCount(2, $products);
        $this->assertSame('TP-KIT-COURROIE', $products[0]->sku);
        $this->assertSame('TP-KIT-COURROIE-1', $products[1]->sku);
    }

    public function test_sku_is_regenerated_when_name_changes_on_update(): void
    {
        $this->actingAs($this->admin());
        $category = $this->category();

        $product = Product::create([
            'name' => 'Vilebrequin',
            'slug' => 'vilebrequin',
            'sku' => 'TP-VILEBREQUIN',
            'price' => 549.00,
            'category_id' => $category->id,
            'description' => 'Test',
            'is_active' => true,
        ]);

        $this->put(route('admin.products.update', $product), [
            'name' => 'Vilebrequin complet',
            'category_id' => $category->id,
            'price' => 549.00,
            'description' => 'Test modifié',
            'is_active' => 1,
        ])->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $this->assertSame('TP-VILEBREQUIN-COMPLET', $product->sku);
        $this->assertSame('vilebrequin-complet', $product->slug);
    }

    public function test_update_keeps_existing_brand_when_not_in_select_list(): void
    {
        $this->actingAs($this->admin());
        $category = $this->category();

        $product = Product::create([
            'name' => 'Pneu Michelin',
            'slug' => 'pneu-michelin',
            'sku' => 'TP-PNEU-MICHELIN',
            'price' => 50.00,
            'category_id' => $category->id,
            'brand' => 'Michelin',
            'description' => 'Test',
            'is_active' => true,
        ]);

        $this->put(route('admin.products.update', $product), [
            'name' => 'Pneu Michelin',
            'category_id' => $category->id,
            'price' => 50.00,
            'description' => 'Test modifié',
            'is_active' => 1,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertSame('Michelin', $product->fresh()->brand);
    }

    public function test_guest_cannot_access_admin_products(): void
    {
        $this->get(route('admin.products.create'))->assertRedirect(route('login'));
        $this->post(route('admin.products.store'), [])->assertRedirect(route('login'));
    }
}
