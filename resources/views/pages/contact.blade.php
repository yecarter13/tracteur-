@extends('layouts.master')

@section('title', 'Contact — La Boutique du Tracteur')

@section('content')

<section class="bg-field-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <p class="text-tractor-400 font-semibold text-sm uppercase tracking-widest mb-1">Nous contacter</p>
        <h1 class="text-3xl md:text-4xl font-bold text-white">Contactez nos experts</h1>
        <p class="mt-2 text-field-300">Une question, une pièce introuvable ? Notre équipe vous répond rapidement.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-2 gap-10">
        <div>
            @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 text-sm font-medium rounded-lg p-4">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="bg-white rounded-xl border border-soil-100 p-6 space-y-4">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-field-900">Votre nom *</label>
                        <input type="text" name="name" required class="w-full border border-soil-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tractor-400">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-field-900">Votre email *</label>
                        <input type="email" name="email" required class="w-full border border-soil-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tractor-400">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1 text-field-900">Sujet *</label>
                    <input type="text" name="subject" required class="w-full border border-soil-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tractor-400">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1 text-field-900">Votre message *</label>
                    <textarea name="message" rows="5" required class="w-full border border-soil-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tractor-400"></textarea>
                </div>
                <button type="submit" class="w-full bg-tractor-500 hover:bg-tractor-600 text-white font-bold px-6 py-3.5 rounded-xl transition-colors shadow-lg shadow-tractor-500/25">
                    Envoyer le message
                </button>
            </form>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-soil-100 p-6">
                <h3 class="font-bold text-lg text-field-900 mb-4">Coordonnées</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 bg-tractor-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-tractor-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <span class="text-field-900">{{ $company['address'] }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 bg-tractor-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-tractor-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.27 3.81a1 1 0 01-.45 1.15l-1.85 1.11a12.05 12.05 0 006 6l1.11-1.85a1 1 0 011.15-.45l3.81 1.27a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.72 21 3 14.28 3 6V5z"/></svg>
                        </span>
                        <span class="text-field-900">{{ $company['phone'] }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 bg-tractor-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-tractor-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <span class="text-field-900">{{ $company['email'] }}</span>
                    </div>
                </div>
            </div>

            @if($company['whatsapp'])
            <div class="bg-green-500 text-white rounded-xl p-6">
                <h3 class="font-bold text-lg mb-2">Commandez directement sur WhatsApp</h3>
                <p class="text-sm text-green-50">Envoyez votre demande, nos experts vous répondent en quelques minutes.</p>
                <a href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" class="mt-4 inline-flex items-center gap-2 bg-white text-green-700 font-semibold px-5 py-2.5 rounded-lg hover:bg-green-50 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Discuter sur WhatsApp
                </a>
            </div>
            @else
            <div class="bg-tractor-500 text-white rounded-xl p-6">
                <h3 class="font-bold text-lg mb-2">Besoin d'une pièce spécifique ?</h3>
                <p class="text-sm text-tractor-100">Envoyez-nous la référence OEM ou la marque/modèle de votre tracteur. Nous vous trouvons la bonne pièce au meilleur prix.</p>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection
