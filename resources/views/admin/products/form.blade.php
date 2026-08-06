@extends('admin.layouts.app')

@section('title', $product ? 'Modifier le produit' : 'Nouveau produit')

@section('content')

<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold">{{ $product ? 'Modifier le produit' : 'Nouveau produit' }}</h1>
        <a href="{{ route('admin.products.index') }}" class="text-sm text-field-700 font-semibold hover:underline">&larr; Retour</a>
    </div>

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-4">
        <ul class="space-y-1">
            @foreach($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" class="bg-white rounded-xl border border-soil-200 p-6">
        @csrf
        @if($product) @method('PUT') @endif

        <div class="grid sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold mb-1">Nom du produit *</label>
                <input type="text" name="name" required value="{{ old('name', $product?->name) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Catégorie</label>
                <select name="category_id" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400 bg-white">
                    <option value="">—</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product?->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Marque</label>
                <input type="text" name="brand" value="{{ old('brand', $product?->brand) }}" placeholder="Ex : John Deere" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Prix (€) *</label>
                <input type="number" step="0.01" name="price" required value="{{ old('price', $product?->price) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Ancien prix (€)</label>
                <input type="number" step="0.01" name="old_price" value="{{ old('old_price', $product?->old_price) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Référence (SKU) *</label>
                <input type="text" name="sku" required value="{{ old('sku', $product?->sku) }}" placeholder="Ex : TP-MOTEUR-001" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Stock</label>
                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product?->stock_quantity) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold mb-1">Compatibilité (marque / modèle)</label>
                <input type="text" name="compatibility" value="{{ old('compatibility', $product?->compatibility) }}" placeholder="Ex : John Deere 6050, 6150, 6250" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">{{ old('description', $product?->description) }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold mb-1">Image (URL)</label>
                <input type="text" name="image" value="{{ old('image', $product?->image) }}" placeholder="https://..." class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
        </div>

        <div class="mt-4 flex items-center gap-6">
            <label class="flex items-center gap-2 text-sm font-medium">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }} class="rounded border-soil-300">
                Actif (visible en boutique)
            </label>
            <label class="flex items-center gap-2 text-sm font-medium">
                <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product?->is_new) ? 'checked' : '' }} class="rounded border-soil-300">
                Nouveau
            </label>
        </div>

        <button type="submit" class="mt-6 bg-field-700 text-white font-bold px-6 py-3 rounded-xl hover:bg-field-600 transition-colors">
            {{ $product ? 'Enregistrer les modifications' : 'Créer le produit' }}
        </button>
    </form>
</div>

@endsection