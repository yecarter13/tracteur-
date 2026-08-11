@extends('layouts.master')

@section('title', $product->meta_title ?? ($product->name . ' — La Boutique du Tracteur'))
@section('meta_description', $product->meta_description ?? \Illuminate\Support\Str::limit(strip_tags((string) $product->description), 160, '…'))

@php
$prodFallback = 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=900&q=80';
$prodImage = $product->image_url ?? $prodFallback;
$prodUrl = route('product.show', $product->slug);
$prodTitle = $product->meta_title ?? ($product->name . ' — La Boutique du Tracteur');
$prodDesc = $product->meta_description ?? \Illuminate\Support\Str::limit(strip_tags((string) $product->description), 160, '…');
$prodBrand = $product->brand ?? 'La Boutique du Tracteur';
$prodAvail = $product->stock_quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/BackOrder';
$lbImages = array_values(array_unique(array_merge([$prodImage], $product->gallery_image_urls)));
$crumbs = [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => route('home')],
    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Boutique', 'item' => route('shop')],
];
if ($product->category) {
    $crumbs[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $product->category->name, 'item' => route('shop', ['category' => $product->category->slug])];
}
$crumbs[] = ['@type' => 'ListItem', 'position' => count($crumbs) + 1, 'name' => $product->name, 'item' => $prodUrl];
@endphp

@section('seo_head')
<meta property="og:type" content="product">
<meta property="og:site_name" content="La Boutique du Tracteur">
<meta property="og:title" content="{{ $prodTitle }}">
<meta property="og:description" content="{{ $prodDesc }}">
<meta property="og:url" content="{{ $prodUrl }}">
<meta property="og:image" content="{{ $prodImage }}">
<meta property="product:price:amount" content="{{ number_format((float)$product->price, 2, '.', '') }}">
<meta property="product:price:currency" content="EUR">
<meta property="product:availability" content="{{ $product->stock_quantity > 0 ? 'in stock' : 'preorder' }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $prodTitle }}">
<meta name="twitter:description" content="{{ $prodDesc }}">
<meta name="twitter:image" content="{{ $prodImage }}">
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'image' => [$prodImage],
    'description' => $product->description,
    'sku' => $product->sku,
    'mpn' => $product->sku,
    'brand' => ['@type' => 'Brand', 'name' => $prodBrand],
    'category' => $product->category?->name,
    'url' => $prodUrl,
    'offers' => [
        '@type' => 'Offer',
        'url' => $prodUrl,
        'priceCurrency' => 'EUR',
        'price' => number_format((float)$product->price, 2, '.', ''),
        'priceValidUntil' => now()->addMonths(12)->toDateString(),
        'availability' => $prodAvail,
        'itemCondition' => 'https://schema.org/NewCondition',
    ],
    'aggregateRating' => $product->rating > 0 ? [
        '@type' => 'AggregateRating',
        'ratingValue' => number_format((float)$product->rating, 1, '.', ''),
        'reviewCount' => $product->review_count ?: 1,
    ] : null,
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => $crumbs,
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')

@php $fallback = $prodFallback; @endphp

