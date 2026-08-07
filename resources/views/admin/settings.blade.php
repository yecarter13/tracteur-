@extends('admin.layouts.app')

@section('title', 'Paramètres')

@section('content')

<div class="max-w-2xl">
    <h1 class="text-2xl font-extrabold mb-6">Paramètres du site</h1>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-white rounded-xl border border-soil-200 p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold mb-1">Nom de l'entreprise</label>
            <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name']) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Slogan</label>
            <textarea name="company_slogan" rows="2" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">{{ old('company_slogan', $settings['company_slogan']) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Email de contact</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Téléphone</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Adresse (boutique)</label>
            <input type="text" name="contact_address" value="{{ old('contact_address', $settings['contact_address']) }}" placeholder="Ex : 77 chemin de Lespinasse, 31140 Aucamville" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Numéro WhatsApp (avec indicatif, sans + ni espaces)</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Ex : 33612345678" class="w-full border border-soil-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-tractor-400">
            <p class="mt-1 text-xs text-soil-400">Les commandes de la boutique sont redirigées vers ce numéro WhatsApp.</p>
        </div>
        <button type="submit" class="bg-field-700 text-white font-bold px-6 py-3 rounded-xl hover:bg-field-600 transition-colors">
            Enregistrer
        </button>
    </form>
</div>

@endsection