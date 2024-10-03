<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
