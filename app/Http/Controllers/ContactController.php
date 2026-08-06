<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $company = [
            'name' => SiteSetting::getValue('company_name', 'TractoPièces'),
            'email' => SiteSetting::getValue('contact_email', 'contact@tractopieces.fr'),
            'phone' => SiteSetting::getValue('contact_phone', '01 23 45 67 89'),
            'address' => SiteSetting::getValue('contact_address', '12 rue des Silos, 45100 Orléans'),
            'whatsapp' => preg_replace('/\D+/', '', SiteSetting::getValue('whatsapp_number') ?? ''),
        ];

        return view('pages.contact', compact('company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        session()->flash('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');

        return redirect()->back();
    }
}