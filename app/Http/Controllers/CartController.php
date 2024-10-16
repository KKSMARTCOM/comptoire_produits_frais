<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pack;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /* public function cartList()
    {
        $cartItem = session()->get('cart') ?? [];
        $totalPrice = 0;

        foreach ($cartItem as $cart) {
            $kdvOrani = $cart['kdv'] ?? 0;
            $kdvTutar = ($cart['price'] * $cart['qty']) * ($kdvOrani / 100);
            $toplamTutar = $cart['price'] * $cart['qty'] + $kdvTutar;
            $totalPrice += $toplamTutar;
        }

        if (session()->get('couponCode') && $totalPrice != 0) {
            $coupon = Coupon::where('name', session()->get('couponCode'))->where('status', '1')->first();
            $couponPrice = $coupon->price ?? 0;
            $totalPrice -= $couponPrice;
        } else {
            $totalPrice = $totalPrice;
        }

        session()->put('totalPrice', $totalPrice);

        if (count(session()->get('cart')) == 0) {
            session()->forget('couponCode');
        }

        return $cartItem;
    } */

    public function index()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Panier'
        ];

        // Récupère le panier de la session
        $cart = session()->get('cart', []);

        // Calcul du prix total du panier
        $totalCartPrice = array_sum(array_column($cart, 'total'));

        return view('frontend.pages.cart', compact('cart', 'totalCartPrice', 'breadcrumb'));
    }

    public function add(Request $request)
    {
        //dd($request->pack_id);
        //recupere le panier depuis la session ou initialise un tableau vide
        $cart = session()->get('cart', []);

        //decrypte l'id crypté
        if ($request->product_id) {
            $productId = decryptData($request->product_id);
            $product = Product::where('id', $productId)->firstOrFail();
        }

        /* if ($request->pack_id) {
            $packId = decryptData($request->pack_id);
            $pack = Pack::with('products')->findOrFail($packId);
            if ($pack) {

                if (isset($cart['packs'][$packId])) {
                    return redirect()->back()->with('error', 'Ce coffret est déjà dans votre panier.');
                }

                $cart['packs'][$packId] = [
                    'pack' => $pack,
                    'total_price' => $pack->price,
                    'products' => $pack->products->map(function ($product) {
                        return [
                            'name' => $product->name,
                            'quantity' => $product->pivot->quantity,
                        ];
                    })->toArray(),
                ];

                session()->put('cart', $cart);

                return redirect()->route('cart')->with('success', 'Coffret ajouté au panier !');
            }
        } */

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

            return redirect()->route('cart')->with('success', 'Produit ajouté au panier !');
        }

        return redirect()->back()->with('error', 'Product non existant !');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        /* if ($request->pack_id) {
            $packId = decryptData($request->pack_id);


            if (isset($cart['packs'][$packId])) {

                unset($cart['packs'][$packId]);
            }

            session()->put('cart', $cart);

            $productNumber = count($cart['products']) + count($cart['packs']);

            $totalCartPrice = array_sum(array_column($cart['products'], 'total')) ? $totalCartPrice = array_sum(array_column($cart['products'], 'total')) + collect(session('cart')['packs'])->sum('total_price') : collect(session('cart')['packs'])->sum('total_price');

            if ($request->ajax()) {
                return response()->json(['totalCartPrice' => $totalCartPrice, 'productNumber' => $productNumber, 'message' => 'Produit supprimé du panier avec succès !']);
            }

            return redirect()->back()->with('success', 'Produit supprimé du panier avec succès !');
        } */

        $productId = decryptData($request->product_id);

        if (isset($cart[$productId])) {

            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        $productNumber = count($cart);

        // Calcul du prix total du panier
        $totalCartPrice = array_sum(array_column($cart, 'total'));

        if ($request->ajax()) {
            return response()->json(['totalCartPrice' => $totalCartPrice, 'productNumber' => $productNumber, 'message' => 'Produit supprimé du panier avec succès !']);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier avec succès !');
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

    public function couponcheck(Request $request)
    {
        $coupon = Promotion::where('codePromo', $request->codePromo)->first();

        if (empty($coupon)) {
            return back()->withErrors('Code promo non valide.');
        }

        // Vérifier si le code promo a déjà été appliqué dans cette session
        $usedCoupons = session('used_coupons', []);

        if (in_array($coupon->id, $usedCoupons)) {
            return back()->withErrors('Vous avez déjà utilisé ce code promotionnel.');
        }

        $couponPrice = $coupon->pourcentage_reduction ?? 0;

        $cartItems = session('cart', []);

        foreach ($cartItems as &$item) {
            $product = Product::find($item['product']['id']);

            //dd($product);

            if ($coupon->category_id && $product->category_id == $coupon->category_id || $coupon->products->contains($product)) {
                $item['product']['price'] = $item['product']['price'] - ($item['product']['price'] * $couponPrice / 100);
                $item['total'] = $item['quantity'] * $item['product']['price'];
                //dd($item['total']);
            }
        }

        session()->put('cart', $cartItems);

        // Marquer le code promo comme utilisé dans la session
        $usedCoupons[] = $coupon->id;
        session()->put('used_coupons', $usedCoupons);

        return back()->withSuccess('Code promotionnel appliqué avec succès.');
    }

    public function cartform(Request $request)
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Commande'
        ];

        if ($request->pack_id) {
            $packId = decryptData($request->pack_id);
            $pack = Pack::where('id', $packId)->firstOrFail();
            //dd($pack);
            if ($pack) {
                return view('frontend.pages.cartform', compact('breadcrumb', 'pack'));
            }
        }

        $cartItem = session()->get('cart', []);
        //return $cartItem;
        return view('frontend.pages.cartform', compact('breadcrumb'));
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
    } */

    public function cartSave(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'lastname' => 'required|string|min:2',
            'firstname' => 'required|string|min:2',
            'phone' => 'required|string',
            'company_name' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'note' => 'nullable|string',
        ], [
            'lastname.required' => 'Vous devez obligatoirement remplir ce champ',
            'firstname.required' => 'Vous devez obligatoirement remplir ce champ',
            'phone.required' => 'Vous devez obligatoirement remplir ce champ',
            'address.required' => 'Vous devez obligatoirement remplir ce champ',
            'city.required' => 'Vous devez obligatoirement remplir ce champ',
            'district.required' => 'Vous devez obligatoirement remplir ce champ',
        ]);

        $invoice = Order::create([
            "order_no" => $this->generateCode(),
            "country" => $request->country ?? null,
            "lastname" => $request->lastname,
            "firstname" => $request->firstname,
            "company_name" => $request->company_name ?? null,
            "address" => $request->address,
            "city" => $request->city,
            "district" => $request->district,
            "phone" => $request->phone,
            "note" => $request->note ?? null,
        ]);

        if ($request->pack_id) {
            OrderItem::create([
                'order_no' => $invoice['order_no'],
                'pack_id' => $request->pack_id,
            ]);
            return redirect()->route('finish')->with('success', 'Commande effectué !');
        }

        $cart = session()->get('cart') ?? [];

        foreach ($cart as $key => $item) {
            OrderItem::create([
                'order_no' => $invoice['order_no'],
                'product_id' => $key,
                'name' => $item['product']['name'],
                'price' => $item['product']['price'],
                'quantity' => $item['quantity'],
                //'kdvd' => $item['kdv'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('finish')->with('success', 'Commande effectué !');
    }

    function generateCode()
    {
        do {
            $orderNo = generateOTP(7);
        } while ($this->otpExists($orderNo));

        return $orderNo;
    }

    function otpExists($orderNo)
    {
        return Order::where('order_no', $orderNo)->exists();
    }
}
