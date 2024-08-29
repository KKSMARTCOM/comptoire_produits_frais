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
        return view('frontend.pages.finish', compact('breadcrumb'));
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

        // Appliquer les filtres
        if ($request->has('category') && $request->category) {
            $products = array_filter($products, function ($product) use ($request) {
                return $product['category'] == $request->category;
            });
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = (int)$request->min_price;
            $maxPrice = (int)$request->max_price;
            $products = array_filter($products, function ($product) use ($minPrice, $maxPrice) {
                return $product['price'] >= $minPrice && $product['price'] <= $maxPrice;
            });
        }

        if ($request->has('sort') && $request->sort) {
            if ($request->sort === 'price_asc') {
                usort($products, function ($a, $b) {
                    return $a['price'] - $b['price'];
                });
            } elseif ($request->sort === 'price_desc') {
                usort($products, function ($a, $b) {
                    return $b['price'] - $a['price'];
                });
            } elseif ($request->sort === 'promotion') {
                usort($products, function ($a, $b) {
                    return ($b['promotion'] ? 1 : 0) - ($a['promotion'] ? 1 : 0);
                });
            }
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
        $products = $this->getProducts();

        $productFiltered = array_filter($products, function ($item) use ($slug) {
            return $item['id'] === intval($slug);
        });

        $product = array_values($productFiltered);


        //$product = Product::where("slug", $slug)->where('status', '1')->firstOrFail();

        /* $products = Product::where('id', '!=', $product->id)
        ->where('category_id', $product->category_id) // ürünün kategorisiyle aynı olan ürünleri getir
        ->where('status', '1')
        ->limit('6')
        ->orderBy('id', 'desc')
        ->get(); */


        $category = $product[0]['category'];

        $productFeatures = array_filter($products, function ($item) use ($category) {
            return $item['category'] == $category;
        });

        $breadcrumb = [
            'pages' => [],
            'active' =>  $slug
        ];

        if (!empty($category)) {
            $breadcrumb['pages'][] = [
                'link' => route('men' . 'product'),
                'name' => $category
            ];
        }

        return view('frontend.pages.product', compact('breadcrumb', 'product', 'products', 'productFeatures'));
    }
}
