@extends('layouts.master')

@section('title', 'Connexion — La Boutique du Tracteur')

@section('content')

<section class="max-w-md mx-auto px-4 py-20">
    <div class="bg-white rounded-2xl border border-soil-200 shadow-xl p-8">
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto bg-tractor-100 rounded-2xl flex items-center justify-center mb-3">
                <svg class="w-7 h-7 text-tractor-600" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 13v6h2v2h4v-2h6v2h4v-2h2v-6a9 9 0 00-9-9 9 9 0 00-7.5 4.5L3 13zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold">Espace administrateur</h1>
            <p class="text-sm text-soil-400 mt-1">Connectez-vous pour gérer le site</p>
        </div>

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-4">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" autofocus
                    class="w-full border border-soil-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full border border-soil-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <label class="flex items-center gap-2 text-sm text-soil-500">
                <input type="checkbox" name="remember" class="rounded border-soil-300">
                Se souvenir de moi
            </label>
            <button type="submit" class="w-full bg-field-700 text-white font-bold px-6 py-3.5 rounded-xl hover:bg-field-600 transition-colors">
                Se connecter
            </button>
        </form>
    </div>
</section>

@endsection