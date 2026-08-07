<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="format-detection" content="telephone=no">
    <title>@yield('title', 'La Boutique du Tracteur — Pièces de tracteur neuves et garanties')</title>
    <meta name="description" content="@yield('meta_description', 'La Boutique du Tracteur, votre fournisseur français de pièces de tracteur neuves et garanties à Aucamville (Toulouse) : moteur, hydraulique, embrayage, relevage, filtration. Livraison rapide partout en France.')">
    @hasSection('robots')<meta name="robots" content="@yield('robots')">@else<meta name="robots" content="index, follow">@endif
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @yield('seo_head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-field-50 text-soil-900">

    @include('partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.floating-contact')

    <div id="cart-toast" class="fixed top-4 left-1/2 -translate-x-1/2 z-50 px-6 py-4 bg-field-800 text-white text-base font-semibold rounded-xl shadow-2xl flex items-center gap-3 transition-all duration-300 opacity-0 -translate-y-4 pointer-events-none border border-tractor-400/40">
        <svg class="w-6 h-6 text-tractor-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span id="cart-toast-msg">Ajouté au panier</span>
    </div>

    <script>
    function addToCart(productId, qty, btn) {
        const toast = document.getElementById('cart-toast');
        const msg = document.getElementById('cart-toast-msg');
        btn = btn || { disabled: false, innerHTML: '' };
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 animate-spin inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>';
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({ product_id: productId, quantity: qty || 1 })
        })
        .then(r => r.json())
        .then(d => {
            document.querySelectorAll('.cart-count').forEach(el => el.textContent = d.count);
            msg.textContent = '✓ Ajouté au panier !';
            toast.classList.remove('opacity-0', '-translate-y-4', 'pointer-events-none');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-4', 'pointer-events-none');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 2500);
        })
        .catch(() => {
            msg.textContent = '✕ Erreur lors de l\'ajout';
            toast.classList.remove('opacity-0', '-translate-y-4', 'pointer-events-none');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-4', 'pointer-events-none');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 2500);
        })
        .finally(() => {
            if (btn) { btn.disabled = false; btn.innerHTML = 'Ajouter'; }
        });
    }
    </script>

    @stack('scripts')
</body>
</html>
