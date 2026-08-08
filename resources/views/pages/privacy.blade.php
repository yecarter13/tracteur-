@extends('layouts.master')

@section('title', 'Politique de confidentialité')

@section('meta_description', 'Politique de confidentialité et RGPD. Vos données personnelles sont protégées, hébergées en France et jamais revendues à des tiers.')

@section('content')

<section class="bg-field-800 text-white">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl md:text-4xl font-extrabold">Politique de confidentialité</h1>
        <p class="mt-2 text-field-300">Comment nous collectons et protégeons vos données personnelles.</p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 py-12">
    <div class="space-y-6 text-soil-600 leading-relaxed">
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Données collectées</h2>
            <p>Dans le cadre de votre commande, nous collectons votre nom, adresse de livraison, email et numéro de téléphone. Ces données sont strictement nécessaires au traitement de vos commandes et à la relation client.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Utilisation des données</h2>
            <p>Vos données sont utilisées uniquement pour : préparer et expédier vos commandes, vous informer de leur suivi, répondre à vos demandes de contact, et satisfaire nos obligations légales et comptables.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Stockage et sécurité</h2>
            <p>Les données sont hébergées sur des serveurs sécurisés en France. Elles ne sont jamais cédées ni vendues à des tiers à des fins commerciales, en dehors des transporteurs nécessaires à la livraison.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Durée de conservation</h2>
            <p>Les données relatives aux commandes sont conservées pendant la durée légale applicable (5 ans pour les documents comptables et commerciaux).</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Vos droits</h2>
            <p>Conformément au RGPD, vous disposez d'un droit d'accès, de rectification, de suppression et d'opposition sur vos données. Pour l'exercer, contactez-nous via notre page contact.</p>
        </div>
    </div>
</section>

@endsection