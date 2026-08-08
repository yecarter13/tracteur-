<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration — La Boutique du Tracteur')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-soil-100 text-soil-900">

<div class="min-h-screen flex">
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-60 bg-field-900 text-white flex flex-col -translate-x-full transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:z-auto">
        <div class="flex items-center justify-between px-5 py-5 border-b border-field-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <svg class="w-7 h-7 text-tractor-400" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 13v6h2v2h4v-2h6v2h4v-2h2v-6a9 9 0 00-9-9 9 9 0 00-7.5 4.5L3 13zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-bold text-lg">La Boutique du <span class="text-tractor-400">Tracteur</span> 🚜</span>
            </a>
            <button onclick="toggleSidebar()" class="lg:hidden p-1 text-field-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <nav class="flex-1 py-4 space-y-1 px-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 lg:py-2.5 rounded-lg text-sm font-medium hover:bg-field-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-field-800 text-tractor-300' : 'text-field-200' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Tableau de bord
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3.5 lg:py-2.5 rounded-lg text-sm font-medium hover:bg-field-800 transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-field-800 text-tractor-300' : 'text-field-200' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Produits
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3.5 lg:py-2.5 rounded-lg text-sm font-medium hover:bg-field-800 transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-field-800 text-tractor-300' : 'text-field-200' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Catégories
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3.5 lg:py-2.5 rounded-lg text-sm font-medium hover:bg-field-800 transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-field-800 text-tractor-300' : 'text-field-200' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Commandes
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3.5 lg:py-2.5 rounded-lg text-sm font-medium hover:bg-field-800 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-field-800 text-tractor-300' : 'text-field-200' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Paramètres
            </a>
        </nav>
        <div class="p-4 border-t border-field-800">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm text-field-300 hover:text-white py-2">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1"/></svg>
                Voir le site
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-1">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-sm text-field-300 hover:text-white w-full py-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="lg:hidden flex items-center justify-between bg-field-900 text-white px-4 py-3 shrink-0">
            <button onclick="toggleSidebar()" class="p-1 -ml-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="font-bold text-sm">La Boutique du Tracteur 🚜</span>
            <span class="w-6"></span>
        </header>

        <main class="flex-1 p-4 lg:p-8">
            @if (session('success'))
            <div class="mb-6 bg-field-50 border border-field-200 text-field-800 text-sm font-medium rounded-lg p-4">
                {{ session('success') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script>
(function() {
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sidebar-overlay');
    var open = false;

    window.toggleSidebar = function() {
        open = !open;
        if (open) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    };

    overlay.addEventListener('click', function() {
        if (open) toggleSidebar();
    });

    sidebar.addEventListener('click', function(e) {
        if (e.target.tagName === 'A' || e.target.closest('button')) {
            toggleSidebar();
        }
    });
})();
</script>

@stack('scripts')

</body>
</html>
