<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'company_name' => SiteSetting::getValue('company_name'),
            'company_slogan' => SiteSetting::getValue('company_slogan'),
            'contact_email' => SiteSetting::getValue('contact_email'),
            'contact_phone' => SiteSetting::getValue('contact_phone'),
            'whatsapp_number' => SiteSetting::getValue('whatsapp_number'),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_slogan' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:255',
        ]);

        foreach (['company_name', 'company_slogan', 'contact_email', 'contact_phone', 'whatsapp_number'] as $key) {
            SiteSetting::setValue($key, $request->input($key));
        }

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres enregistrés.');
    }
}