@extends('admin.layouts.app')

@section('title', $category ? 'Modifier la catégorie' : 'Nouvelle catégorie')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold">{{ $category ? 'Modifier la catégorie' : 'Nouvelle catégorie' }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-field-700 font-semibold hover:underline">&larr; Retour</a>
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

    <form method="POST" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="bg-white rounded-xl border border-soil-200 p-6">
        @csrf
        @if($category) @method('PUT') @endif

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Nom *</label>
                <input type="text" name="name" required value="{{ old('name', $category?->name) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">{{ old('description', $category?->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Ordre d'affichage</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category?->sort_order ?? 0) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <label class="flex items-center gap-2 text-sm font-medium">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category?->is_active ?? true) ? 'checked' : '' }} class="rounded border-soil-300">
                Actif
            </label>
        </div>

        <button type="submit" class="mt-6 bg-field-700 text-white font-bold px-6 py-3 rounded-xl hover:bg-field-600 transition-colors">
            {{ $category ? 'Enregistrer' : 'Créer' }}
        </button>
    </form>
</div>

@endsection