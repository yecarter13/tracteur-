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

<div class="min-h-screen flex flex-col">
    <header class="bg-field-900 text-white px-4 py-3 flex items-center justify-between shrink-0">
        <span class="font-bold text-base">La Boutique du Tracteur 🚜</span>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="text-sm text-field-300 hover:text-white">Voir le site</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-field-300 hover:text-white">Déconnexion</button>
            </form>
        </div>
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

@stack('scripts')

</body>
</html>
