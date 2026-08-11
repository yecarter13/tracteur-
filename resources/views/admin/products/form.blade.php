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

    <form method="POST" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" class="bg-white rounded-xl border border-soil-200 p-6" enctype="multipart/form-data">
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

            <div class="sm:col-span-2 border-t border-soil-100 pt-4 mt-2">
                <h3 class="text-sm font-bold text-field-900 mb-3">Image principale</h3>
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative border-2 border-dashed border-soil-300 rounded-xl p-6 text-center hover:border-tractor-400 transition-colors cursor-pointer" id="drop-zone">
                            <input type="file" name="image" id="image-input" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <svg class="w-8 h-8 text-soil-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <p class="text-sm text-soil-500">Cliquer ou glisser une image</p>
                            <p class="text-xs text-soil-400 mt-1">JPG, PNG, WebP — max 4 Mo</p>
                        </div>
                    </div>
                    <div class="sm:w-40 shrink-0">
                        <div id="image-preview" class="relative w-full aspect-square bg-soil-100 rounded-xl overflow-hidden border border-soil-200">
                            @if($product?->image)
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            <label class="absolute top-1 right-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded cursor-pointer">
                                <input type="checkbox" name="remove_image" value="1" class="sr-only"> ×
                            </label>
                            @else
                            <div class="flex items-center justify-center h-full text-soil-400 text-xs">Aperçu</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-2 border-t border-soil-100 pt-4 mt-2">
                <h3 class="text-sm font-bold text-field-900 mb-3">Galerie d'images</h3>
                <div class="relative border-2 border-dashed border-soil-300 rounded-xl p-6 text-center hover:border-tractor-400 transition-colors cursor-pointer">
                    <input type="file" name="gallery[]" id="gallery-input" accept="image/*" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <svg class="w-8 h-8 text-soil-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-sm text-soil-500">Ajouter des images (plusieurs possibles)</p>
                    <p class="text-xs text-soil-400 mt-1">JPG, PNG, WebP — max 4 Mo chacun</p>
                </div>
                @if($product && ($product->gallery_images ?? false))
                <div id="gallery-list" class="grid grid-cols-4 sm:grid-cols-6 gap-2 mt-3">
                    @foreach($product->gallery_images as $index => $img)
                    <div class="relative aspect-square bg-soil-100 rounded-lg overflow-hidden border border-soil-200">
                        <img src="{{ Str::startsWith($img, 'http') ? $img : asset('storage/' . $img) }}" class="w-full h-full object-cover">
                        <label class="absolute top-0.5 right-0.5 bg-red-500 text-white text-xs w-5 h-5 rounded flex items-center justify-center cursor-pointer">
                            <input type="checkbox" name="remove_gallery[]" value="{{ $img }}" class="sr-only"> ×
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="sm:col-span-2 border-t border-soil-100 pt-4 mt-2">
                <div class="flex items-center justify-between mb-1">
                    <h3 class="text-sm font-bold text-field-900">Référencement (SEO)</h3>
                    <div class="flex items-center gap-2">
                        <span id="seo-feedback" class="text-xs text-green-600 font-semibold hidden">✓ Généré</span>
                        <button type="button" onclick="generateSeo()" class="text-xs font-semibold px-3 py-1.5 bg-tractor-500 hover:bg-tractor-600 text-white rounded-lg transition-colors flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Générer
                        </button>
                    </div>
                </div>
                <p class="text-xs text-soil-400 mb-3">Ces éléments déterminent l'affichage du produit dans Google. Laissez vide pour une génération automatique.</p>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold mb-1">Titre SEO</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $product?->meta_title) }}" maxlength="70" placeholder="Auto : nom + marque + La Boutique du Tracteur" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
                <p class="mt-1 text-xs text-soil-400">Idéalement 50-65 caractères.</p>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold mb-1">Méta description</label>
                <textarea name="meta_description" id="meta_description" rows="3" maxlength="160" placeholder="Auto : description du produit" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">{{ old('meta_description', $product?->meta_description) }}</textarea>
                <p class="mt-1 text-xs text-soil-400">Idéalement 150-160 caractères.</p>
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

@push('scripts')
<script>
function previewMainImage() {
    var input = document.getElementById('image-input');
    var preview = document.getElementById('image-preview');
    if (!input || !preview || !input.files || !input.files[0]) return;

    var file = input.files[0];
    if (!file.type.startsWith('image/')) return;

    var reader = new FileReader();
    reader.onload = function (e) {
        preview.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
    };
    reader.readAsDataURL(file);
}

function previewGalleryImages() {
    var input = document.getElementById('gallery-input');
    if (!input || !input.files || !input.files.length) return;

    var list = document.getElementById('gallery-list');
    if (!list) {
        list = document.createElement('div');
        list.id = 'gallery-list';
        list.className = 'grid grid-cols-4 sm:grid-cols-6 gap-2 mt-3';
        input.closest('.relative').after(list);
    }
    list.innerHTML = '';

    Array.from(input.files).forEach(function (file) {
        if (!file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            var div = document.createElement('div');
            div.className = 'relative aspect-square bg-soil-100 rounded-lg overflow-hidden border border-soil-200';
            div.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
            list.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

var imageInput = document.getElementById('image-input');
if (imageInput) imageInput.addEventListener('change', previewMainImage);

var galleryInput = document.getElementById('gallery-input');
if (galleryInput) galleryInput.addEventListener('change', previewGalleryImages);

function generateSeo() {
    var nameInput = document.querySelector('input[name="name"]');
    var brandInput = document.querySelector('input[name="brand"]');
    var descInput = document.querySelector('textarea[name="description"]');

    var metaTitle = document.getElementById('meta_title');
    var metaDesc = document.getElementById('meta_description');

    var name = (nameInput ? nameInput.value : '').trim();
    var brand = (brandInput ? brandInput.value : '').trim();
    var desc = (descInput ? descInput.value : '').trim();

    if (!name) {
        var feedback = document.getElementById('seo-feedback');
        feedback.textContent = 'Remplissez le nom du produit d\'abord';
        feedback.className = 'text-xs text-red-600 font-semibold';
        nameInput && nameInput.focus();
        return;
    }

    var t = name + (brand ? ' — ' + brand : '') + ' — La Boutique du Tracteur';
    metaTitle.value = t.substring(0, 70);

    var d = desc
        ? desc.replace(/<[^>]*>/g, '').substring(0, 160)
        : ('Pièce neuve et garantie 24 mois' + (brand ? ' pour ' + brand : '') + '. Prix attractif et livraison 24/48h partout en France.').substring(0, 160);
    metaDesc.value = d;

    var feedback = document.getElementById('seo-feedback');
    feedback.textContent = '✓ Généré';
    feedback.className = 'text-xs text-green-600 font-semibold';
    setTimeout(function () { feedback.className = 'text-xs text-green-600 font-semibold hidden'; }, 3000);
}
</script>
@endpush