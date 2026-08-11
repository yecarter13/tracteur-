<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        $products = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', ['product' => null, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'compatibility' => 'nullable|string|max:255',
            'stock_quantity' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:4096',
            'gallery' => 'nullable|array',
            'gallery.*' => 'file|image|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $this->uniqueSlug(Str::slug($validated['name']));
        $validated['sku'] = $this->uniqueSku($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_new'] = $request->boolean('is_new');

        $validated['image'] = $this->handleImage($request);
        $validated['gallery_images'] = $this->handleGallery($request);
        $validated = $this->applySeo($validated);
        unset($validated['gallery']);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'compatibility' => 'nullable|string|max:255',
            'stock_quantity' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:4096',
            'gallery' => 'nullable|array',
            'gallery.*' => 'file|image|max:4096',
            'remove_gallery' => 'nullable|array',
            'remove_image' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_new'] = $request->boolean('is_new');

        if ($product->name !== $validated['name']) {
            $validated['slug'] = $this->uniqueSlug(Str::slug($validated['name']), $product->id);
            $validated['sku'] = $this->uniqueSku($validated['name'], $product->id);
        }

        if ($request->boolean('remove_image') && $product->image) {
            $this->deleteStoredFile($product->image);
            $validated['image'] = null;
        }

        $newImage = $this->handleImage($request);
        if ($newImage) {
            if ($product->image && !$request->boolean('remove_image')) {
                $this->deleteStoredFile($product->image);
            }
            $validated['image'] = $newImage;
        }

        $existingGallery = $product->gallery_images ?? [];
        $removeGallery = $request->input('remove_gallery', []);
        $existingGallery = array_values(array_diff($existingGallery, $removeGallery));
        foreach ($removeGallery as $img) {
            $this->deleteStoredFile($img);
        }

        $newGallery = $this->handleGallery($request);
        $validated['gallery_images'] = array_merge($existingGallery, $newGallery);

        $validated = $this->applySeo($validated);
        unset($validated['gallery'], $validated['remove_gallery'], $validated['remove_image']);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé.');
    }

    private function uniqueSlug(string $base, ?int $ignore = null): string
    {
        $slug = $base;
        $counter = 1;
        while (Product::where('slug', $slug)->when($ignore, fn($q) => $q->where('id', '!=', $ignore))->exists()) {
            $slug = $base . '-' . $counter++;
        }
        return $slug;
    }

    private function uniqueSku(string $name, ?int $ignore = null): string
    {
        $base = 'TP-' . strtoupper(Str::slug($name));
        $sku = $base;
        $counter = 1;
        while (Product::where('sku', $sku)->when($ignore, fn($q) => $q->where('id', '!=', $ignore))->exists()) {
            $sku = $base . '-' . $counter++;
        }
        return $sku;
    }

    private function applySeo(array $validated): array
    {
        $name = $validated['name'] ?? '';
        $brand = trim($validated['brand'] ?? '');

        $metaTitle = trim($validated['meta_title'] ?? '');
        if ($metaTitle === '') {
            $metaTitle = $name . ($brand !== '' ? ' — ' . $brand : '') . ' — La Boutique du Tracteur';
        }
        $validated['meta_title'] = Str::limit($metaTitle, 70, '');

        $metaDescription = trim($validated['meta_description'] ?? '');
        if ($metaDescription === '') {
            $base = trim($validated['description'] ?? '');
            $metaDescription = $base !== ''
                ? strip_tags($base)
                : 'Pièce neuve et garantie 24 mois' . ($brand !== '' ? ' pour ' . $brand : '') . '. Prix attractif et livraison 24/48h partout en France.';
        }
        $validated['meta_description'] = Str::limit($metaDescription, 160, '…');

        return $validated;
    }

    private function handleImage(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('products', 'public');
        }
        return null;
    }

    private function handleGallery(Request $request): array
    {
        $paths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $paths[] = $file->store('products', 'public');
            }
        }
        return $paths;
    }

    private function deleteStoredFile(?string $path): void
    {
        if ($path && !filter_var($path, FILTER_VALIDATE_URL) && \Storage::disk('public')->exists($path)) {
            \Storage::disk('public')->delete($path);
        }
    }
}