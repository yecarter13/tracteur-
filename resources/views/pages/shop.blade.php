@extends('layouts.master')

@section('title', 'Boutique — Pièces de tracteur')

@section('meta_description', 'Toutes nos pièces de tracteur neuves et garanties 24 mois. Livraison partout dans le monde. Moteur, hydraulique, embrayage, filtration — stock disponible.')

@section('seo_head')
<meta property="og:type" content="website">
<meta property="og:site_name" content="La Boutique du Tracteur">
<meta property="og:title" content="Boutique — Pièces de tracteur neuves et garanties">
<meta property="og:description" content="Toutes nos pièces de tracteur neuves et garanties 24 mois. Livraison partout dans le monde. Moteur, hydraulique, embrayage, filtration.">
<meta property="og:url" content="{{ route('shop') }}">
<meta property="og:image" content="{{ asset('hero1.jpg') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Boutique — Pièces de tracteur neuves et garanties">
<meta name="twitter:description" content="Toutes nos pièces de tracteur neuves et garanties 24 mois. Livraison partout dans le monde.">
<meta name="twitter:image" content="{{ asset('hero1.jpg') }}">
@endsection

@section('content')

<section class="bg-field-900 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <p class="text-tractor-400 font-semibold text-sm uppercase tracking-widest mb-1">Notre catalogue</p>
                <h1 class="text-3xl lg:text-4xl font-bold text-white">Pièces de tracteur</h1>
                <p class="text-field-300 mt-1">@if(request('search'))Résultats pour "{{ request('search') }}" @else Toutes nos références neuves et garanties @endif — {{ $products->total() }} pièces</p>
            </div>
            <nav class="flex items-center gap-3 text-sm">
                <a href="{{ route('home') }}" class="text-field-400 hover:text-white transition-colors">Accueil</a>
                <svg class="w-4 h-4 text-field-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Boutique</span>
            </nav>
        </div>
    </div>
</section>

<section class="py-10 lg:py-14 bg-field-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">

            <aside class="lg:col-span-1 mb-8 lg:mb-0">
                <div class="bg-white rounded-xl border border-soil-100 p-5 lg:p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-semibold text-field-900">Filtres</h2>
                        <a href="{{ route('shop') }}" class="text-xs text-tractor-500 hover:text-tractor-600 font-medium transition-colors">Tout effacer</a>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-field-900 mb-2">Recherche</label>
                            <div class="relative">
                                <input type="text" id="shop-search" value="{{ request('search') }}" placeholder="Nom, marque, référence..." class="w-full pl-9 pr-3 py-2 border border-soil-200 rounded-lg text-sm focus:outline-none focus:border-tractor-500 focus:ring-1 focus:ring-tractor-500 transition-all">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-field-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-field-900 mb-2">Catégories</label>
                            <nav class="space-y-1">
                                <a href="{{ route('shop') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-tractor-50 text-tractor-700 font-semibold' : 'text-soil-600 hover:bg-soil-100' }}">
                                    <span>Toutes</span>
                                    <span class="text-xs">{{ $products->total() }}</span>
                                </a>
                                @foreach($categories as $category)
                                <a href="{{ route('shop', array_merge(request()->except('category', 'page'), ['category' => $category->slug])) }}"
                                    class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ request('category') === $category->slug ? 'bg-tractor-50 text-tractor-700 font-semibold' : 'text-soil-600 hover:bg-soil-100' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs">{{ $category->products_count }}</span>
                                </a>
                                @endforeach
                            </nav>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-field-900 mb-2">Marques</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($brands as $brand)
                                <a href="{{ route('shop', array_merge(request()->except('brand', 'page'), ['brand' => $brand])) }}"
                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('brand') === $brand ? 'bg-tractor-500 text-white' : 'bg-soil-100 text-soil-600 hover:bg-soil-200' }}">
                                    {{ $brand }}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        @if(request()->has('category') || request()->has('brand') || request()->has('search'))
                        <a href="{{ route('shop') }}" class="block text-center text-sm font-semibold text-tractor-500 hover:text-tractor-600">Réinitialiser les filtres</a>
                        @endif
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-3">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <p class="text-sm text-field-500">Affichage de <span class="font-semibold text-field-900">{{ $products->firstItem() ?? 0 }}</span> à <span class="font-semibold text-field-900">{{ $products->lastItem() ?? 0 }}</span> sur <span class="font-semibold text-field-900">{{ $products->total() }}</span> références</p>
                    <form method="GET" action="{{ route('shop') }}" class="flex items-center gap-2">
                        @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                        @if(request('brand'))<input type="hidden" name="brand" value="{{ request('brand') }}">@endif
                        @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                        <label class="text-sm text-field-500 hidden sm:block">Trier :</label>
                        <select name="sort" onchange="this.form.submit()" class="text-sm rounded-lg border border-soil-200 bg-white px-3 py-2 focus:outline-none focus:border-tractor-500">
                            <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Nouveautés</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                            <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nom (A-Z)</option>
                        </select>
                    </form>
                </div>

                @if($products->count())
                <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-5">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
                @else
                <div class="bg-white rounded-xl border border-soil-100 p-16 text-center">
                    <svg class="w-16 h-16 text-soil-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <p class="text-field-500 font-medium">Aucune pièce ne correspond à votre recherche.</p>
                    <a href="{{ route('shop') }}" class="text-tractor-500 hover:text-tractor-600 text-sm mt-2 inline-block">Effacer tous les filtres</a>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script>
document.getElementById('shop-search')?.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const url = new URL('{{ route('shop') }}', window.location.origin);
        const params = new URLSearchParams(window.location.search);
        params.delete('page');
        if (this.value.trim()) params.set('search', this.value.trim()); else params.delete('search');
        url.search = params.toString();
        window.location.href = url.toString();
    }
});
</script>
@endpush

@endsection
