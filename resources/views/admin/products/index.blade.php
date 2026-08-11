@extends('admin.layouts.app')

@section('title', 'Produits')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold">Produits</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-field-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-field-600 transition-colors">
        + Nouveau produit
    </a>
</div>

<form method="GET" action="{{ route('admin.products.index') }}" class="mb-6">
    <div class="flex gap-2 max-w-md">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un produit, une référence..."
            class="flex-1 border border-soil-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-tractor-400 bg-white">
        <button type="submit" class="bg-field-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-field-600">Rechercher</button>
    </div>
</form>

<div class="bg-white rounded-xl border border-soil-200 overflow-hidden">
    @if($products->count())
    <table class="w-full text-sm">
        <thead class="bg-soil-50 text-soil-400 uppercase text-xs">
            <tr>
                <th class="text-left px-6 py-3">Produit</th>
                <th class="text-left px-6 py-3">Image</th>
                <th class="text-left px-6 py-3">Catégorie</th>
                <th class="text-left px-6 py-3">Marque</th>
                <th class="text-left px-6 py-3">Prix</th>
                <th class="text-left px-6 py-3">Stock</th>
                <th class="text-left px-6 py-3">Actif</th>
                <th class="text-right px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-soil-100">
            @foreach($products as $product)
            <tr class="hover:bg-soil-50">
                <td class="px-6 py-3">
                    <p class="font-semibold">{{ $product->name }}</p>
                    <p class="text-xs text-soil-400">{{ $product->sku }}</p>
                </td>
                <td class="px-6 py-3">
                    @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-14 h-14 object-cover rounded-lg border border-soil-200" onerror="this.onerror=null;this.style.display='none'">
                    @else
                    <span class="text-xs text-soil-400">—</span>
                    @endif
                </td>
                <td class="px-6 py-3">{{ $product->category?->name ?? '—' }}</td>
                <td class="px-6 py-3">{{ $product->brand ?? '—' }}</td>
                <td class="px-6 py-3 font-semibold">{{ number_format((float)$product->price, 2, ',', ' ') }} &euro;</td>
                <td class="px-6 py-3">
                    <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full {{ $product->stock_quantity > 10 ? 'bg-field-100 text-field-700' : ($product->stock_quantity > 0 ? 'bg-tractor-100 text-tractor-700' : 'bg-red-100 text-red-700') }}">
                        {{ $product->stock_quantity }}
                    </span>
                </td>
                <td class="px-6 py-3">
                    @if($product->is_active)
                    <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full bg-field-100 text-field-700">Oui</span>
                    @else
                    <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full bg-red-100 text-red-700">Non</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-right whitespace-nowrap">
                    <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="text-field-700 hover:underline text-xs mr-3">Voir</a>
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-field-700 hover:underline text-xs mr-3">Modifier</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Supprimer ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-xs">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-soil-100">
        {{ $products->links() }}
    </div>
    @else
    <p class="px-6 py-10 text-soil-400 text-center">Aucun produit trouvé.</p>
    @endif
</div>

@endsection