<section class="bg-field-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="text-sm text-field-400 flex flex-wrap gap-1">
            <a href="{{ route('home') }}" class="hover:text-tractor-300">Accueil</a>
            <span class="text-field-600">/</span>
            <a href="{{ route('shop') }}" class="hover:text-tractor-300">Boutique</a>
            @if($product->category)
            <span class="text-field-600">/</span>
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-tractor-300">{{ $product->category->name }}</a>
            @endif
            <span class="text-field-600">/</span>
            <span class="text-tractor-300">{{ $product->name }}</span>
        </nav>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid lg:grid-cols-2 gap-10">
        <div class="relative bg-soil-100 rounded-2xl overflow-hidden max-h-[520px] cursor-zoom-in" onclick="openLightbox(0)" role="button" aria-label="Agrandir l'image">
            <img src="{{ $prodImage }}" alt="{{ $product->name }}" class="w-full h-full object-cover"
                onerror="this.src='{{ $fallback }}'">
            @if($product->old_price && $product->old_price > $product->price)
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-tractor-500 text-white text-xs font-bold rounded-lg">-{{ round((1 - (float)$product->price / (float)$product->old_price) * 100) }}%</span>
            @endif
            @if($product->is_new)
            <span class="absolute top-4 right-4 px-2.5 py-1 bg-cta text-white text-xs font-bold rounded-lg">Nouveau</span>
            @endif
            <span class="absolute bottom-3 right-3 flex items-center gap-1 px-2.5 py-1.5 bg-black/60 text-white text-xs font-semibold rounded-lg">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m-3-3h6"/></svg>
                Agrandir
            </span>
        </div>

        <div>
            <div class="flex items-center gap-2 mb-2 flex-wrap">
                <span class="bg-tractor-50 text-tractor-700 text-xs font-bold px-3 py-1 rounded-full">{{ $product->brand ?? 'La Boutique du Tracteur' }}</span>
                <span class="text-xs text-field-400">Réf : {{ $product->sku }}</span>
            </div>

            <h1 class="text-3xl font-bold text-field-900">{{ $product->name }}</h1>

            @if($product->rating > 0)
            <div class="flex items-center gap-2 mt-3">
                <div class="flex">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= round($product->rating) ? 'text-yellow-400' : 'text-soil-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <span class="text-sm text-field-500">{{ number_format((float)$product->rating, 1, ',', '.') }}/5 ({{ $product->review_count }} avis)</span>
            </div>
            @endif

            @if(count($product->gallery_image_urls))
            <div class="grid grid-cols-4 gap-2 mt-4">
                @foreach($product->gallery_image_urls as $index => $img)
                <div class="aspect-square bg-soil-100 rounded-lg overflow-hidden border border-soil-200 cursor-zoom-in" onclick="openLightbox({{ $index + 1 }})" role="button" aria-label="Agrandir l'image {{ $index + 2 }}">
                    <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover" onerror="this.onerror=null;this.parentElement.remove()">
                </div>
                @endforeach
            </div>
            @endif

            <div class="mt-6">
                <p class="text-4xl font-extrabold text-field-900">{{ number_format((float)$product->price, 2, ',', ' ') }} &euro;</p>
                @if($product->old_price && $product->old_price > $product->price)
                <p class="mt-1 text-lg text-field-400 line-through">{{ number_format((float)$product->old_price, 2, ',', ' ') }} &euro;</p>
                <span class="inline-block mt-2 bg-tractor-500 text-white text-xs font-bold px-2 py-1 rounded-lg">
                    Économisez {{ number_format((float)$product->old_price - (float)$product->price, 2, ',', ' ') }} &euro;
                </span>
                @endif
            </div>

            @if($product->stock_quantity > 0)
            <p class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-green-600">
                <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                En stock — {{ $product->stock_quantity }} unités disponibles
            </p>
            @else
            <p class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-field-500">
                <span class="w-2.5 h-2.5 bg-field-400 rounded-full"></span>
                Sur commande — nous vous contacterons
            </p>
            @endif

            @if($product->compatibility)
            <div class="mt-6 bg-field-50 border border-soil-100 rounded-xl p-4">
                <p class="text-xs font-bold text-field-700 uppercase tracking-wider mb-2">Compatibilité</p>
                <p class="text-sm text-soil-700">{{ $product->compatibility }}</p>
            </div>
            @endif

            @php
                $waNumber = \App\Models\SiteSetting::getValue('whatsapp_number', '33612345678');
                $waMsg = 'Bonjour, je souhaite commander : ' . $product->name
                    . ' (Réf : ' . $product->sku . ')'
                    . ' au prix de ' . number_format((float)$product->price, 2, ',', ' ') . ' €/unité.'
                    . ' Quantité : 1.'
                    . ' Compatibilité : ' . ($product->compatibility ?? 'Voir fiche produit.');
                $waUrl = 'https://wa.me/' . preg_replace('/\D/', '', $waNumber) . '?text=' . rawurlencode($waMsg);
            @endphp

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $waUrl }}" target="_blank"
                    class="flex-1 bg-field-700 text-white font-bold px-6 py-3.5 rounded-xl hover:bg-field-600 transition-colors shadow-lg shadow-field-700/20 flex items-center justify-center gap-2 min-w-[180px]">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Commander sur WhatsApp
                </a>
            </div>
        </div>
    </div>

    @if($product->description)
    <div class="mt-12 bg-white rounded-xl border border-soil-100 p-8">
        <h2 class="text-2xl font-bold text-field-900 mb-4">Description</h2>
        <p class="text-soil-600 leading-relaxed">{{ $product->description }}</p>
    </div>
    @endif

    @if($product->specifications)
    <div class="mt-8 bg-field-50 rounded-xl border border-soil-100 p-8">
        <h2 class="text-2xl font-bold text-field-900 mb-4">Spécifications techniques</h2>
        <div class="text-soil-600 leading-relaxed whitespace-pre-line">{{ $product->specifications }}</div>
    </div>
    @endif
