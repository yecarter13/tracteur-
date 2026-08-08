@extends('layouts.master')

@section('title', 'Garantie — La Boutique du Tracteur')

@section('meta_description', 'Garantie 24 mois sur toutes les pièces de tracteur neuves. Nos conditions de garantie : échange standard, SAV rapide, pièces garanties.')

@section('content')

<section class="bg-field-800 text-white">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl md:text-4xl font-extrabold">Garantie</h1>
        <p class="mt-2 text-field-300">Nos conditions de garantie sur les pièces de tracteur.</p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 py-12">
    <div class="space-y-6 text-soil-600 leading-relaxed">
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Durée de garantie</h2>
            <p>Toutes nos pièces neuves sont garanties <strong>24 mois</strong> pièces à compter de la date d'achat. Cette garantie couvre tout défaut de fabrication ou vice caché.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Ce qui est couvert</h2>
            <p>La garantie couvre les défauts de matériaux et de fabrication. Si une pièce s'avère défectueuse, nous procédons à l'échange standard de celle-ci. Les frais de retour sont à la charge du client ; les frais de réexpédition de la pièce de remplacement sont à notre charge.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Exclusions</h2>
            <p>Ne sont pas couverts : les dommages résultant d'un montage incorrect, d'une utilisation anormale ou non conforme aux préconisations du constructeur, d'un entretien insuffisant, ou d'une usure normale.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Procédure</h2>
            <p>En cas de panne, contactez-nous via la page Contact ou à <a href="mailto:contact@laboutiquedutracteur.fr" class="text-tractor-600 hover:text-tractor-800 underline">contact@laboutiquedutracteur.fr</a>. Nous vous guidons dans le diagnostic et, si le défaut est avéré, nous vous adressons une pièce de remplacement dans les plus brefs délais.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Pièces sur commande et spécifiques</h2>
            <p>Les pièces fabriquées sur commande ou sur mesure peuvent bénéficier de conditions de garantie différentes. Celles-ci sont précisées au moment du devis.</p>
        </div>
    </div>
</section>

@endsection
