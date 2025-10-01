<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Jean Dupont',
                'image' => 'img/testimonials/jean.jpg',
                'status' => true,
                'description' => 'Une expérience client exceptionnelle ! La sélection de vins est impressionnante et l’accueil toujours chaleureux.',
            ],
            [
                'name' => 'Sophie Martin',
                'image' => 'img/testimonials/sophie.jpg',
                'status' => true,
                'description' => 'Des produits frais et de grande qualité. J’y trouve toujours de quoi préparer mes repas avec plaisir.',
            ],
            [
                'name' => 'Marc Lefebvre',
                'image' => 'img/testimonials/marc.jpg',
                'status' => true,
                'description' => 'Le rayon cave est incroyable, j’ai découvert des vins rares et les conseils sont vraiment professionnels.',
            ],
            [
                'name' => 'Claire Dubois',
                'image' => 'img/testimonials/claire.jpg',
                'status' => true,
                'description' => 'Un supermarché qui allie modernité et authenticité. Je recommande vivement pour les amoureux du bon goût.',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
