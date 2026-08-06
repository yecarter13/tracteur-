@extends('admin.layouts.app')

@section('title', 'Catégories')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold">Catégories</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-field-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:bg-field-600 transition-colors">
        + Nouvelle catégorie
    </a>
</div>

<div class="bg-white rounded-xl border border-soil-200 overflow-hidden">
    @if($categories->count())
    <table class="w-full text-sm">
        <thead class="bg-soil-50 text-soil-400 uppercase text-xs">
            <tr>
                <th class="text-left px-6 py-3">Nom</th>
                <th class="text-left px-6 py-3">Slug</th>
                <th class="text-left px-6 py-3">Produits</th>
                <th class="text-left px-6 py-3">Actif</th>
                <th class="text-right px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-soil-100">
            @foreach($categories as $category)
            <tr class="hover:bg-soil-50">
                <td class="px-6 py-3 font-semibold">{{ $category->name }}</td>
                <td class="px-6 py-3 text-soil-400">{{ $category->slug }}</td>
                <td class="px-6 py-3">{{ $category->products_count }}</td>
                <td class="px-6 py-3">
                    @if($category->is_active)
                    <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full bg-field-100 text-field-700">Oui</span>
                    @else
                    <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full bg-red-100 text-red-700">Non</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-right whitespace-nowrap">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-field-700 hover:underline text-xs mr-3">Modifier</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-xs">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="px-6 py-10 text-soil-400 text-center">Aucune catégorie.</p>
    @endif
</div>

@endsection