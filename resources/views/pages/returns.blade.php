@extends('layouts.master')

@section('title', 'Retours & échanges')

@section('content')

<section class="bg-field-800 text-white">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-3xl md:text-4xl font-extrabold">Retours &amp; échanges</h1>
        <p class="mt-2 text-field-300">Vos droits en matière de rétractation et d'échange.</p>
    </div>
</section>

<section class="max-w-4xl mx-auto px-4 py-12">
    <div class="space-y-6 text-soil-600 leading-relaxed">
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Droit de rétractation</h2>
            <p>Conformément à la législation en vigueur, vous disposez d'un délai de 14 jours à compter de la réception de votre commande pour retourner un article non monté, dans son emballage d'origine, et obtenir un remboursement ou un échange.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Produit non conforme ou endommagé</h2>
            <p>Si une pièce reçue est non conforme, défectueuse ou endommagée lors du transport, contactez-nous sous 7 jours après réception. Nous organisons à nos frais le retour et vous expédions une pièce conforme, ou vous remboursons intégralement.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Pièces montées ou utilisées</h2>
            <p>Les pièces montées, ou qui présentent des traces d'utilisation, ne peuvent être ni reprises ni échangées. Il est recommandé de valider la compatibilité avant le montage.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-soil-900 mb-2">Comment procéder ?</h2>
            <p>Pour retourner un article, contactez notre service client afin d'obtenir un numéro de retour (RMA) et les instructions d'expédition. Les retours sont à adresser à notre dépôt après accord.</p>
        </div>
    </div>
</section>

@endsection