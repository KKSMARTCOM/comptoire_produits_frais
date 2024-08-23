<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CartController extends Controller
{

    public function index()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Pannier'
        ];

        // Récupère le panier de la session
        $cart = session()->get('cart', []);

        // Calcul du prix total du panier
        $totalCartPrice = array_sum(array_column($cart, 'total'));

        return view('frontend.pages.cart', compact('cart', 'totalCartPrice', 'breadcrumb'));
    }

    public function add(Request $request)
    {
        //dd($request->quantity);
        //recupere le panier depuis la session ou initialise un tableau vide
        $cart = session()->get('cart', []);
        //decrypte l'id crypté
        $productId = decryptData($request->product_id);
        //recherche le produit par son id
        $product = $this->getProductById($productId);

        if ($product) {
            //verifie si le produit est deja dans le panier
            if (isset($cart[$productId])) {
                //augmente la qté si le produit existe
                $request->quantity ? $cart[$productId]['quantity'] += $request->quantity : $cart[$productId]['quantity']++;
            } else {
                //ajoute le produit au panier avec une qté initiale de 1
                $cart[$productId] = [
                    'quantity' => $request->quantity ?? 1,
                    'total' => $product['price'],
                    'product' => $product,
                ];
            }

            $cart[$productId]['total'] = $cart[$productId]['quantity'] * $product['price'];

            //sauvegarde le panier dans la session
            session()->put('cart', $cart);

            $productNumber = count($cart);

            if ($request->ajax()) {
                return response()->json(['message' => 'Produit ajouté au panier !', 'productNumber' => $productNumber]);
            }

            return redirect()->back()->with('success', 'Produit ajouté au panier !');
        }

        return redirect()->back()->with('error', 'Product non existant !');
    }

    public function remove(Request $request)
    {
        // return $request->all();

        $productId = decryptData($request->product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {

            unset($cart[$productId]);

            session()->put('cart', $cart);

            $productNumber = count($cart);

            // Calcul du prix total du panier
            $totalCartPrice = array_sum(array_column($cart, 'total'));
            $productNumber = count($cart);

            if ($request->ajax()) {
                return response()->json(['totalCartPrice' => $totalCartPrice, 'productNumber' => $productNumber, 'message' => 'Produit supprimé du panier avec succès !']);
            }

            return redirect()->back()->with('success', 'Produit supprimé du panier avec succès !');
        }
    }

    public function updateCart(Request $request)
    {
        $productId = $request->product_id;

        $newQuantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            //si la nouvelle qte est supérieure à 0
            if ($newQuantity > 0) {
                //mise à jour de la qte
                $cart[$productId]['quantity'] = $newQuantity;
                //calcul du nouveau total
                $cart[$productId]['total'] = $newQuantity * $cart[$productId]['product']['price'];
            } else {
                //si la qte est egale à 0, on retire le produit du panier
                unset($cart[$productId]);
            }
        }

        //mettre à jour le panier dans la session
        session()->put('cart', $cart);

        $totalCartPrice = array_sum(array_column($cart, 'total'));

        return response()->json([
            'productTotal' => $cart[$productId]['total'] ?? 0,
            'totalCartPrice' => $totalCartPrice
        ]);
    }

    /* public function couponcheck(Request $request)
    {
        $coupon = Coupon::where('name', $request->coupon_name)->where('status', '1')->first();

        if (empty($coupon)) {
            return back()->withError('Coupon not found.');
        }

        $couponPrice = $coupon->price ?? 0;
        session()->put('couponPrice', $couponPrice);

        $this->cartList();

        return back()->withSuccess('Coupon applied successfully.');
    } */

    public function cartform()
    {
        $cartItem = session()->get('cart', []);
        //return $cartItem;
        return view('frontend.pages.cartform', compact('cartItem'));
    }

    /* public function generateKod()
    {
        $siparisno = generateOTP(7);
        if ($this->barcodeKodExists($siparisno)) {
            return $this->generateKod();
        }

        return $siparisno;
    }

    public function barcodeKodExists($siparisno)
    {
        return Invoice::where('order_no', $siparisno)->exists();
    }

    public function cartSave(Request $request)
    {
        // return $request->all();

        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'company_name' => 'nullable|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'zip_code' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $invoce = Invoice::create([
            "user_id" => auth()->user()->id ?? null,
            "order_no" => $this->generateKod(),
            "country" => $request->country,
            "name" => $request->name,
            "company_name" => $request->company_name ?? null,
            "address" => $request->address ?? null,
            "city" => $request->city ?? null,
            "district" => $request->district ?? null,
            "zip_code" => $request->zip_code ?? null,
            "email" => $request->email ?? null,
            "phone" => $request->phone ?? null,
            "note" => $request->note ?? null,
        ]);

        $cart = session()->get('cart') ?? [];
        foreach ($cart as $key => $item) {
            Order::create([
                'order_no' => $invoce->order_no,
                'product_id' => $key,
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'kdvd' => $item['kdv'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('index')->withSuccess('Shopping Completed Successfully.');
    } */

    private function getProductById($productId)
    {
        $path = storage_path('app/data.json');
        $json = File::get($path);
        $products = json_decode($json, true);

        foreach ($products as $product) {
            if ($product['id'] == $productId) {
                return $product;
            }
        }

        return null;
    }
}
