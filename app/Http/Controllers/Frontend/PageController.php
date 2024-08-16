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

    public function getProducts()
    {
        //Récupération des produits à partir du fichier json
        $path = storage_path('app/data.json');
        $json = File::get($path);
        $products = json_decode($json, true);

        return $products;
    }

    public function product(Request $request, $slug = null)
    {

        $products = $this->getProducts();

        //Application des filtres
        if ($request->has('category')) {
            $category = $request->input('category');
            $products = array_filter($products, function ($product) use ($category) {
                return $product['category'] === $category;
            });
        }

        //La recherche
        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $products = array_filter($products, function ($product) use ($search) {
                return strpos(strtolower($product['name']), $search) !== false;
            });
        }


        $breadcrumb = [
            'pages' => [],
            'active' => 'Products'
        ];

        if (!empty($anaKategori) && empty($altKategori)) {
            $breadcrumb['active'] = $anaKategori->name;
        }

        if (!empty($altKategori)) {
            $breadcrumb['pages'][] = [
                'link' => route('hii' . 'product'),
                'name' => 'Viande'
            ];

            $breadcrumb['active'] = $altKategori->name;
        }


        return view('frontend.pages.products', compact('breadcrumb', 'products'));
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
        // $product = Product::whereSlug($slug)->first();
        $product = Product::where("slug", $slug)->where('status', '1')->firstOrFail();

        $products = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id) // ürünün kategorisiyle aynı olan ürünleri getir
            ->where('status', '1')
            ->limit('6')
            ->orderBy('id', 'desc')
            ->get();

        $category = Category::where('id', $product->category_id)->first();

        $breadcrumb = [
            'pages' => [],
            'active' =>  $slug
        ];

        if (!empty($category)) {
            $breadcrumb['pages'][] = [
                'link' => route('men' . 'product'),
                'name' => 'men'
            ];
        }

        return view('frontend.pages.product', compact('breadcrumb'));
    }
}
