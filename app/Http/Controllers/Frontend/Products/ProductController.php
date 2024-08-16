<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Logique pour récupérer les produits depuis la base de données
        // Actuellement, nous allons simuler des produits
        $products = [
            ['id' => 1, 'name' => 'Produit 1', 'price' => '10.00', 'image' => 'image1.jpg'],
            ['id' => 2, 'name' => 'Produit 2', 'price' => '15.00', 'image' => 'image2.jpg'],
            // Ajouter plus de produits simulés ici
        ];

        return view('products.index', ['products' => $products]);
    }
}
