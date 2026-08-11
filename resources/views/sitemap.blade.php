{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($static as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        @if(isset($url['lastmod']))<lastmod>{{ $url['lastmod'] }}</lastmod>@endif
        <changefreq>{{ $url['changefreq'] }}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
    </url>
    @endforeach

    @foreach($categories as $category)
    <url>
        <loc>{{ route('shop', ['category' => $category->slug]) }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    @foreach($products as $product)
    <url>
        <loc>{{ route('product.show', $product->slug) }}</loc>
        @if($product->updated_at)
        <lastmod>{{ $product->updated_at->toDateString() }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
        @if($product->image)
        <image:image>
            <image:loc>{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}</image:loc>
            <image:title>{{ $product->name }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>
