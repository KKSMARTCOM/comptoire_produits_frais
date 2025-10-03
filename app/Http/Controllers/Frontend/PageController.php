<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pack;
use App\Models\Section;
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

        return view('frontend.pages.finish', compact('breadcrumb'));
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

    public function product(Request $request, $section = null, $category = null)
    {

        // Récupérer la section (si présente)
        $currentSection = $section ? Section::where('slug', $section)->firstOrFail() : null;

        // Récupérer la catégorie (si présente)
        $currentCategory = $category ? Category::where('slug', $category)->firstOrFail() : null;

        $types = Category::where('sub_cat', 'type')->get();
        $regions = Category::where('sub_cat', 'region')->get();

        $productCat = $request->input('productCat');
        $wineType = $request->input('wineType');
        $wineRegion = $request->input('wineRegion');

        $products = Product::query();

        // Si une section est sélectionnée
        if ($currentSection) {
            $products->whereHas('category.section', function ($q) use ($currentSection) {
                $q->where('id', $currentSection->id);
            });
        }

        // Filtre par catégorie
        if ($currentCategory) {
            $products->where('category_id', $currentCategory->id);
        }

        // Filtrer par type
        if ($request->filled('wine_type')) {
            $products->where('type', $request->wine_type);
        }


        // Filtrer par région
        if ($request->filled('wine_region')) {
            $products->where('region', $request->wine_region);
        }
        //dd($products);

        // Filtrer par prix (min_price et max_price)
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', PHP_INT_MAX);

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
            'active' => $currentSection ? $currentSection->name : 'Produits'
        ];

        //dd($products);
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


        return view('frontend.pages.products', compact('breadcrumb', 'products', 'currentCategory', 'types', 'regions', 'currentSection'));
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
                        'link' => route('sections', $category->slug),
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

    public function showPackItem(Request $request)
    {
        try {
            $packId = decryptData($request->pack_id);
            //dd($packId);
            $pack = Pack::where('id', $packId)->firstOrFail();
            //dd($pack);
            $breadcrumb = [
                'pages' => [],
                'active' => 'Coffret '
            ];

            return view('frontend.pages.pack', compact('pack', 'breadcrumb'));
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function cave()
    {
        try {
            $section = Section::where('slug', 'la-cave')->first();
            return view('frontend.pages.cave', compact('section'));
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    public function localProducts()
    {
        $products = Product::latest()->take(4)->get();
        return view('frontend.pages.local-products', compact('products'));
    }

    public function promotions()
    {
        return view('frontend.pages.promotions');
    }

    public function promotion()
    {
        return view('frontend.pages.promotion');
    }
}
