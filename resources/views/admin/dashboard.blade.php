@extends('admin.layouts.app')

@section('title', 'Tableau de bord')

@section('content')

<h1 class="text-2xl font-extrabold mb-6">Tableau de bord</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl border border-soil-200 p-6">
        <p class="text-sm text-soil-400">Produits</p>
        <p class="text-3xl font-extrabold mt-1">{{ $stats['products'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-soil-200 p-6">
        <p class="text-sm text-soil-400">Catégories</p>
        <p class="text-3xl font-extrabold mt-1">{{ $stats['categories'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-soil-200 p-6">
        <p class="text-sm text-soil-400">Commandes</p>
        <p class="text-3xl font-extrabold mt-1">{{ $stats['orders'] }}</p>
    </div>
    <div class="bg-white rounded-xl border border-soil-200 p-6">
        <p class="text-sm text-soil-400">Chiffre d'affaires</p>
        <p class="text-3xl font-extrabold mt-1">{{ number_format((float)$stats['revenue'], 2, ',', ' ') }} &euro;</p>
    </div>
</div>

<div class="bg-white rounded-xl border border-soil-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-soil-100 flex items-center justify-between">
        <h2 class="font-bold">Dernières commandes</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-field-700 font-semibold hover:underline">Tout voir</a>
    </div>
    @if($recentOrders->count())
    <table class="w-full text-sm">
        <thead class="bg-soil-50 text-soil-400 uppercase text-xs">
            <tr>
                <th class="text-left px-6 py-3">Commande</th>
                <th class="text-left px-6 py-3">Client</th>
                <th class="text-left px-6 py-3">Total</th>
                <th class="text-left px-6 py-3">Statut</th>
                <th class="text-left px-6 py-3">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-soil-100">
            @foreach($recentOrders as $order)
            <tr class="hover:bg-soil-50">
                <td class="px-6 py-3 font-semibold"><a href="{{ route('admin.orders.show', $order) }}" class="hover:text-field-700">{{ $order->order_number }}</a></td>
                <td class="px-6 py-3">{{ $order->customer_name }}</td>
                <td class="px-6 py-3 font-semibold">{{ number_format((float)$order->total, 2, ',', ' ') }} &euro;</td>
                <td class="px-6 py-3">
                    <span class="inline-block text-xs font-bold px-3 py-1 rounded-full capitalize
                        @if($order->status === 'new') bg-tractor-100 text-tractor-700
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                        @elseif($order->status === 'delivered') bg-field-100 text-field-700
                        @else bg-soil-100 text-soil-600 @endif">
                        {{ match($order->status) { 'new' => 'Nouvelle', 'processing' => 'En cours', 'shipped' => 'Expédiée', 'delivered' => 'Livrée', 'cancelled' => 'Annulée', default => $order->status } }}
                    </span>
                </td>
                <td class="px-6 py-3 text-soil-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="px-6 py-8 text-soil-400 text-center">Aucune commande pour le moment.</p>
    @endif
</div>

@endsection