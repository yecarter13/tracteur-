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
            ['email' => 'admin@laboutiquedutracteur.fr'],
            [
                'name' => 'Administrateur',
                'password' => 'admin1234',
                'is_admin' => true,
            ]
        );

        Product::query()->delete();
        Category::query()->delete();

        $categories = [
            ['name' => 'Pneus', 'slug' => 'pneus', 'description' => 'Pneus agricoles avant et arrière, chambres à air pour tracteurs.', 'image' => 'img/categories/pneu.jpg', 'sort_order' => 1],
            ['name' => 'Capots', 'slug' => 'capots', 'description' => 'Capots moteur, ailes et éléments de carrosserie.', 'image' => 'img/categories/capot.jpg', 'sort_order' => 2],
            ['name' => 'Moteurs', 'slug' => 'moteurs', 'description' => 'Pièces moteur : courroies, pompes, joints, blocs moteurs.', 'image' => 'img/categories/moteurs.jpg', 'sort_order' => 3],
            ['name' => 'Vilebrequin', 'slug' => 'vilebrequin', 'description' => 'Vilebrequins et pièces internes du moteur.', 'image' => 'img/categories/vilebrequin.jpg', 'sort_order' => 4],
            ['name' => 'Boîte de vitesses', 'slug' => 'boite-de-vitesses', 'description' => 'Boîtes de vitesses, embrayages, arbres et synchroniseurs.', 'image' => 'img/categories/boite-de-vitesse.jpg', 'sort_order' => 5],
            ['name' => 'Pont avant, pont arrière, différentiel', 'slug' => 'ponts-differentiel', 'description' => 'Ponts avant, ponts arrière et différentiels pour tracteurs.', 'image' => 'img/categories/pont.jpg', 'sort_order' => 6],
            ['name' => 'Système hydraulique', 'slug' => 'systeme-hydraulique', 'description' => 'Pompes, distributeurs, vérins et filtres hydrauliques.', 'image' => 'img/categories/systeme-hydraulique.jpg', 'sort_order' => 7],
            ['name' => 'Turbo et système d\'injection', 'slug' => 'turbo-injection', 'description' => 'Turbos, pompes d\'injection et injecteurs.', 'image' => 'img/categories/turbo.jpg', 'sort_order' => 8],
            ['name' => 'Faisceau électrique et calculateur', 'slug' => 'faisceau-electrique-calculateur', 'description' => 'Faisceaux électriques, calculateurs, alternateurs et démarreurs.', 'image' => 'img/categories/faisceau.jpg', 'sort_order' => 9],
            ['name' => 'Direction assistée hydraulique', 'slug' => 'direction-assistee', 'description' => 'Direction assistée : pompes, vérins de direction et colonnes.', 'image' => 'img/categories/direction-assiste.jpg', 'sort_order' => 10],
            ['name' => 'Autres', 'slug' => 'autres', 'description' => 'Autres pièces de tracteur : filtration, freinage, accessoires.', 'image' => 'img/categories/systeme-hydraulique.jpg', 'sort_order' => 11],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }

        $cat = fn(string $slug) => Category::where('slug', $slug)->first()->id;

        $products = [
            // Pneus
            ['Pneu arrière 16.9R34', 'pneus', 890.00, null, 'Michelin', 'AgriBib 2', 'Pneu agricole radial arrière 16.9 R34, indice de charge 124A8.'],
            ['Pneu avant 480/70R24', 'pneus', 690.00, null, 'Bridgestone', 'VX-Tractor', 'Pneu agricole radial avant 480/70 R24.'],
            ['Chambre à air 15.5-38', 'pneus', 49.90, null, 'Universel', 'Toutes marques', 'Chambre à air pour pneu 15.5-38, valve TR218A.'],
            ['Pneu arrière 18.4R38', 'pneus', 995.00, null, 'Michelin', 'AgriBib', 'Pneu agricole radial arrière 18.4 R38, indice de charge 131A8.'],
            ['Pneu avant 12.4R24', 'pneus', 415.00, 465.00, 'Bridgestone', 'VX-Tractor', 'Pneu agricole radial avant 12.4 R24.'],
            // Capots
            ['Capot moteur', 'capots', 459.00, 519.00, 'John Deere', 'JD 6120, 6220', 'Capot moteur en polypropylène, peinture d\'origine.'],
            ['Aile avant droite', 'capots', 179.00, null, 'New Holland', 'NH T6.140', 'Aile avant en tôle galvanisée, prête à peindre.'],
            ['Grille de calandre', 'capots', 89.00, null, 'Massey Ferguson', 'MF 5400', 'Grille de calandre avec emblème du constructeur.'],
            ['Capot latéral gauche', 'capots', 389.00, null, 'John Deere', 'JD 6400, 6500', 'Capot latéral moteur en ABS, peinture d\'origine.'],
            ['Toit de cabine', 'capots', 649.00, null, 'Claas', 'Claas Arion', 'Toit de cabine en polycarbonate avec feu antivert.'],
            // Moteurs
            ['Kit courroie de distribution', 'moteurs', 189.90, 229.90, 'John Deere', '6050, 6150, 6250', 'Kit complet courroie de distribution + galets tendeurs pour moteurs John Deere PowerTech. Garantie 24 mois.'],
            ['Pompe à huile moteur', 'moteurs', 154.50, null, 'New Holland', 'TM120, TM130, TM140', 'Pompe à huile neuve, débit 80 L/min, compatible moteurs New Holland.'],
            ['Joint de culasse', 'moteurs', 64.20, 79.90, 'Massey Ferguson', 'Massey Ferguson 5455, 5460', 'Joint de culasse multicouche (MLS) pour moteurs Perkins.'],
            ['Courroie d\'alternateur', 'moteurs', 22.40, null, 'Case IH', 'Case IH Maxxum 110, 115', 'Courroie trapézoïdale haute adhérence, longueur 1200 mm.'],
            ['Kit joints moteur complet', 'moteurs', 129.00, 149.00, 'Universel', 'Perkins, PowerTech', 'Kit complet de joints moteur : culasse, collecteurs, carter.'],
            ['Piston et jeu de segments', 'moteurs', 89.00, null, 'Universel', 'Perkins 1000', 'Kit piston alésage 100 mm avec segments et axe.'],
            // Vilebrequin
            ['Vilebrequin moteur', 'vilebrequin', 549.00, null, 'John Deere', 'JD 6400, 6500', 'Vilebrequin forgé avec coussinets, équilibré d\'origine.'],
            ['Kit coussinets de vilebrequin', 'vilebrequin', 79.50, 95.00, 'Universel', 'Perkins, FPT', 'Jeu de coussinets de bielles et de paliers pour vilebrequin.'],
            ['Volant moteur', 'vilebrequin', 239.00, null, 'New Holland', 'NH TM120', 'Volant moteur avec couronne de démarrage 130 dents.'],
            // Boîte de vitesses
            ['Arbre de transmission 540 tr/min', 'boite-de-vitesses', 289.00, null, 'Claas', 'Claas Arion 400, 500', 'Arbre de prise de force 540 tr/min, 6 cannelures, cardan renforcé.'],
            ['Kit réparation boîte de vitesses', 'boite-de-vitesses', 459.00, 549.00, 'Fendt', 'Fendt 700, 800', 'Kit complet pignons et synchroniseurs pour boîtes Vario.'],
            ['Kit embrayage complet', 'boite-de-vitesses', 389.00, 439.00, 'John Deere', 'JD 6400, 6500, 6600', 'Kit embrayage : disque, mécanisme et butée pour boîtes mécaniques.'],
            ['Disque d\'embrayage', 'boite-de-vitesses', 129.00, null, 'New Holland', 'NH TL90, TL100', 'Disque d\'embrayage Ø 330 mm avec moyeu cannelé.'],
            ['Butée d\'embrayage hydraulique', 'boite-de-vitesses', 84.50, 99.90, 'Case IH', 'Case IH Magnum', 'Butée d\'embrayage hydraulique à débrayage hydraulique.'],
            ['Synchroniseur de boîte 3e-4e', 'boite-de-vitesses', 199.00, null, 'Renault Agriculture', 'Ares 610', 'Kit synchroniseur avec moyeu, baladeur et bagues.'],
            // Ponts
            ['Graisseur d\'arbre de pont', 'ponts-differentiel', 18.75, null, 'Deutz-Fahr', 'Deutz-Fahr Agrotron', 'Graisseur hydraulique à tête plate pour pont arrière.'],
            ['Carter de pont arrière', 'ponts-differentiel', 579.00, null, 'John Deere', 'JD 6830, 6930', 'Carter de pont arrière en fonte, avec bouchons de vidange.'],
            ['Différentiel arrière complet', 'ponts-differentiel', 890.00, 990.00, 'New Holland', 'NH T6.140', 'Différentiel arrière complet avec satellites et planétaires.'],
            ['Bras de relevage 3 points', 'ponts-differentiel', 219.00, 249.00, 'Massey Ferguson', 'MF 6480, 7480', 'Bras de relevage arrière catégorie 2, longueur 640 mm.'],
            // Système hydraulique
            ['Pompe hydraulique à piston', 'systeme-hydraulique', 349.00, 399.00, 'Renault Agriculture', 'Ares 610, 660', 'Pompe hydraulique à pistons axiaux, débit 60 L/min, 200 bars.'],
            ['Distributeur hydraulique 2 sections', 'systeme-hydraulique', 189.00, null, 'Case IH', 'Case IH Puma 130, 140', 'Distributeur hydraulique double effet avec levier et flexible.'],
            ['Filtre hydraulique haute pression', 'systeme-hydraulique', 32.90, null, 'New Holland', 'New Holland T6, T7', 'Filtre hydraulique retour haute pression, filetage 1\'.'],
            ['Filtre hydraulique', 'systeme-hydraulique', 38.00, null, 'Universel', 'Hydraulique relevage', 'Filtre hydraulique à retour, débit 100 L/min.'],
            ['Vérin de relevage arrière', 'systeme-hydraulique', 259.00, null, 'John Deere', 'JD 6210, 6310', 'Vérin de relevage arrière double effet, course 450 mm.'],
            ['Flexible hydraulique universel', 'systeme-hydraulique', 24.90, 29.90, 'Universel', 'Toutes marques', 'Flexible hydraulique 1/2\' avec raccords JIC, longueur 1 m.'],
            // Turbo et injection
            ['Turbo compresseur', 'turbo-injection', 629.00, 699.00, 'Garrett', 'John Deere PowerTech', 'Turbo compresseur neuf avec actionneur, compatible moteurs PowerTech.'],
            ['Pompe d\'injection', 'turbo-injection', 749.00, null, 'Bosch', 'New Holland, Case IH', 'Pompe d\'injection diesel rotative Bosch, 6 sorties.'],
            ['Injecteur diesel', 'turbo-injection', 89.00, null, 'Bosch', 'Universel', 'Injecteur diesel avec gicleur 4 trous, étalonné d\'usine.'],
            ['Kit turbo et admission', 'turbo-injection', 749.00, 849.00, 'Garrett', 'Case IH Maxxum', 'Kit complet turbo : turbine, collecteur et flexibles d\'admission.'],
            // Faisceau électrique et calculateur
            ['Faisceau électrique cabine', 'faisceau-electrique-calculateur', 349.00, null, 'Universel', 'Toutes marques', 'Faisceau électrique de cabine complet avec connecteurs d\'origine.'],
            ['Calculateur moteur (ECU)', 'faisceau-electrique-calculateur', 499.00, 549.00, 'Bosch', 'John Deere, New Holland', 'Calculateur moteur reprogrammé, plug and play, avec garantie 12 mois.'],
            ['Alternateur 14V 120A', 'faisceau-electrique-calculateur', 259.00, 299.00, 'Bosch', 'John Deere 6R, 7R', 'Alternateur neuf 14V 120A avec régulateur intégré.'],
            ['Démarreur 12V', 'faisceau-electrique-calculateur', 329.00, null, 'Valeo', 'New Holland, Case IH', 'Démarreur 12V 4 kW, pignon 11 dents.'],
            ['Batterie agricole 12V 180Ah', 'faisceau-electrique-calculateur', 219.00, null, 'Varta', 'Toutes marques', 'Batterie 12V 180Ah, démarrage à froid 1000A.'],
            // Direction assistée
            ['Pompe de direction assistée', 'direction-assistee', 289.00, null, 'ZF', 'John Deere, New Holland', 'Pompe de direction assistée hydraulique, débit 20 L/min.'],
            ['Vérin de direction', 'direction-assistee', 129.50, 159.00, 'John Deere', 'John Deere 6830, 6930', 'Vérin hydraulique de direction double effet, course 300 mm.'],
            ['Colonne de direction', 'direction-assistee', 259.00, null, 'New Holland', 'NH T6', 'Colonne de direction réglable avec cardan et blocage.'],
            ['Flexible de direction assistée', 'direction-assistee', 34.90, null, 'Universel', 'Toutes marques', 'Flexible basse pression de direction assistée avec raccords.'],
            // Autres
            ['Filtre à huile moteur', 'autres', 24.50, null, 'Universel', 'Perkins, PowerTech, FPT', 'Filtre à huile vissé, hauteur 180 mm, filetage 3/4\'.'],
            ['Filtre à gasoil', 'autres', 19.90, 24.90, 'Universel', 'Toutes marques', 'Filtre à gasoil avec séparateur d\'eau.'],
            ['Filtre à air moteur', 'autres', 45.00, null, 'Universel', 'John Deere, New Holland', 'Filtre à air primaire + secondaire pour cabine.'],
            ['Plaquettes de frein arrière', 'autres', 74.90, null, 'Massey Ferguson', 'MF 5600, 5700', 'Jeu de 4 plaquettes de frein arrière à disque.'],
            ['Tambour de frein avant', 'autres', 119.00, 149.00, 'Deutz-Fahr', 'Deutz-Fahr Agrotron 620', 'Tambour de frein avant, Ø 300 mm, avec roulements.'],
            ['Siège conducteur pneumatique', 'autres', 399.00, null, 'Grammer', 'Toutes marques', 'Siège à suspension pneumatique, réglages multiples.'],
            ['Vitre latérale de cabine', 'autres', 189.00, 229.00, 'Universel', 'Toutes marques', 'Vitre latérale teintée en verre feuilleté.'],
            ['Kit essuie-glace de cabine', 'autres', 34.50, null, 'Universel', 'Toutes marques', 'Kit balai + bras d\'essuie-glace pour pare-brise de cabine.'],
            ['Attelage 3 points arrière complet', 'autres', 549.00, null, 'Fendt', 'Fendt 900 Vario', 'Kit complet attelage 3 points : bras, rotules et axes de fixation.'],
            ['Boule d\'attelage universelle', 'autres', 39.90, null, 'Universel', 'Toutes marques', 'Boule d\'attelage universelle Ø 50 mm avec axe.'],
            ['Huile moteur 15W40 (5L)', 'autres', 32.90, null, 'Total', 'Toutes marques', 'Huile moteur 15W40 toutes saisons, API CH-4.'],
            ['Graisse universelle au lithium (1kg)', 'autres', 12.50, null, 'Universel', 'Toutes marques', 'Graisse au lithium NLGI 2 pour graissage général.'],
            ['Trousse à outils agricole', 'autres', 89.00, 109.00, 'Universel', 'Toutes marques', 'Coffret de 55 outils pour l\'entretien du tracteur.'],
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

        SiteSetting::setValue('company_name', 'La Boutique du Tracteur');
        SiteSetting::setValue('company_slogan', 'Pièces de tracteur neuves et garanties, livrées partout en France');
        SiteSetting::setValue('contact_email', 'contact@laboutiquedutracteur.fr');
        SiteSetting::setValue('contact_phone', '+33 7 56 87 42 97');
        SiteSetting::setValue('contact_address', '77 chemin de Lespinasse, 31140 Aucamville, Haute-Garonne (près de Toulouse)');
        SiteSetting::setValue('whatsapp_number', '33756874297');
    }
}