</section>

@if($related->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-end justify-between mb-8">
        <div>
            <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Vous aimerez aussi</span>
            <h2 class="text-2xl font-bold text-field-900 mt-1">Pièces similaires</h2>
        </div>
        <a href="{{ route('shop') }}" class="inline-flex items-center text-tractor-500 hover:text-tractor-600 font-semibold text-sm transition-colors">
            Voir tout
            <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
        @foreach($related as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

@endsection

<div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/90" role="dialog" aria-modal="true" aria-label="Visionneuse d'images">
    <button type="button" id="lb-close" class="absolute top-4 right-4 w-11 h-11 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white text-2xl transition-colors" aria-label="Fermer">&times;</button>
    <button type="button" id="lb-prev" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-11 h-11 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white text-3xl transition-colors" aria-label="Image précédente">&#8249;</button>
    <img id="lb-img" src="" alt="Photo agrandie" class="max-w-[92vw] max-h-[82vh] object-contain rounded-lg shadow-2xl">
    <button type="button" id="lb-next" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-11 h-11 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white text-3xl transition-colors" aria-label="Image suivante">&#8250;</button>
    <div id="lb-counter" class="absolute bottom-5 left-1/2 -translate-x-1/2 text-white/90 text-sm font-semibold bg-black/40 px-3 py-1 rounded-full"></div>
</div>

@push('scripts')
<script>
var lbImages = {!! json_encode($lbImages, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!};
var lbIndex = 0;
var lbOverlay = document.getElementById('lightbox');
var lbImg = document.getElementById('lb-img');
var lbCounter = document.getElementById('lb-counter');

function showLightbox(i) {
    lbIndex = (i + lbImages.length) % lbImages.length;
    lbImg.src = lbImages[lbIndex];
    lbCounter.textContent = (lbIndex + 1) + ' / ' + lbImages.length;
}

function openLightbox(i) {
    if (!lbImages.length) return;
    showLightbox(i);
    lbOverlay.classList.remove('hidden');
    lbOverlay.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    lbOverlay.classList.add('hidden');
    lbOverlay.classList.remove('flex');
    document.body.style.overflow = '';
}

document.getElementById('lb-close').addEventListener('click', closeLightbox);
document.getElementById('lb-prev').addEventListener('click', function (e) { e.stopPropagation(); showLightbox(lbIndex - 1); });
document.getElementById('lb-next').addEventListener('click', function (e) { e.stopPropagation(); showLightbox(lbIndex + 1); });
lbOverlay.addEventListener('click', function (e) {
    if (e.target === lbOverlay) closeLightbox();
});

document.addEventListener('keydown', function (e) {
    if (lbOverlay.classList.contains('hidden')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') showLightbox(lbIndex - 1);
    if (e.key === 'ArrowRight') showLightbox(lbIndex + 1);
});

function changeQty(delta) {
    const input = document.getElementById('qty');
    const val = parseInt(input.value) || 1;
    input.value = Math.max(1, val + delta);
}
</script>
@endpush
