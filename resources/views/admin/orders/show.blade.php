@extends('admin.layouts.app')

@section('title', 'Commande ' . $order->order_number)

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold">Commande {{ $order->order_number }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="text-sm text-field-700 font-semibold hover:underline">&larr; Retour</a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-soil-200 p-6">
            <h2 class="font-bold mb-4">Articles</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between text-sm">
                    <span class="flex-1">{{ $item->product_name }} <span class="text-soil-400">× {{ $item->quantity }}</span></span>
                    <span class="font-semibold">{{ number_format((float)$item->total, 2, ',', ' ') }} &euro;</span>
                </div>
                @endforeach
            </div>
            <div class="space-y-1 mt-4 border-t border-soil-200 pt-4 text-sm">
                <div class="flex justify-between text-soil-500"><span>Sous-total</span><span>{{ number_format((float)$order->subtotal, 2, ',', ' ') }} €</span></div>
                <div class="flex justify-between text-soil-500"><span>Livraison</span><span>{{ $order->shipping > 0 ? number_format((float)$order->shipping, 2, ',', ' ') . ' €' : 'Offerte' }}</span></div>
                <div class="flex justify-between font-bold text-base"><span>Total</span><span>{{ number_format((float)$order->total, 2, ',', ' ') }} €</span></div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-soil-200 p-6">
            <h2 class="font-bold mb-4">Livraison</h2>
            <div class="text-sm space-y-1">
                <p class="font-semibold">{{ $order->customer_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_postcode }} {{ $order->shipping_city }}</p>
                <p class="pt-2">{{ $order->customer_email }}</p>
                <p>{{ $order->customer_phone }}</p>
            </div>
            @if($order->notes)
            <div class="mt-4 bg-soil-50 rounded-lg p-3 text-sm">
                <p class="font-semibold mb-1">Notes :</p>
                <p>{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    <aside class="bg-white rounded-xl border border-soil-200 p-6 h-fit">
        <h2 class="font-bold mb-4">Statut de la commande</h2>
        <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="space-y-3">
            @csrf
            <select name="status" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-tractor-400 bg-white">
                @foreach(['new', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                    {{ match($status) { 'new' => 'Nouvelle', 'processing' => 'En cours', 'shipped' => 'Expédiée', 'delivered' => 'Livrée', 'cancelled' => 'Annulée' } }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="w-full bg-field-700 text-white text-sm font-bold px-4 py-3 rounded-lg hover:bg-field-600 transition-colors">
                Mettre à jour le statut
            </button>
        </form>
        <p class="mt-4 text-xs text-soil-400">Créée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
    </aside>
</div>

@endsection