@extends('layouts.master')

@section('title', 'La Boutique du Tracteur — Pièces de tracteur neuves et garanties partout dans le monde')

@section('seo_head')
<meta property="og:type" content="website">
<meta property="og:site_name" content="La Boutique du Tracteur">
<meta property="og:title" content="La Boutique du Tracteur — Pièces de tracteur neuves et garanties partout dans le monde">
<meta property="og:description" content="Votre fournisseur de pièces de tracteur neuves et garanties : moteur, hydraulique, embrayage, relevage, filtration. Livraison partout dans le monde.">
<meta property="og:url" content="{{ url('/') }}">
<meta property="og:image" content="{{ $fallback }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="La Boutique du Tracteur — Pièces de tracteur neuves et garanties partout dans le monde">
<meta name="twitter:description" content="Votre fournisseur de pièces de tracteur neuves et garanties. Livraison partout dans le monde.">
<meta name="twitter:image" content="{{ $fallback }}">
@endsection

@section('content')

{{-- HERO CAROUSEL --}}
<section class="relative bg-field-900 overflow-hidden">
    <div id="hero-carousel" class="relative h-[65vh] min-h-[480px] lg:min-h-[580px]">
        @foreach($slides as $index => $slide)
        <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out" data-active="{{ $index === 0 ? 'true' : 'false' }}" style="opacity: {{ $index === 0 ? 1 : 0 }}; z-index: {{ $index === 0 ? 10 : 0 }};">
            <div class="absolute inset-0">
                <img src="{{ $slide->image }}" alt="" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" onerror="this.src='{{ $fallback }}'">
                <div class="absolute inset-0 bg-gradient-to-r from-field-950/95 via-field-950/75 to-field-950/30"></div>
            </div>
            <div class="relative z-10 h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
                <div class="max-w-2xl animate-fade-in">
                    <span class="inline-block px-3 py-1 bg-tractor-500 text-white text-xs font-semibold uppercase tracking-widest rounded-full mb-4">{{ $slide->tag }}</span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-4">{{ $slide->title }}</h1>
                    <p class="text-lg sm:text-xl text-field-300 mb-8 max-w-xl leading-relaxed">{{ $slide->subtitle }}</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3.5 bg-tractor-500 hover:bg-tractor-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-tractor-500/25 hover:shadow-tractor-500/40 hover:-translate-y-0.5">
                            {{ $slide->cta_primary }}
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3.5 border-2 border-white/20 hover:border-white/40 text-white font-semibold rounded-xl transition-all duration-300 hover:bg-white/5">
                            {{ $slide->cta_secondary }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            @foreach($slides as $index => $slide)
            <button class="hero-dot w-2.5 h-2.5 rounded-full transition-all duration-300" data-index="{{ $index }}" style="background: {{ $index === 0 ? '#ff6b00' : 'rgba(255,255,255,0.4)' }}; {{ $index === 0 ? 'width: 2rem;' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <button id="hero-prev" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-black/30 hover:bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button id="hero-next" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-black/30 hover:bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</section>

{{-- TRUST BADGES --}}
<section class="bg-white border-b border-soil-200 py-8 lg:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
            <div class="flex flex-col items-center text-center p-4 lg:p-5 bg-field-50 rounded-2xl border border-soil-100 hover:border-tractor-300/40 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <div class="w-12 h-12 lg:w-14 lg:h-14 bg-green-100 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="text-sm lg:text-base font-bold text-field-900 mb-0.5">Garantie 24 mois</h4>
                <p class="text-[11px] lg:text-xs text-field-500">Sur toutes nos pièces</p>
            </div>
            <div class="flex flex-col items-center text-center p-4 lg:p-5 bg-field-50 rounded-2xl border border-soil-100 hover:border-tractor-300/40 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <div class="w-12 h-12 lg:w-14 lg:h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h4 class="text-sm lg:text-base font-bold text-field-900 mb-0.5">Livraison 24/48h</h4>
                <p class="text-[11px] lg:text-xs text-field-500">Partout dans le monde</p>
            </div>
            <div class="flex flex-col items-center text-center p-4 lg:p-5 bg-field-50 rounded-2xl border border-soil-100 hover:border-tractor-300/40 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <div class="w-12 h-12 lg:w-14 lg:h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </div>
                <h4 class="text-sm lg:text-base font-bold text-field-900 mb-0.5">Commande simplifiée</h4>
                <p class="text-[11px] lg:text-xs text-field-500">Directement sur WhatsApp</p>
            </div>
            <div class="flex flex-col items-center text-center p-4 lg:p-5 bg-field-50 rounded-2xl border border-soil-100 hover:border-tractor-300/40 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <div class="w-12 h-12 lg:w-14 lg:h-14 bg-tractor-100 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 lg:w-7 lg:h-7 text-tractor-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.36-1.86M17 20H7m10 0v-2c0-.76-.13-1.48-.36-2.14M7 20H2v-2a3 3 0 015.36-1.86M7 20v-2c0-.76.13-1.48.36-2.14m7.28-3.65a4.5 4.5 0 10-6.28 0M15.5 7.5a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0z"/></svg>
                </div>
                <h4 class="text-sm lg:text-base font-bold text-field-900 mb-0.5">Service expert</h4>
                <p class="text-[11px] lg:text-xs text-field-500">Conseils personnalisés</p>
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIES --}}
<section class="py-16 lg:py-20 bg-field-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 lg:mb-14">
            <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Nos univers</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-field-900 mt-2">Explorez par catégorie</h2>
            <p class="text-field-500 mt-3 max-w-2xl mx-auto">Plus de 50 000 références en stock pour toutes les grandes marques de tracteurs</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 lg:gap-5">
            @foreach($categories as $i => $category)
            <a href="{{ route('shop', ['category' => $category->slug]) }}" class="group relative bg-white rounded-xl border border-soil-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="aspect-[4/3] bg-field-50 overflow-hidden">
                    <img src="{{ $catImages[$category->slug] ?? $fallback }}" alt="{{ $category->name }}" class="w-full h-full object-cover p-0 group-hover:scale-110 transition-transform duration-500" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=400&q=80'">
                </div>
                <div class="p-3 text-center bg-white border-t border-soil-100">
                    <h3 class="font-semibold text-field-900 text-sm group-hover:text-tractor-600 transition-colors">{{ $category->name }}</h3>
                    <p class="text-field-400 text-xs mt-0.5">{{ $category->products_count }} pièces</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('categories.all') }}" class="inline-flex items-center text-tractor-500 hover:text-tractor-600 font-semibold transition-colors">
                Voir toutes les catégories
                <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- SEARCH BAND --}}
<section class="bg-gradient-to-b from-field-900 to-field-800 py-6 lg:py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-white text-xl lg:text-2xl font-bold mb-4">Trouvez la bonne référence en quelques secondes</h2>
        <form action="{{ route('shop') }}" method="GET" class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. embrayage John Deere, pompe hydraulique, réf OEM..."
                   class="w-full pl-5 pr-14 py-3.5 bg-white rounded-xl text-sm lg:text-base text-field-900 placeholder-field-400 focus:outline-none focus:ring-2 focus:ring-tractor-500 shadow-xl">
            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 bg-tractor-500 hover:bg-tractor-600 text-white font-semibold rounded-lg text-sm transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </form>
    </div>
</section>

{{-- SECTION IMAGE --}}
<section class="py-16 lg:py-20 bg-field-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-10 lg:gap-14 items-center">
            <div class="relative">
                <img src="{{ asset('section3.jpeg') }}" alt="La Boutique du Tracteur — pièces détachées" class="w-full h-full object-cover rounded-2xl border border-soil-100 shadow-xl" loading="lazy">
            </div>
            <div>
                <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Notre savoir-faire</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-field-900 mt-2">Des pièces de tracteur neuves et garanties, partout dans le monde</h2>
                <p class="text-field-500 mt-4 leading-relaxed">Depuis plus de 60 ans, La Boutique du Tracteur accompagne agriculteurs, concessionnaires et ateliers avec un stock de plus de 50 000 références et l'expertise de nos spécialistes.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex gap-3 items-start"><span class="text-tractor-500 font-bold">✓</span><span class="text-soil-600">Pièces neuves d'origine ou de qualité équivalente certifiée</span></li>
                    <li class="flex gap-3 items-start"><span class="text-tractor-500 font-bold">✓</span><span class="text-soil-600">Garantie 24 mois sur toutes nos références</span></li>
                    <li class="flex gap-3 items-start"><span class="text-tractor-500 font-bold">✓</span><span class="text-soil-600">Expédition sous 24h et livraison partout dans le monde</span></li>
                </ul>
                <a href="{{ route('shop') }}" class="mt-8 inline-flex items-center px-6 py-3 bg-tractor-500 hover:bg-tractor-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-tractor-500/25">
                    Découvrir la boutique
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- PRODUITS PHARES --}}
<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Nouveautés</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-field-900 mt-2">Pièces à la une</h2>
                <p class="text-field-500 mt-2">Les pièces nouvellement enregistrées dans notre catalogue — neuves, garanties et prêtes à expédier</p>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center text-tractor-500 hover:text-tractor-600 font-semibold text-sm transition-colors">
                Toute la boutique
                <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-tractor-500 hover:bg-tractor-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-tractor-500/25">
                Voir tous les produits
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="py-16 lg:py-20 bg-field-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-72 h-72 bg-tractor-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-cta rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 lg:mb-16">
            <span class="text-tractor-400 font-semibold text-sm uppercase tracking-widest">Pourquoi nous choisir</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-white mt-2">Commandez avec confiance</h2>
            <p class="text-field-300 mt-3 max-w-2xl mx-auto">Un service pensé pour les professionnels du monde agricole, de la recherche de pièce à la livraison</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6 lg:p-8 text-center hover:bg-white/10 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto mb-5 bg-tractor-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-tractor-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-white font-semibold mb-2">Expédition sous 24h</h3>
                <p class="text-field-400 text-sm leading-relaxed">Commandes préparées le jour même et expédiées sous 24h, avec livraison partout dans le monde.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6 lg:p-8 text-center hover:bg-white/10 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto mb-5 bg-tractor-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-tractor-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-white font-semibold mb-2">Qualité garantie</h3>
                <p class="text-field-400 text-sm leading-relaxed">Pièces neuves, conformes aux normes constructeurs, avec une garantie de 24 mois sur toutes nos références.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6 lg:p-8 text-center hover:bg-white/10 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto mb-5 bg-tractor-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-tractor-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-white font-semibold mb-2">Commande simplifiée</h3>
                <p class="text-field-400 text-sm leading-relaxed">Confirmez votre commande directement sur WhatsApp avec notre équipe, en quelques secondes.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-6 lg:p-8 text-center hover:bg-white/10 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto mb-5 bg-tractor-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-tractor-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-white font-semibold mb-2">Expertise technique</h3>
                <p class="text-field-400 text-sm leading-relaxed">Nos experts identifient la référence exacte de votre tracteur, même pour les pièces rares.</p>
            </div>
        </div>
    </div>
