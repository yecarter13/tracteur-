@extends('admin.layouts.app')

@section('title', 'Commandes')

@section('content')

<h1 class="text-2xl font-extrabold mb-6">Commandes</h1>

<div class="bg-white rounded-xl border border-soil-200 overflow-hidden">
    @if($orders->count())
    <table class="w-full text-sm">
        <thead class="bg-soil-50 text-soil-400 uppercase text-xs">
            <tr>
                <th class="text-left px-6 py-3">N°</th>
                <th class="text-left px-6 py-3">Client</th>
                <th class="text-left px-6 py-3">Total</th>
                <th class="text-left px-6 py-3">Statut</th>
                <th class="text-left px-6 py-3">Date</th>
                <th class="text-right px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-soil-100">
            @foreach($orders as $order)
            <tr class="hover:bg-soil-50">
                <td class="px-6 py-3 font-semibold">{{ $order->order_number }}</td>
                <td class="px-6 py-3">
                    <p class="font-medium">{{ $order->customer_name }}</p>
                    <p class="text-xs text-soil-400">{{ $order->customer_email }}</p>
                </td>
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
                <td class="px-6 py-3 text-right">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-field-700 hover:underline text-xs">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-soil-100">
        {{ $orders->links() }}
    </div>
    @else
    <p class="px-6 py-10 text-soil-400 text-center">Aucune commande.</p>
    @endif
</div>

@endsection