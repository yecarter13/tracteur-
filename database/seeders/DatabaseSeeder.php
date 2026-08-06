<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tractopieces.fr'],
            [
                'name' => 'Administrateur',
                'password' => 'admin1234',
                'is_admin' => true,
            ]
        );

        $categories = [
            ['name' => 'Moteur', 'slug' => 'moteur', 'description' => 'Pièces moteur pour tracteurs agricoles : pistons, joints, courroies, pompes.', 'icon' => 'engine'],
            ['name' => 'Transmission', 'slug' => 'transmission', 'description' => 'Boîtes de vitesses, ponts, arbres et transmissions mécaniques.', 'icon' => 'gear'],
            ['name' => 'Hydraulique', 'slug' => 'hydraulique', 'description' => 'Pompes, distributeurs, vérins et circuits hydrauliques.', 'icon' => 'drop'],
            ['name' => 'Relevage 3 points', 'slug' => 'relevage-3-points', 'description' => 'Attelage trois points, bras de relevage et kit de fixation.', 'icon' => 'link'],
            ['name' => 'Embrayage', 'slug' => 'embrayage', 'description' => 'Kits d\'embrayage, disques et butées pour tracteurs.', 'icon' => 'clutch'],
            ['name' => 'Freinage', 'slug' => 'freinage', 'description' => 'Freins à disque, à tambour, plaquettes et cylindres.', 'icon' => 'brake'],
            ['name' => 'Pneumatiques', 'slug' => 'pneumatiques', 'description' => 'Pneus agricoles avant et arrière, chambres à air.', 'icon' => 'wheel'],
            ['name' => 'Filtration', 'slug' => 'filtration', 'description' => 'Filtres à huile, gasoil, air et hydraulique.', 'icon' => 'filter'],
            ['name' => 'Électricité & Éclairage', 'slug' => 'electricite', 'description' => 'Alternateurs, démarreurs, phares, batteries et faisceaux.', 'icon' => 'bolt'],
            ['name' => 'Cabine & Confort', 'slug' => 'cabine-confort', 'description' => 'Sièges, vitres, essuie-glaces et habillage de cabine.', 'icon' => 'seat'],
            ['name' => 'Carrosserie & Châssis', 'slug' => 'carrosserie', 'description' => 'Capots, ailes, grilles et éléments de châssis.', 'icon' => 'panel'],
            ['name' => 'Outillage & Accessoires', 'slug' => 'accessoires', 'description' => 'Outillage agricole, graisses, huiles et accessoires.', 'icon' => 'tool'],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(['slug' => $data['slug']], $data);
        }

        $cat = fn(string $slug) => Category::where('slug', $slug)->first()->id;

        $products = [
            // Moteur
            ['Kit courroie de distribution', 'moteur', 189.90, 229.90, 'John Deere', '6050, 6150, 6250', 'Kit complet courroie de distribution + galets tendeurs pour moteurs John Deere PowerTech. Garantie 24 mois.'],
            ['Pompe à huile moteur', 'moteur', 154.50, null, 'New Holland', 'TM120, TM130, TM140', 'Pompe à huile neuve, débit 80 L/min, compatible moteurs New Holland.'],
            ['Joint de culasse', 'moteur', 64.20, 79.90, 'Massey Ferguson', 'Massey Ferguson 5455, 5460', 'Joint de culasse multicouche (MLS) pour moteurs Perkins.'],
            ['Courroie d\'alternateur', 'moteur', 22.40, null, 'Case IH', 'Case IH Maxxum 110, 115', 'Courroie trapézoïdale haute adhérence, longueur 1200 mm.'],
            // Transmission
            ['Arbre de transmission 540 tr/min', 'transmission', 289.00, null, 'Claas', 'Claas Arion 400, 500', 'Arbre de prise de force 540 tr/min, 6 cannelures, cardan renforcé.'],
            ['Kit réparation boîte de vitesses', 'transmission', 459.00, 549.00, 'Fendt', 'Fendt 700, 800', 'Kit complet pignons et synchroniseurs pour boîtes Vario.'],
            ['Graisseur d\'arbre de pont', 'transmission', 18.75, null, 'Deutz-Fahr', 'Deutz-Fahr Agrotron', 'Graisseur hydraulique à tête plate pour pont arrière.'],
            // Hydraulique
            ['Pompe hydraulique à piston', 'hydraulique', 349.00, 399.00, 'Renault Agriculture', 'Ares 610, 660', 'Pompe hydraulique à pistons axiaux, débit 60 L/min, 200 bars.'],
            ['Distributeur hydraulique 2 sections', 'hydraulique', 189.00, null, 'Case IH', 'Case IH Puma 130, 140', 'Distributeur hydraulique double effet avec levier et flexible.'],
            ['Vérin de direction', 'hydraulique', 129.50, 159.00, 'John Deere', 'John Deere 6830, 6930', 'Vérin hydraulique de direction double effet, course 300 mm.'],
            ['Filtre hydraulique haute pression', 'hydraulique', 32.90, null, 'New Holland', 'New Holland T6, T7', 'Filtre hydraulique retour haute pression, filetage 1\'.'],
            // Relevage 3 points
            ['Bras de relevage 3 points cat. 2', 'relevage-3-points', 219.00, 249.00, 'Massey Ferguson', 'MF 6480, 7480', 'Bras de relevage arrière catégorie 2, longueur 640 mm.'],
            ['Attelage 3 points arrière complet', 'relevage-3-points', 549.00, null, 'Fendt', 'Fendt 900 Vario', 'Kit complet attelage 3 points : bras, rotules et axes de fixation.'],
            ['Boule d\'attelage universelle', 'relevage-3-points', 39.90, null, 'Universel', 'Toutes marques', 'Boule d\'attelage universelle Ø 50 mm avec axe.'],
            // Embrayage
            ['Kit embrayage complet', 'embrayage', 389.00, 439.00, 'John Deere', 'JD 6400, 6500, 6600', 'Kit embrayage : disque, mécanisme et butée pour boîtes mécaniques.'],
            ['Disque d\'embrayage', 'embrayage', 129.00, null, 'New Holland', 'NH TL90, TL100', 'Disque d\'embrayage Ø 330 mm avec moyeu cannelé.'],
            ['Butée d\'embrayage hydraulique', 'embrayage', 84.50, 99.90, 'Case IH', 'Case IH Magnum', 'Butée d\'embrayage hydraulique à débrayage hydraulique.'],
            // Freinage
            ['Plaquettes de frein arrière', 'freinage', 74.90, null, 'Massey Ferguson', 'MF 5600, 5700', 'Jeu de 4 plaquettes de frein arrière à disque.'],
            ['Tambour de frein avant', 'freinage', 119.00, 149.00, 'Deutz-Fahr', 'Deutz-Fahr Agrotron 620', 'Tambour de frein avant, Ø 300 mm, avec roulements.'],
            ['Kit frein complet', 'freinage', 259.00, null, 'Claas', 'Claas Axion', 'Kit frein arrière complet : plaquettes, cylindres et flexibles.'],
            // Pneumatiques
            ['Pneu arrière 16.9R34', 'pneumatiques', 890.00, null, 'Michelin', 'AgriBib 2', 'Pneu agricole radial arrière 16.9 R34, indice de charge 124A8.'],
            ['Pneu avant 480/70R24', 'pneumatiques', 690.00, null, 'Bridgestone', 'VX-Tractor', 'Pneu agricole radial avant 480/70 R24.'],
            ['Chambre à air 15.5-38', 'pneumatiques', 49.90, null, 'Universel', 'Toutes marques', 'Chambre à air pour pneu 15.5-38, valve TR218A.'],
            // Filtration
            ['Filtre à huile moteur', 'filtration', 24.50, null, 'Universel', 'Perkins, PowerTech, FPT', 'Filtre à huile vissé, hauteur 180 mm, filetage 3/4\'.'],
            ['Filtre à gasoil', 'filtration', 19.90, 24.90, 'Universel', 'Toutes marques', 'Filtre à gasoil avec séparateur d\'eau.'],
            ['Filtre à air moteur', 'filtration', 45.00, null, 'Universel', 'John Deere, New Holland', 'Filtre à air primaire + secondaire pour cabine.'],
            ['Filtre hydraulique', 'filtration', 38.00, null, 'Universel', 'Hydraulique relevage', 'Filtre hydraulique à retour, débit 100 L/min.'],
            // Électricité
            ['Alternateur 14V 120A', 'electricite', 259.00, 299.00, 'Bosch', 'John Deere 6R, 7R', 'Alternateur neuf 14V 120A avec régulateur intégré.'],
            ['Démarreur 12V', 'electricite', 329.00, null, 'Valeo', 'New Holland, Case IH', 'Démarreur 12V 4 kW, pignon 11 dents.'],
            ['Phares de travail LED', 'electricite', 59.90, 79.90, 'Universel', 'Toutes marques', 'Lot de 2 phares de travail LED 48W, montage universel.'],
            ['Batterie agricole 12V 180Ah', 'electricite', 219.00, null, 'Varta', 'Toutes marques', 'Batterie 12V 180Ah, démarrage à froid 1000A.'],
            // Cabine
            ['Siège conducteur pneumatique', 'cabine-confort', 399.00, null, 'Grammer', 'Toutes marques', 'Siège à suspension pneumatique, réglages multiples.'],
            ['Vitre latérale de cabine', 'cabine-confort', 189.00, 229.00, 'Universel', 'Toutes marques', 'Vitre latérale teintée en verre feuilleté.'],
            ['Kit essuie-glace de cabine', 'cabine-confort', 34.50, null, 'Universel', 'Toutes marques', 'Kit balai + bras d\'essuie-glace pour pare-brise de cabine.'],
            // Carrosserie
            ['Capot moteur', 'carrosserie', 459.00, 519.00, 'John Deere', 'JD 6120, 6220', 'Capot moteur en polypropylène, peinture d\'origine.'],
            ['Aile avant droite', 'carrosserie', 179.00, null, 'New Holland', 'NH T6.140', 'Aile avant en tôle galvanisée, prête à peindre.'],
            ['Grille de calandre', 'carrosserie', 89.00, null, 'Massey Ferguson', 'MF 5400', 'Grille de calandre avec emblème du constructeur.'],
            // Accessoires
            ['Huile moteur 15W40 (5L)', 'accessoires', 32.90, null, 'Total', 'Toutes marques', 'Huile moteur 15W40 toutes saisons, API CH-4.'],
            ['Graisse universelle au lithium (1kg)', 'accessoires', 12.50, null, 'Universel', 'Toutes marques', 'Graisse au lithium NLGI 2 pour graissage général.'],
            ['Trousse à outils agricole', 'accessoires', 89.00, 109.00, 'Universel', 'Toutes marques', 'Coffret de 55 outils pour l\'entretien du tracteur.'],
        ];

        foreach ($products as [$name, $catSlug, $price, $oldPrice, $brand, $compat, $desc]) {
            Product::updateOrCreate(
                ['sku' => 'TP-' . strtoupper(Str::slug($name))],
                [
                    'category_id' => $cat($catSlug),
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $desc,
                    'price' => $price,
                    'old_price' => $oldPrice,
                    'brand' => $brand,
                    'compatibility' => $compat,
                    'is_active' => true,
                    'stock_quantity' => rand(5, 60),
                    'rating' => round(4 + (rand(0, 9) / 10), 1),
                    'review_count' => rand(3, 40),
                ]
            );
        }

        SiteSetting::setValue('company_name', 'TractoPièces');
        SiteSetting::setValue('company_slogan', 'Pièces de tracteur neuves et garanties, livrées partout en France');
        SiteSetting::setValue('contact_email', 'contact@tractopieces.fr');
        SiteSetting::setValue('contact_phone', '01 23 45 67 89');
        SiteSetting::setValue('whatsapp_number', '33612345678');
    }
}
