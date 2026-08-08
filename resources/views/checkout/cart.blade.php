@extends('layouts.master')

@section('title', 'Votre panier')

@section('meta_description', 'Votre panier sur La Boutique du Tracteur. Vérifiez vos pièces de tracteur sélectionnées et finalisez votre commande en toute sécurité.')

@section('content')

<section class="bg-field-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <p class="text-tractor-400 font-semibold text-sm uppercase tracking-widest mb-1">Votre commande</p>
        <h1 class="text-3xl md:text-4xl font-bold text-white">Votre panier</h1>
        <p class="mt-1 text-field-300">{{ count($items) }} article(s)</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if(count($items) === 0)
    <div class="bg-white rounded-xl border border-soil-100 p-16 text-center">
        <svg class="w-16 h-16 text-soil-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
        <p class="text-field-500 text-lg mb-4">Votre panier est vide.</p>
        <a href="{{ route('shop') }}" class="inline-block bg-tractor-500 hover:bg-tractor-600 text-white font-bold px-6 py-3 rounded-xl transition-colors">
            Découvrir la boutique
        </a>
    </div>
    @else
    <div class="grid lg:grid-cols-[1fr_360px] gap-8">
        <div class="space-y-4">
            @foreach($items as $item)
            @php $product = $item->product; $fallback = 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&q=80'; @endphp
            <div class="bg-white rounded-xl border border-soil-100 p-4 flex flex-wrap items-center gap-4 hover:shadow-lg transition-shadow">
                <a href="{{ route('product.show', $product->slug) }}" class="w-20 h-20 bg-soil-100 rounded-lg overflow-hidden shrink-0">
                    <img src="{{ $product->image ?? $fallback }}" alt="{{ $product->name }}" class="w-full h-full object-cover"
                        onerror="this.src='{{ $fallback }}'">
                </a>
                <div class="flex-1 min-w-[180px]">
                    <a href="{{ route('product.show', $product->slug) }}" class="font-semibold text-field-900 hover:text-tractor-600 transition-colors">{{ $product->name }}</a>
                    <p class="text-sm text-field-400 mt-1">Réf : {{ $product->sku }}</p>
                    <p class="mt-2 font-bold text-field-900">{{ number_format((float)$product->price, 2, ',', ' ') }} &euro; / unité</p>
                </div>
                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('cart.update', $product->id) }}" class="flex items-center gap-2">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                            class="w-16 text-center border border-soil-200 rounded-lg py-2 focus:outline-none focus:ring-2 focus:ring-tractor-400">
                        <button type="submit" class="text-sm text-tractor-600 font-semibold hover:underline">Mettre à jour</button>
                    </form>
                    <form method="POST" action="{{ route('cart.remove', $product->id) }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 font-semibold hover:underline">Supprimer</button>
                    </form>
                </div>
                <p class="font-extrabold text-lg text-field-900 w-28 text-right">{{ number_format((float)$item->total, 2, ',', ' ') }} &euro;</p>
            </div>
            @endforeach

            <form method="POST" action="{{ route('cart.clear') }}" class="text-right">
                @csrf
                <button type="submit" class="text-sm text-field-400 hover:text-red-600 transition-colors">Vider le panier</button>
            </form>
        </div>

        <aside class="bg-white rounded-xl border border-soil-100 p-6 h-fit sticky top-24">
            <h2 class="font-bold text-xl text-field-900 mb-4">Résumé</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-field-500">Sous-total</span><span class="font-semibold text-field-900">{{ number_format((float)$subtotal, 2, ',', ' ') }} &euro;</span></div>
                <div class="flex justify-between">
                    <span class="text-field-500">Livraison</span>
                    <span class="font-semibold {{ $shipping > 0 ? 'text-field-900' : 'text-green-600' }}">{{ $shipping > 0 ? number_format((float)$shipping, 2, ',', ' ') . ' €' : 'Offerte' }}</span>
                </div>
                @if($subtotal < 200 && $subtotal > 0)
                <p class="text-xs text-field-500 bg-field-50 rounded-lg p-2">
                    Plus que <strong class="text-tractor-600">{{ number_format((float)(200 - $subtotal), 2, ',', ' ') }} €</strong> pour la livraison offerte !
                </p>
                @endif
                <div class="border-t border-soil-200 pt-3 flex justify-between font-bold text-lg">
                    <span class="text-field-900">Total</span><span class="text-field-900">{{ number_format((float)$total, 2, ',', ' ') }} &euro;</span>
                </div>
            </div>
            @php
                $waNumber = \App\Models\SiteSetting::getValue('whatsapp_number', '33612345678');
                $lines = ['Bonjour, je souhaite commander :'];
                foreach ($items as $i) {
                    $lines[] = '- ' . $i->quantity . 'x ' . $i->product->name . ' (Réf ' . $i->product->sku . ') = ' . number_format((float)$i->total, 2, ',', ' ') . ' €';
                }
                $lines[] = 'Total : ' . number_format((float)$total, 2, ',', ' ') . ' € (livraison incluse).';
                $waUrl = 'https://wa.me/' . preg_replace('/\D/', '', $waNumber) . '?text=' . rawurlencode(implode("\n", $lines));
            @endphp
            <a href="{{ $waUrl }}" target="_blank" class="mt-5 flex items-center justify-center gap-2 bg-field-700 hover:bg-field-600 text-white font-bold px-6 py-3.5 rounded-xl transition-colors shadow-lg shadow-field-700/20">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Commander sur WhatsApp
            </a>
            <p class="mt-3 text-xs text-center text-field-400">Votre commande sera confirmée sur WhatsApp par notre équipe. Paiement à la livraison.</p>
            <a href="{{ route('shop') }}" class="mt-3 block text-center text-tractor-600 font-semibold hover:underline text-sm">Continuer mes achats</a>
        </aside>
    </div>
    @endif
</section>

@endsection
