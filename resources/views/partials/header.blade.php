@php
    $cart = session('cart', []);
    $cartCount = array_sum($cart);
    $company_name = \App\Models\SiteSetting::getValue('company_name', 'La Boutique du Tracteur');
@endphp

<header class="sticky top-0 z-50 bg-field-900 shadow-xl border-b border-field-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 lg:h-20">

            <div class="flex items-center gap-1 sm:gap-2 shrink-0 min-w-0">
                <a href="{{ route('home') }}" class="flex items-center gap-1.5 sm:gap-2.5 group">
                    <div class="w-8 h-8 bg-tractor-500 rounded-lg hidden sm:flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 13v6h2v2h4v-2h6v2h4v-2h2v-6a9 9 0 00-9-9 9 9 0 00-7.5 4.5L3 13zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm sm:text-lg md:text-xl font-bold text-white tracking-tight whitespace-nowrap">La Boutique du <span class="text-tractor-400">Tracteur</span></span>
                </a>

                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('shop') }}" class="px-3 py-2 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200 {{ request()->routeIs('shop') ? 'text-white bg-field-800' : '' }}">Boutique</a>
                    <a href="{{ route('categories.all') }}" class="px-3 py-2 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200 {{ request()->routeIs('categories.all') ? 'text-white bg-field-800' : '' }}">Catégories</a>
                    <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200 {{ request()->routeIs('about') ? 'text-white bg-field-800' : '' }}">À propos</a>
                    <a href="{{ route('contact') }}" class="px-3 py-2 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200 {{ request()->routeIs('contact') ? 'text-white bg-field-800' : '' }}">Contact</a>
                </nav>
            </div>

            <div class="hidden md:flex items-center flex-1 max-w-md mx-4 lg:mx-10">
                <form action="{{ route('shop') }}" method="GET" class="relative w-full" autocomplete="off">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une pièce, une marque, une référence..."
                           class="w-full pl-10 pr-4 py-2 bg-field-800 border border-field-600 rounded-lg text-sm text-white placeholder-field-400 focus:outline-none focus:border-tractor-400 focus:ring-1 focus:ring-tractor-400 transition-all duration-200">
                    <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2">
                        <svg class="w-4 h-4 text-field-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="flex items-center gap-0.5 sm:gap-2">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-field-300 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200" title="Panier">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-tractor-500 rounded-full text-[10px] font-bold text-white flex items-center justify-center cart-count">{{ $cartCount }}</span>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex p-2 text-field-300 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200" title="Dashboard">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hidden sm:flex p-2 text-field-300 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200" title="Déconnexion">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                @else
                <a href="{{ route('login') }}" class="hidden sm:flex p-2 text-field-300 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200" title="Connexion">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </a>
                @endauth

                @php $waNumber = preg_replace('/\D/', '', \App\Models\SiteSetting::getValue('whatsapp_number', '33612345678')); @endphp
                <a href="https://wa.me/{{ $waNumber }}?text={{ rawurlencode('Bonjour, je souhaite commander une pièce de tracteur.') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 bg-tractor-500 hover:bg-tractor-600 text-white font-semibold px-3 py-2 rounded-lg transition-all duration-200 text-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Commander
                </a>

                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-field-300 hover:text-white hover:bg-field-800 rounded-lg transition-all duration-200" title="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="lg:hidden hidden pb-4 border-t border-field-700 mt-2 pt-4">
            <form action="{{ route('shop') }}" method="GET" class="relative mb-3" autocomplete="off">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                       class="w-full pl-9 pr-3 py-2 bg-field-800 border border-field-600 rounded-lg text-sm text-white placeholder-field-400 focus:outline-none focus:border-tractor-400">
                <button type="submit" class="absolute left-2 top-1/2 -translate-y-1/2">
                    <svg class="w-4 h-4 text-field-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
            <nav class="flex flex-col gap-1">
                <a href="{{ route('shop') }}" class="px-4 py-3 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all">Boutique</a>
                <a href="{{ route('categories.all') }}" class="px-4 py-3 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all">Catégories</a>
                <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all">À propos</a>
                <a href="{{ route('contact') }}" class="px-4 py-3 text-sm font-medium text-field-200 hover:text-white hover:bg-field-800 rounded-lg transition-all">Contact</a>
            </nav>
        </div>
    </div>
</header>

@push('scripts')
<script>
    document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endpush
