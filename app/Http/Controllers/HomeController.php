<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $slides = [
            (object) [
                'title' => 'Toutes vos pièces de tracteur',
                'subtitle' => 'Des milliers de pièces neuves et garanties pour les plus grandes marques. Livraison rapide partout en France.',
                'cta_primary' => 'Voir le catalogue',
                'cta_secondary' => 'Rechercher une pièce',
                'tag' => 'Pièces neuves garanties',
                'image' => asset('hero1.jpg'),
            ],
            (object) [
                'title' => 'Moteur, hydraulique, relevage & plus',
                'subtitle' => 'Plus de 50 000 références en stock pour John Deere, New Holland, Massey Ferguson, Case IH, Claas et bien d\'autres.',
                'cta_primary' => 'Explorer les catégories',
                'cta_secondary' => 'Contactez-nous',
                'tag' => 'Grande disponibilité',
                'image' => asset('hero2.jpg'),
            ],
        ];

        $categories = Category::withCount('products')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn($c) => $c->products_count > 0)
            ->take(12);

        $catImages = $categories->mapWithKeys(fn($c) => [$c->slug => $c->image])->all();
        $fallback = asset('hero1.jpg');

        $products = Product::where('is_active', true)
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        $randomProducts = Product::where('is_active', true)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $testimonials = [
            (object) ['name' => 'Bernard Lemaire', 'city' => 'Rouen', 'rating' => 5, 'text' => 'Pièce de relevage introuvable chez le concessionnaire, livrée en 48h. Impeccable !'],
            (object) ['name' => 'Cyril Moreau', 'city' => 'Angers', 'rating' => 5, 'text' => 'Le kit embrayage correspondait parfaitement à mon John Deere. Bravo au service client.'],
            (object) ['name' => 'Patrick Dubois', 'city' => 'Toulouse', 'rating' => 4, 'text' => 'Bon rapport qualité/prix, expédition rapide. Je recommande pour les pièces hydrauliques.'],
            (object) ['name' => 'Céline Garnier', 'city' => 'Reims', 'rating' => 5, 'text' => 'Commandé un dimanche, reçu mardi. Pneus au bon prix par rapport au reste du marché.'],
            (object) ['name' => 'Antoine Richard', 'city' => 'Lyon', 'rating' => 5, 'text' => 'Service client au top pour trouver une pièce rare d\'un vieux Renault Agriculture.'],
            (object) ['name' => 'Philippe Martin', 'city' => 'Clermont-Ferrand', 'rating' => 4, 'text' => 'Alternateur livré en 24h, montage facile. Site simple et efficace.'],
        ];

        $company = [
            'name' => SiteSetting::getValue('company_name', 'La Boutique du Tracteur'),
            'phone' => SiteSetting::getValue('contact_phone', '01 23 45 67 89'),
        ];

        return view('pages.home', compact('slides', 'categories', 'products', 'randomProducts', 'testimonials', 'company', 'catImages', 'fallback'));
    }
}