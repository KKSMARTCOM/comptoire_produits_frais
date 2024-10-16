<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

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

    public function product(Request $request, $slug = null)
    {
        // URL'nin ilk parçasına erişebilmeyi sağlsar.
        $category = request()->segment(1) ?? null;

        // if(!empty($request->size)){
        //     $size = $request->size;
        // }else{
        //     $size = null;
        // }

        // url'deki parametre sorguları
        // /products?size=LARGE&color=Black&page=2

        // explode() fonksiyonu, bir dizeyi belirli bir ayraç veya karaktere göre parçalayan ve parçalanan parçaları bir dizi olarak döndürür
        $sizes = !empty($request->size) ? explode(',', $request->size) : null;
        $colors = !empty($request->color) ? explode(',', $request->color) : null;
        $start_price = $request->min ?? null;
        $end_price = $request->max ?? null;

        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';


        $anaKategori = null;
        $altKategori = null;
        /* if (!empty($category) && empty($slug)) {
            $anaKategori = Category::where('slug', $category)->first();
        } else if (!empty($category) && !empty($slug)) {
            $anaKategori = Category::where('slug', $category)->first();
            $altKategori = Category::where('slug', $slug)->first();
        } */

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

        // return $breadcrumb;


        /* $products = Product::where("status", "1")
            ->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
            // filtreleme
            ->where(function ($q) use ($sizes, $colors, $start_price, $end_price) {
                // where koşulu, veritabanı sorgusu içinde belirli bir sütunu belirli bir değere göre filtrelemek için kullanılır.
                // whereIn koşulu, bir sütunun birden fazla değeri ile karşılaştırmak için kullanılır. Bu, sütunun bir dizi değerle eşleştiği durumlarda kullanışlıdır.
                if (!empty($sizes)) {
                    $q->whereIn('size', $sizes);
                }
                if (!empty($colors)) {
                    $q->whereIn('color', $colors);
                }
                if (!empty($start_price) && $end_price) {
                    // $q->whereBetween('price', [$start_price, $end_price]);
                    $q->where('price', '>=', $start_price);
                    $q->where('price', '<=', $end_price);
                }
                return $q;
            })
            // with('category:id,name,slug') ile ilişkilendirilmiş kategorileri önceden yüklemiş oluyoruz
            // whereHas('category', ...) ile belirli bir kritere uyan gönderileri alıyoruz
            // whereHas ilişki tablosunda sorgu yapmada kullanılır
            ->with('category:id,name,slug')
            ->whereHas('category', function ($q) use ($category, $slug) {
                if (!empty($slug)) {
                    $q->where('slug', $slug);
                }
                return $q;
            })->orderBy($order, $sort)->paginate(21);

        if ($request->ajax()) {
            $view = view('frontend.ajax.productList', compact('products'))->render();
            return response(['data' => $view, 'paginate' => (string) $products->withQueryString()->links('vendor.pagination.custom')]);
        }

        $sizeLists = Product::where("status", "1")->groupBy('size')->pluck('size')->toArray();

        $colors = Product::where("status", "1")->groupBy('color')->pluck('color')->toArray(); */

        // ilişki kurulduğu için with kullanıldı
        // sasdece sayısını istersek withCount kullanılır
        // $categories = Category::where('status','1')->where('cat_ust', null)->withCount('items')->get();

        //$maxPrice = Product::max('price');

        return view('frontend.pages.products', compact('breadcrumb'));
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
