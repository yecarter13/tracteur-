@extends('layouts.master')

@section('title', 'À propos — TractoPièces')

@section('content')

<section class="bg-field-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <p class="text-tractor-400 font-semibold text-sm uppercase tracking-widest mb-1">Qui sommes-nous</p>
        <h1 class="text-3xl md:text-5xl font-bold text-white">TractoPièces, spécialiste français de la pièce de tracteur</h1>
        <p class="mt-4 text-lg text-field-300 max-w-2xl">Depuis plus de 15 ans, nous fournissons des pièces neuves et garanties aux agriculteurs, concessionnaires et ateliers de toute la France.</p>
    </div>
</section>

<section class="py-14 bg-field-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="bg-white rounded-xl border border-soil-100 p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-4xl font-extrabold text-tractor-500">+50 000</p>
                <p class="mt-2 text-field-500">références en stock</p>
            </div>
            <div class="bg-white rounded-xl border border-soil-100 p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-4xl font-extrabold text-tractor-500">15 ans</p>
                <p class="mt-2 text-field-500">d'expertise agricole</p>
            </div>
            <div class="bg-white rounded-xl border border-soil-100 p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <p class="text-4xl font-extrabold text-tractor-500">+20 000</p>
                <p class="mt-2 text-field-500">clients satisfaits</p>
            </div>
        </div>

        <div class="mt-12 grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl border border-soil-100 p-8">
                <h2 class="text-2xl font-bold text-field-900 mb-4">Notre métier</h2>
                <p class="text-soil-600 leading-relaxed">
                    TractoPièces distribue des pièces de tracteur neuves et garanties pour toutes les grandes marques :
                    John Deere, New Holland, Massey Ferguson, Case IH, Claas, Fendt, Deutz-Fahr, Renault Agriculture et bien d'autres.
                    Du moteur à la cabine, de l'hydraulique au relevage, nous couvrons l'ensemble des besoins de maintenance et de réparation.
                </p>
            </div>
            <div class="bg-white rounded-xl border border-soil-100 p-8">
                <h2 class="text-2xl font-bold text-field-900 mb-4">Nos engagements</h2>
                <ul class="space-y-3 text-soil-600">
                    <li class="flex gap-3"><span class="text-tractor-500 font-bold">✓</span> Pièces neuves d'origine ou de qualité équivalente certifiée</li>
                    <li class="flex gap-3"><span class="text-tractor-500 font-bold">✓</span> Garantie 24 mois sur toutes nos pièces</li>
                    <li class="flex gap-3"><span class="text-tractor-500 font-bold">✓</span> Expédition sous 24h et livraison 24/48h en France</li>
                    <li class="flex gap-3"><span class="text-tractor-500 font-bold">✓</span> Conseil expert pour identifier la bonne référence</li>
                    <li class="flex gap-3"><span class="text-tractor-500 font-bold">✓</span> Tarifs négociés pour les professionnels et concessionnaires</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
