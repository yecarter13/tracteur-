@php
    $company_name = \App\Models\SiteSetting::getValue('company_name', 'La Boutique du Tracteur');
    $contact_email = \App\Models\SiteSetting::getValue('contact_email', 'contact@laboutiquedutracteur.fr');
    $contact_phone = \App\Models\SiteSetting::getValue('contact_phone', '01 23 45 67 89');
    $contact_address = \App\Models\SiteSetting::getValue('contact_address', '77 chemin de Lespinasse, 31140 Aucamville');
    $whatsapp_phone = \App\Models\SiteSetting::getValue('whatsapp_number');
@endphp

<footer class="bg-field-950 border-t border-field-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-12">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 bg-tractor-500 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 13v6h2v2h4v-2h6v2h4v-2h2v-6a9 9 0 00-9-9 9 9 0 00-7.5 4.5L3 13zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-white tracking-tight">La Boutique du <span class="text-tractor-400">Tracteur</span></span>
                </a>
                <p class="text-field-400 text-sm leading-relaxed mb-4">
                    Spécialiste français de la pièce de tracteur neuve et garantie. Plus de 15 ans d'expertise au service des agriculteurs, concessionnaires et ateliers.
                </p>
                <a href="{{ $whatsapp_phone ? 'https://wa.me/' . preg_replace('/\D+/', '', $whatsapp_phone) : route('contact') }}" target="{{ $whatsapp_phone ? '_blank' : '_self' }}" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Commander sur WhatsApp
                </a>
            </div>

            <div class="hidden md:block">
                <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Boutique</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('shop') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Toutes les pièces</a></li>
                    <li><a href="{{ route('categories.all') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Catégories</a></li>
                    <li><a href="{{ route('shop') }}?sort=newest" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Nouveautés</a></li>
                    <li><a href="{{ route('shop') }}?sort=price_asc" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Promotions & offres</a></li>
                </ul>
            </div>

            <div class="hidden md:block">
                <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Informations</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('delivery') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Livraison & transport</a></li>
                    <li><a href="{{ route('returns') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Retours & remboursements</a></li>
                    <li><a href="{{ route('warranty') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Garantie</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Confidentialité</a></li>
                    <li><a href="{{ route('terms') }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">Conditions générales</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Contact</h3>
                <ul class="space-y-3">
                    @if($contact_address)
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-tractor-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-field-400 text-sm">{{ $contact_address }}</span>
                    </li>
                    @endif
                    @if($contact_email)
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-tractor-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $contact_email }}" class="text-field-400 hover:text-tractor-400 text-sm transition-colors duration-200">{{ $contact_email }}</a>
                    </li>
                    @endif
                    @if($contact_phone)
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-tractor-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-field-400 text-sm">{{ $contact_phone }}</span>
                    </li>
                    @endif
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-tractor-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-field-400 text-sm">Lun–Sam : 8h30 – 18h30</span>
                    </li>
                    <li class="pt-2">
                        <a href="{{ route('contact') }}" class="inline-block px-4 py-2 bg-tractor-500 hover:bg-tractor-600 text-white text-sm font-semibold rounded-lg transition-colors">Nous écrire</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-field-800 pt-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="flex flex-col items-center gap-3">
                    <span class="text-field-500 text-xs uppercase tracking-wider font-medium">Commandez simplement</span>
                    <div class="flex items-center gap-2 flex-wrap justify-center">
                        <span class="h-8 px-3 bg-white rounded-lg flex items-center justify-center text-xs font-bold text-field-800 border border-field-700">CB</span>
                        <span class="h-8 px-3 bg-white rounded-lg flex items-center justify-center text-xs font-bold text-field-800 border border-field-700">Virement</span>
                        <span class="h-8 px-3 bg-white rounded-lg flex items-center justify-center gap-1 text-xs font-bold text-field-800 border border-field-700">
                            <svg class="w-3 h-3 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp
                        </span>
                        <span class="h-8 px-3 bg-white rounded-lg flex items-center justify-center text-xs font-bold text-field-800 border border-field-700">Paiement à la livraison</span>
                    </div>
                </div>
                <p class="text-field-600 text-xs">
                    &copy; {{ date('Y') }} {{ $company_name }} — Vente de pièces de tracteur en France. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>
</footer>