</section>

{{-- PRODUITS ALEATOIRES --}}
<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Découverte</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-field-900 mt-2">D'autres pièces à découvrir</h2>
                <p class="text-field-500 mt-2">Une sélection aléatoire renouvelée à chaque visite — laissez-vous surprendre</p>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center text-tractor-500 hover:text-tractor-600 font-semibold text-sm transition-colors">
                Toute la boutique
                <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            @foreach($randomProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-tractor-500 hover:bg-tractor-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-tractor-500/25">
                Voir tous les produits
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- TEMOIGNAGES --}}
<section class="py-16 lg:py-20 bg-field-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 lg:mb-14">
            <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Ils nous font confiance</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-field-900 mt-2">Des agriculteurs satisfaits</h2>
            <p class="text-field-500 mt-3 max-w-2xl mx-auto">Des milliers de clients nous font confiance pour l'entretien de leurs machines</p>
        </div>
        <div id="testimonials-track" class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-4 -mx-4 px-4 sm:px-6 md:mx-0 md:px-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-6 md:overflow-visible md:snap-none md:pb-0">
            @foreach($testimonials as $t)
            <div class="shrink-0 w-[85%] sm:w-[65%] snap-start bg-white rounded-xl border border-soil-100 p-6 hover:shadow-xl transition-all duration-300 md:w-auto md:shrink">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $t->rating ? 'text-yellow-400' : 'text-soil-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-soil-600 text-sm leading-relaxed mb-4 italic line-clamp-4">"{{ $t->text }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-tractor-100 rounded-full flex items-center justify-center text-tractor-700 font-bold text-sm">
                        {{ strtoupper(substr($t->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-field-900 text-sm">{{ $t->name }}</p>
                        <p class="text-field-400 text-xs">{{ $t->city }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="bg-field-900 text-field-300 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-tractor-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Vous ne trouvez pas votre pièce ?</h2>
            <p class="mt-2 md:text-lg text-field-300">Contactez nos experts, nous dénichons la référence exacte de votre tracteur.</p>
        </div>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3.5 bg-tractor-500 hover:bg-tractor-600 text-white font-bold rounded-xl transition-colors whitespace-nowrap shadow-lg shadow-tractor-500/25">
            Demander une pièce
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
    </div>
</section>

{{-- MARQUES --}}
@php
$brandLogos = [
    ['name' => 'John Deere', 'img' => '/john.png'],
    ['name' => 'New Holland', 'img' => '/newholland.png'],
    ['name' => 'Fendt', 'img' => '/fendt.png'],
    ['name' => 'Massey Ferguson', 'img' => '/massey.png'],
    ['name' => 'Case', 'img' => '/case.png'],
    ['name' => 'IH', 'img' => '/ih.jpg'],
    ['name' => 'Kubota', 'img' => '/kubota.png'],
    ['name' => 'Deutz-Fahr', 'img' => '/deutz.png'],
    ['name' => 'McCormick', 'img' => '/mccormick.jpg'],
    ['name' => 'Same', 'img' => '/Same.png'],
    ['name' => 'Lamborghini', 'img' => '/Lamborghini%20.png'],
    ['name' => 'Landini', 'img' => '/landini.jpg'],
    ['name' => 'Fiat', 'img' => '/Fiat.jpg'],
    ['name' => 'Renault', 'img' => '/Renault.png'],
    ['name' => 'Ford', 'img' => '/Ford.png'],
    ['name' => 'Ferrari', 'img' => '/Ferrari.jpg'],
    ['name' => 'Goldoni', 'img' => '/Goldoni.png'],
];
@endphp
<section class="bg-field-50 border-t border-soil-100 py-14 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 lg:mb-10">
            <span class="text-tractor-500 font-semibold text-sm uppercase tracking-widest">Nos marques</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-field-900 mt-2">Les grandes marques de tracteurs</h2>
            <p class="text-field-500 mt-3 max-w-2xl mx-auto">Nous équipons les plus grandes marques de tracteurs avec des pièces neuves et garanties</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-5">
            @foreach($brandLogos as $brand)
            <div class="group bg-white rounded-xl border border-soil-100 p-3 sm:p-5 flex items-center justify-center hover:shadow-lg hover:-translate-y-0.5 hover:border-tractor-300/40 transition-all duration-300">
                @if($brand['img'])
                <img src="{{ $brand['img'] }}" alt="{{ $brand['name'] }}" loading="lazy"
                     class="max-h-10 sm:max-h-14 w-auto object-contain opacity-70 group-hover:opacity-100 grayscale group-hover:grayscale-0 transition-all duration-300"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <span class="hidden items-center justify-center text-field-500 font-bold text-sm sm:text-base tracking-tight">{{ $brand['name'] }}</span>
                @else
                <span class="inline-flex items-center gap-2 text-field-500 group-hover:text-tractor-500 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M5 20h14v-2H5v2zM12 3c-.7 0-1.3.36-1.66.92L4 10v2h16v-2l-6.34-6.08A1.99 1.99 0 0012 3zm-3 7h6a5 5 0 01-6 0zm3 2a5 5 0 01-5-5V7h9v5h-4zm-2 4h2v3h-2v-3zm4 0h2v3h-2v-3z"/></svg>
                    <span class="font-bold tracking-tight text-sm sm:text-base">{{ $brand['name'] }}</span>
                </span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
(function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prev = document.getElementById('hero-prev');
    const next = document.getElementById('hero-next');
    let current = 0;
    let interval;

    function goTo(index) {
        slides.forEach((s, i) => {
            s.style.opacity = i === index ? '1' : '0';
            s.style.zIndex = i === index ? '10' : '0';
            s.dataset.active = i === index ? 'true' : 'false';
        });
        dots.forEach((d, i) => {
            d.style.background = i === index ? '#ff6b00' : 'rgba(255,255,255,0.4)';
            d.style.width = i === index ? '2rem' : '0.625rem';
        });
        current = index;
    }

    function nextSlide() { goTo((current + 1) % slides.length); }
    function prevSlide() { goTo((current - 1 + slides.length) % slides.length); }

    dots.forEach(dot => {
        dot.addEventListener('click', function() { clearInterval(interval); goTo(parseInt(this.dataset.index)); startAuto(); });
    });
    if (prev) prev.addEventListener('click', function() { clearInterval(interval); prevSlide(); startAuto(); });
    if (next) next.addEventListener('click', function() { clearInterval(interval); nextSlide(); startAuto(); });

    function startAuto() { interval = setInterval(nextSlide, 6000); }
    startAuto();
})();

(function() {
    const track = document.getElementById('testimonials-track');
    if (!track) return;
    const mq = window.matchMedia('(max-width: 767px)');
    let timer, paused = false;

    function next() {
        const cards = track.querySelectorAll('.snap-start');
        if (!cards.length) return;
        const card = cards[0];
        const step = card.offsetWidth + 16;
        if (track.scrollLeft + track.clientWidth >= track.scrollWidth - 4) {
            track.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            track.scrollBy({ left: step, behavior: 'smooth' });
        }
    }

    function start() {
        clearInterval(timer);
        timer = setInterval(next, 3500);
    }
    function stop() { clearInterval(timer); }

    function sync() {
        if (mq.matches) { start(); } else { stop(); track.scrollLeft = 0; }
    }

    track.addEventListener('pointerdown', () => { paused = true; stop(); });
    track.addEventListener('pointerup', () => { paused = false; setTimeout(sync, 3000); });
    track.addEventListener('pointercancel', () => { paused = false; setTimeout(sync, 3000); });
    track.addEventListener('touchend', () => { paused = false; setTimeout(sync, 3000); });
    mq.addEventListener('change', sync);
    sync();
})();
</script>
@endpush

@endsection
