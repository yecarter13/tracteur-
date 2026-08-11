<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'specifications',
        'price', 'old_price', 'sku', 'compatibility', 'image', 'gallery_images',
        'brand', 'is_new', 'is_active', 'stock_quantity', 'rating', 'review_count',
        'meta_title', 'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'is_new' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'old_price' => 'decimal:2',
            'rating' => 'decimal:1',
            'gallery_images' => 'array',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function getGalleryImageUrlsAttribute(): array
    {
        return collect($this->gallery_images ?? [])
            ->map(fn($img) => str_starts_with($img, 'http') ? $img : asset('storage/' . $img))
            ->values()
            ->all();
    }

    protected static function booted(): void
    {
        static::creating(function (self $product) {
            if (empty($product->slug)) {
                $baseSlug = Str::slug($product->name);
                $slug = $baseSlug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }
                $product->slug = $slug;
            }
        });
    }
}
