<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cave = Section::create([
            'name' => 'La Cave',
            'slug' => 'la-cave',
        ]);

        $produitsLocaux = Section::create([
            'name' => 'Produits Locaux',
            'slug' => 'produits-locaux',
        ]);

        $volailles = Category::create([
            'name' => 'Volaille',
            'content' => null,
            'section_id' => $produitsLocaux->id,

        ]);

        $store = Category::create([
            'name' => 'CPF Store',
            'content' => null,
            'section_id' => $produitsLocaux->id,
        ]);

        /*$poultry = Category::create([
            'name' => 'Volailles',
            'content' => null,
            'section_id' => $produitsLocaux->id,

        ]);*/

        /*$fish = Category::create([
            'name' => 'Poissons',
            'content' => null,
            'section_id' => $produitsLocaux->id,
        ]);*/

        /*$otherMeats = Category::create([
            'name' => 'Autres Viandes',
            'content' => null,
            'section_id' => $produitsLocaux->id,
        ]);*/

        /* $cellar = Category::create([
            'name' => 'La Cave',
            'content' => null,
            'section_id' => $cave->id,
        ]);*/

        $red_wine = Category::create([
            'name' => 'Vin Rouge',
            'content' => null,
            //'sub_cat' => 'type',
            'section_id' => $cave->id
        ]);

        $white_wine = Category::create([
            'name' => 'Vin Blanc',
            'content' => null,
            //'sub_cat' => 'type',
            'section_id' => $cave->id
        ]);

        /*$rosé_wine = Category::create([
            'name' => 'Vin Rosé',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);*/

        /*$champ_wine = Category::create([
            'name' => 'Champagne',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);*/

        /*$spiri_wine = Category::create([
            'name' => 'Spiritieux',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);*/

        /*$bord_wine = Category::create([
            'name' => 'Bordeaux',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);*/

        /*$bourg_wine = Category::create([
            'name' => 'Bourgogne',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);*/

        /*$prov_wine = Category::create([
            'name' => 'Provence',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);*/

        /*$pie_wine = Category::create([
            'name' => 'Piémont',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);*/

        /*$val_wine = Category::create([
            'name' => 'Vallée du Rhône',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);*/

        /*$fruit = Category::create([
            'name' => 'Fruits & Légumes',
            'content' => null,
        ]);*/

        /*$pack = Category::create([
            'name' => 'Coffrets & Paniers',
            'content' => null,
        ]);*/

        // Produits catégorie "Volaille"
        // NB: laissez les prix/quantités si OK, sinon ajustez simplement les valeurs

        Product::create([
            'name' => 'Ailes de Poulet',
            'slug' => Str::slug('Ailes de Poulet'),
            'image' => 'img/Ailes de poulet.png',
            'content' => 'Ailes de poulet fraîches, prêtes à assaisonner.',
            'price' => 2200.00,
            'quantity' => 40,
            'status' => '1',
            'category_id' => $volailles->id,
        ]);

        Product::create([
            'name' => 'Cuisse de Poulet',
            'slug' => Str::slug('Cuisse de Poulet'),
            'image' => 'img/Cuisse_de_Poulet.png',
            'content' => 'Cuisses de poulet charnues pour cuisson au four ou mijotée.',
            'price' => 2500.00,
            'quantity' => 35,
            'status' => '1',
            'category_id' => $volailles->id,
        ]);

        Product::create([
            'name' => 'Pilon de Poulet',
            'slug' => Str::slug('Pilon de Poulet'),
            'image' => 'img/Pilon de poulet.png',
            'content' => 'Pilons de poulet tendres, parfaits pour grillades.',
            'price' => 2000.00,
            'quantity' => 50,
            'status' => '1',
            'category_id' => $volailles->id,
        ]);

        Product::create([
            'name' => 'Poulet Entier',
            'slug' => Str::slug('Poulet Entier'),
            'image' => 'img/Poulet_Entier.png',
            'content' => 'Poulet entier prêt à rôtir.',
            'price' => 4800.00,
            'quantity' => 20,
            'status' => '1',
            'category_id' => $volailles->id,
        ]);

        Product::create([
            'name' => 'Plateau d’Œufs de Table',
            'slug' => Str::slug('Plateau d’Œufs de Table'),
            'image' => 'img/Plateau_d_oeuf_de_table.png',
            'content' => 'Plateau d’œufs de table de qualité.',
            'price' => 1800.00,
            'quantity' => 60,
            'status' => '1',
            'category_id' => $volailles->id,
        ]);
        // Produit catégorie "Autres Viandes" (Viande de lapin)
        Product::create([
            'name' => 'Viande de lapin',
            'slug' => Str::slug('Viande de lapin'),
            'image' => 'img/viande_de_lapin.png',
            'content' => 'Viande de lapin fraîche, tendre et savoureuse.',
            'price' => 5200.00, // ajustable
            'quantity' => 12,   // ajustable
            'status' => '1',
            'category_id' => $volailles->id, // remplacez si besoin
        ]);

        // Produits pour la catégorie "La Cave"
        Product::create([
            'name' => 'Château Bertin',
            'slug' => Str::slug('Vin Rouge'),
            'image' => 'img/Vin_Rouge.png',
            'content' => 'Vin rouge sélectionné.',
            'price' => 18000.00, // ajustable
            'quantity' => 20,    // ajustable
            'status' => '1',
            'category_id' => $red_wine->id,
        ]);

        // Produits "Vins Blancs"
        Product::create([
            'name' => 'Petit Chablis',
            'slug' => Str::slug('Vin Blanc'),
            'image' => 'img/Vin_Blanc.png',
            'content' => 'Vin blanc fruité.',
            'price' => 16000.00,
            'quantity' => 24,
            'status' => '1',
            'category_id' => $white_wine->id,
        ]);

        Product::create([
            'name' => 'Pravda',
            'slug' => Str::slug('Vin Blanc 2'),
            'image' => 'img/Vin_Blanc2.png',
            'content' => 'Vin blanc élégant.',
            'price' => 17000.00,
            'quantity' => 16,
            'status' => '1',
            'category_id' => $white_wine->id,
        ]);

        Product::create([
            'name' => 'Château Cornelin',
            'slug' => Str::slug('Vin Blanc Alt'),
            'image' => 'img/Vin-blanc.png',
            'content' => 'Variation de vin blanc.',
            'price' => 15500.00,
            'quantity' => 18,
            'status' => '1',
            'category_id' => $white_wine->id,
        ]);

        // Produits catégorie "CPF Store" 
        Product::create([
            'name' => 'Caju Caramélisé',
            'slug' => Str::slug('Caju Caramélisé'),
            'image' => 'img/Caju_caramélisé.png',
            'content' => 'Noix de cajou caramélisées croustillantes.',
            'price' => 2500.00,
            'quantity' => 30,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Caju Salé',
            'slug' => Str::slug('Caju Salé'),
            'image' => 'img/Caju_Salé.png',
            'content' => 'Noix de cajou légèrement salées.',
            'price' => 2400.00,
            'quantity' => 30,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Couscous de patate douce',
            'slug' => Str::slug('Couscous de patate douce'),
            'image' => 'img/Couscous_de_patate_douce.png',
            'content' => 'Couscous fin à base de patate douce.',
            'price' => 1800.00,
            'quantity' => 25,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Farine de maïs jaune',
            'slug' => Str::slug('Farine de maïs jaune'),
            'image' => 'img/Farine_de_maiis_jaune.png',
            'content' => 'Farine de maïs jaune pour vos recettes.',
            'price' => 1200.00,
            'quantity' => 40,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Farine de Maïs Blanc',
            'slug' => Str::slug('Farine de Maïs Blanc'),
            'image' => 'img/Farine_de_Mais_Blanc.png',
            'content' => 'Farine de maïs blanc polyvalente.',
            'price' => 1200.00,
            'quantity' => 40,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Miel Hyplis',
            'slug' => Str::slug('Miel Hyplis'),
            'image' => 'img/Miel_Hyplis.png',
            'content' => 'Miel naturel, saveur douce et florale.',
            'price' => 3500.00,
            'quantity' => 20,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Mil aklui',
            'slug' => Str::slug('Mil aklui'),
            'image' => 'img/Mil_aklui.png',
            'content' => 'Mil traditionnel prêt à cuisiner.',
            'price' => 1600.00,
            'quantity' => 35,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Noix de cajou',
            'slug' => Str::slug('Noix de cajou'),
            'image' => 'img/Noix_de_cajou.png',
            'content' => 'Cajous croquants de qualité.',
            'price' => 2300.00,
            'quantity' => 30,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Piment chachanga',
            'slug' => Str::slug('Piment chachanga'),
            'image' => 'img/Piment_chachanga.png',
            'content' => 'Piment chachanga relevé, pour épicer vos plats.',
            'price' => 900.00,
            'quantity' => 50,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Poisson Fumé',
            'slug' => Str::slug('Poisson Fumé'),
            'image' => 'img/Poisson_Fumé.png',
            'content' => 'Poisson fumé délicat.',
            'price' => 2800.00,
            'quantity' => 25,
            'status' => '1',
            'category_id' => $store->id,
        ]);

        Product::create([
            'name' => 'Yaourt Baobab',
            'slug' => Str::slug('Yaourt Baobab'),
            'image' => 'img/Yaourt_Baobab.png',
            'content' => 'Yaourt au baobab onctueux et gourmand.',
            'price' => 1500.00,
            'quantity' => 30,
            'status' => '1',
            'category_id' => $store->id,
        ]);
        /*       Product::create([
            'name' => 'Poulet Fermier',
            'slug' => Str::slug('Poulet Fermier'),
            'image' => 'img/product/1725618894-poulet-frais.webp',
            'content' => 'Poulet fermier élevé en plein air.',
            'price' => 3500.00,
            'quantity' => 20,
            'status' => '1',
            'category_id' => $poultry->id,
        ]);

        Product::create([
            'name' => 'Poulet Fermier',
            'slug' => Str::slug('Poulet Fermier'),
            'image' => 'img/product/1725618894-poulet-frais.webp',
            'content' => 'Poulet fermier élevé en plein air.',
            'price' => 3500.00,
            'quantity' => 20,
            'status' => '1',
            'category_id' => $poultry->id,
        ]);

        Product::create([
            'name' => 'Dinde de Noël',
            'slug' => Str::slug('Dinde de Noël'),
            'image' => 'img/product/1727892223-poulet-frais.webp',
            'content' => 'Dinde festive idéale pour les repas de Noël.',
            'price' => 4500.00,
            'quantity' => 10,
            'status' => '1',
            'category_id' => $poultry->id,
        ]);

        // Produits pour la catégorie "Poissons"
        Product::create([
            'name' => 'Saumon Fumé',
            'slug' => Str::slug('Saumon Fumé'),
            'image' => 'img/product/fish2.jpg',
            'content' => 'Saumon fumé délicat, parfait pour les entrées.',
            'price' => 2500.00,
            'quantity' => 30,
            'status' => '1',
            'category_id' => $fish->id,
        ]);

        Product::create([
            'name' => 'Filet de Bar',
            'slug' => Str::slug('Filet de Bar'),
            'image' => 'img/product/fish3.jpg',
            'content' => 'Filet de bar sauvage pêché en mer.',
            'price' => 3200.00,
            'quantity' => 15,
            'status' => '1',
            'category_id' => $fish->id,
        ]);

        // Produits pour la catégorie "Autres Viandes"
        Product::create([
            'name' => 'Côte de Boeuf',
            'slug' => Str::slug('Côte de Boeuf'),
            'image' => 'img/product/1725877603-canard-frais.webp',
            'content' => 'Côte de boeuf persillée, tendre et savoureuse.',
            'price' => 5500.00,
            'quantity' => 8,
            'status' => '1',
            'category_id' => $otherMeats->id,
        ]);

        // Produits pour la catégorie "Fruits & Légumes"
        Product::create([
            'name' => 'Pommes de Terre Bio',
            'slug' => Str::slug('Pommes de Terre Bio'),
            'image' => 'img/product/fruit3.jpg',
            'content' => 'Pommes de terre bio de la région.',
            'price' => 3000.00,
            'quantity' => 100,
            'status' => '1',
            'category_id' => $fruit->id,
        ]);

        Product::create([
            'name' => 'Tomates Cerises',
            'slug' => Str::slug('Tomates Cerises'),
            'image' => 'img/product/1726745048-tomate.webp',
            'content' => 'Tomates cerises bio, sucrées et juteuses.',
            'price' => 4000.00,
            'quantity' => 50,
            'status' => '1',
            'category_id' => $fruit->id,
        ]);

        // Produits pour la catégorie "La Cave" avec types et régions
        $wineCategories = [
            [
                'name' => 'Château Margaux',
                'slug' => 'chateau-margaux',
                'price' => 30000.00,
                'image' => 'img/product/1726670975-rosette-bordeau.webp',
                'type' => $red_wine->id,
                'region' => $bord_wine->id,
            ],
            [
                'name' => 'Chablis Premier Cru',
                'slug' => 'chablis-premier-cru',
                'price' => 45000.00,
                'image' => 'img/product/1726073722-vin-blanc.webp',
                'type' => $white_wine->id,
                'region' => $bourg_wine->id,
            ],
            [
                'name' => 'Côte de Provence Rosé',
                'slug' => 'cote-de-provence-rose',
                'price' => 15000.00,
                'image' => 'img/product/1727425508-les-grumes.webp',
                'type' => $rosé_wine->id,
                'region' => $prov_wine->id,
            ],
            [
                'name' => 'Dom Pérignon',
                'slug' => 'dom-perignon',
                'price' => 18000.00,
                'image' => 'img/product/1727425508-les-grumes.webp',
                'type' => $champ_wine->id,
                'region' => $val_wine->id,
            ],
            [
                'name' => 'Grappa Riserva',
                'slug' => 'grappa-riserva',
                'price' => 55000.00,
                'image' => 'img/product/1727426652-queen-of-soto.webp',
                'type' => $spiri_wine->id,
                'region' => $pie_wine->id,
            ],
        ];*/

        /*foreach ($wineCategories as $wine) {
            Product::create([
                'name' => $wine['name'],
                'slug' => Str::slug($wine['slug']),
                'image' => $wine['image'],
                'content' => 'Un excellent ' . strtolower($wine['type']) . ' de la région ' . $wine['region'] . '.',
                'price' => $wine['price'],
                'quantity' => rand(10000, 50000),
                'status' => '1',
                'type' => $wine['type'],
                'region' => $wine['region'],
                'category_id' => $cellar->id,
            ]);
        }*/
    }
}
