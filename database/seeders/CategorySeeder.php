<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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
        Category::truncate();

        $poultry = Category::create([
            'name' => 'Volailles',
            'content' => null,

        ]);

        $fish = Category::create([
            'name' => 'Poissons',
            'content' => null,
        ]);

        $otherMeats = Category::create([
            'name' => 'Autres Viandes',
            'content' => null,
        ]);

        $cellar = Category::create([
            'name' => 'La Cave',
            'content' => null,
        ]);

        Category::create([
            'name' => 'Vin Rouge',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Vin Blanc',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Vin Rosé',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Champagne',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Spiritieux',
            'content' => null,
            'sub_cat' => 'type',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Bordeaux',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Bourgogne',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Provence',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Piémont',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);

        Category::create([
            'name' => 'Vallée du Rhône',
            'content' => null,
            'sub_cat' => 'region',
            'category_id' => $cellar->id
        ]);

        $fruit = Category::create([
            'name' => 'Fruits & Légumes',
            'content' => null,
        ]);

        $pack = Category::create([
            'name' => 'Coffrets & Paniers',
            'content' => null,
        ]);

        $store = Category::create([
            'name' => 'CPF Store',
            'content' => null,
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
                'type' => 'Vin Rouge',
                'region' => 'Bordeaux',
            ],
            [
                'name' => 'Chablis Premier Cru',
                'slug' => 'chablis-premier-cru',
                'price' => 45000.00,
                'image' => 'img/product/1726073722-vin-blanc.webp',
                'type' => 'Vin Blanc',
                'region' => 'Bourgogne',
            ],
            [
                'name' => 'Côte de Provence Rosé',
                'slug' => 'cote-de-provence-rose',
                'price' => 15000.00,
                'image' => 'img/product/1727425508-les-grumes.webp',
                'type' => 'Vin Rosé',
                'region' => 'Provence',
            ],
            [
                'name' => 'Dom Pérignon',
                'slug' => 'dom-perignon',
                'price' => 18000.00,
                'image' => 'img/product/1727425508-les-grumes.webp',
                'type' => 'Champagne',
                'region' => 'Vallée du Rhône',
            ],
            [
                'name' => 'Grappa Riserva',
                'slug' => 'grappa-riserva',
                'price' => 55000.00,
                'image' => 'img/product/1727426652-queen-of-soto.webp',
                'type' => 'Spiritueux',
                'region' => 'Piémont',
            ],
        ];

        foreach ($wineCategories as $wine) {
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
        }
    }
}
