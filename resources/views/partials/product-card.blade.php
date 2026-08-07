@php
    $fallback = 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&q=80';
    $img = $product->image ?? $fallback;
    $waNumber = \App\Models\SiteSetting::getValue('whatsapp_number', '33612345678');
    $waMsg = 'Bonjour, je souhaite commander : ' . $product->name
        . ' (Réf : ' . $product->sku . ')'
        . ' au prix de ' . number_format((float)$product->price, 2, ',', ' ') . ' €.';
    $waUrl = 'https://wa.me/' . preg_replace('/\D/', '', $waNumber) . '?text=' . rawurlencode($waMsg);
@endphp

<div class="group bg-white rounded-xl border border-soil-200 overflow-hidden hover:shadow-xl hover:border-tractor-300 transition-all duration-300 flex flex-col">
    <a href="{{ route('product.show', $product->slug) }}" class="relative block h-48 bg-soil-100 overflow-hidden">
        <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            onerror="this.src='{{ $fallback }}'">
        @if($product->old_price)
        <span class="absolute top-3 left-3 bg-tractor-400 text-field-900 text-xs font-bold px-2 py-1 rounded-lg shadow">Promo</span>
        @endif
        @if($product->is_new)
        <span class="absolute top-3 right-3 bg-field-600 text-white text-xs font-bold px-2 py-1 rounded-lg shadow">Nouveau</span>
        @endif
    </a>

    <div class="p-4 flex flex-col flex-1">
        <p class="text-xs font-semibold text-field-600 uppercase tracking-wide mb-1">{{ $product->brand ?? 'La Boutique du Tracteur' }}</p>
        <a href="{{ route('product.show', $product->slug) }}" class="font-semibold text-soil-900 line-clamp-2 leading-snug hover:text-field-700 transition-colors min-h-[2.5rem]">
            {{ $product->name }}
        </a>
        <p class="text-xs text-soil-400 mt-1 line-clamp-1">{{ $product->compatibility ?? $product->category?->name }}</p>

        <div class="mt-auto pt-3 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div class="flex items-center justify-between gap-2 md:block">
                <div>
                    <p class="text-base font-bold text-field-900">{{ number_format((float)$product->price, 2, ',', ' ') }} &euro;</p>
                    @if($product->old_price && $product->old_price > $product->price)
                    <p class="text-xs text-soil-400 line-through">{{ number_format((float)$product->old_price, 2, ',', ' ') }} &euro;</p>
                    @endif
                </div>
            </div>
            <a href="{{ $waUrl }}" target="_blank" rel="noopener" onclick="event.stopPropagation()"
                class="w-full md:w-auto px-3 py-2.5 md:py-2 bg-tractor-500 hover:bg-tractor-600 text-white text-xs font-semibold rounded-lg transition-all duration-200 whitespace-nowrap flex items-center justify-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Commander
            </a>
        </div>
    </div>
</div>