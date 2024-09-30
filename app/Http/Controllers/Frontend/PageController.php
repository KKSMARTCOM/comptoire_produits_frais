<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function contact()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Contact'
        ];

        return view('frontend.pages.contact', compact('breadcrumb'));
    }

    public function about()
    {
        //$about = About::where("id", 1)->first();
        $breadcrumb = [
            'pages' => [],
            'active' => 'About'
        ];
        return view('frontend.pages.about', compact('breadcrumb'));
    }

    public function finish()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Merci'
        ];

        $categories = Category::where('category_id', null)->get();

        return view('frontend.pages.finish', compact('breadcrumb', 'categories'));
    }

    public function allProduct()
    {
        $products = Product::all();
        $categories = Category::where('category_id', null)->get();
        $types = Category::where('sub_cat', 'type')->get();
        $regions = Category::where('sub_cat', 'region')->get();

        $breadcrumb = [
            'pages' => [],
            'active' => 'Produits'
        ];

        return view('frontend.pages.products', compact('products', 'breadcrumb', 'categories', 'types', 'regions'));
    }

    public function product(Request $request, $slug = null)
    {
        $categories = Category::where('category_id', null)->get();
        $category = Category::where('slug', $slug)->firstOrFail();


        $types = Category::where('sub_cat', 'type')->get();
        $regions = Category::where('sub_cat', 'region')->get();
        $productCat = $request->input('productCat');
        $wineType = $request->input('wineType');
        $wineRegion = $request->input('wineRegion');

        $products = Product::query();

        /* if ($category) {
            $products->where('category_id', $category->id);
        } */

        // Si une catégorie est passée dans l'URL
        if ($slug && $slug !== '') {
            $products->whereHas('productCategory', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
        }


        // Filtrer par type
        if ($request->filled('wineType')) {
            $products->where('type', $wineType);
        }

        // Filtrer par région
        if ($request->filled('wineRegion')) {
            $products->where('region', $wineRegion);
        }

        // Filtrer par prix (min_price et max_price)
        if ($request->filled('minPrice') || $request->filled('maxPrice')) {
            $minPrice = $request->input('minPrice', 0);
            $maxPrice = $request->input('maxPrice', PHP_INT_MAX);

            // Appliquer les filtres de prix
            $products->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Trier les résultats
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $products->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $products->orderBy('price', 'desc');
                    break;
                case 'alpha_asc':
                    $products->orderBy('name', 'asc');
                    break;
                case 'alpha_desc':
                    $products->orderBy('name', 'desc');
                    break;
                case 'promotion':
                    $products->where('promotion', true);
                    break;
            }
        }


        // Obtenir les produits filtrés
        $products = $products->get();


        $breadcrumb = [
            'pages' => [],
            'active' => 'Produits'
        ];

        // Si la requête est une requête AJAX, renvoyer les produits filtrés au format JSON
        if ($request->ajax()) {
            $data['products'] = view('frontend.ajax.productList', ['products' => $products])->render();
            return response()->json($data);
        }

        /* if (!empty($anaKategori) && empty($altKategori)) {
            $breadcrumb['active'] = $anaKategori->name;
        }

        if (!empty($altKategori)) {
            $breadcrumb['pages'][] = [
                'link' => route('hii' . 'product'),
                'name' => 'Viande'
            ];

            $breadcrumb['active'] = $altKategori->name;
        } */


        return view('frontend.pages.products', compact('breadcrumb', 'products', 'categories', 'category', 'types', 'regions'));
    }

    public function saleproduct()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Discounted Products'
        ];

        return view('frontend.pages.products', compact('breadcrumb'));
    }

    public function productdetail($slug)
    {
        try {
            //code...
            //$product = Product::where('slug', $slug)->firstOrFail();
            $categories = Category::where('category_id', null)->get();
            $product = Product::where("slug", $slug)->firstOrFail();

            if ($product) {

                $category = Category::where('id', $product->category_id)->first();

                $productFeatures = Product::where('id', '!=', $product->id)
                    ->where('category_id', $product->category_id)
                    ->limit('6')
                    ->orderBy('id', 'desc')
                    ->get();

                $breadcrumb = [
                    'pages' => [],
                    'active' =>  $product->name
                ];

                if (!empty($category)) {
                    $breadcrumb['pages'][] = [
                        'link' => route('categories', $category->slug),
                        'name' => $category->name
                    ];
                }

                return view('frontend.pages.product', compact('breadcrumb', 'product', 'productFeatures', 'categories'));
            }
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }
}
