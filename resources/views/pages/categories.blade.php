@extends('layouts.master')

@section('title', 'Catégories de pièces de tracteur')

@section('content')

@php
$catImages = [
    'moteur' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=600&q=80',
    'transmission' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&q=80',
    'hydraulique' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=600&q=80',
    'relevage-3-points' => 'https://images.unsplash.com/photo-1596191830588-2ca5ac2bb1ac?w=600&q=80',
    'embrayage' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=600&q=80',
    'freinage' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=600&q=80',
    'pneumatiques' => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=600&q=80',
    'filtration' => 'https://images.unsplash.com/photo-1625047509168-a7026f36de04?w=600&q=80',
    'electricite' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
    'cabine-confort' => 'https://images.unsplash.com/photo-1596471406112-b0292f039339?w=600&q=80',
    'carrosserie' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80',
    'accessoires' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=600&q=80',
];
$fallback = 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=600&q=80';
@endphp

<section class="bg-field-900 py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-tractor-400 font-semibold text-sm uppercase tracking-widest mb-1">Notre catalogue</p>
        <h1 class="text-3xl lg:text-4xl font-bold text-white">Toutes nos catégories</h1>
        <p class="text-field-300 mt-1">Retrouvez l'ensemble des pièces de tracteur classées par univers.</p>
    </div>
</section>

<section class="py-12 lg:py-16 bg-field-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('shop', ['category' => $category->slug]) }}" class="group bg-white rounded-xl border border-soil-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="aspect-[16/9] bg-field-50 overflow-hidden">
                    <img src="{{ $catImages[$category->slug] ?? $fallback }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" onerror="this.onerror=null;this.src='{{ $fallback }}'">
                </div>
                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="font-bold text-lg text-field-900 group-hover:text-tractor-600 transition-colors">{{ $category->name }}</h2>
                        <span class="text-xs font-semibold bg-tractor-50 text-tractor-700 px-2.5 py-1 rounded-full">{{ $category->products_count }} pièces</span>
                    </div>
                    @if($category->description)
                    <p class="text-sm text-soil-500 line-clamp-2">{{ $category->description }}</p>
                    @endif
                    <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-tractor-500 group-hover:gap-2 transition-all">
                        Voir les pièces <span>&rarr;</span>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
