<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pack;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function cartList()
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
    }

    public function index()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Panier'
        ];

        $categories = Category::where('category_id', null)->get();

        // Récupère le panier de la session
        $cart = session()->get('cart', []);

        // Calcul du prix total du panier
        $totalCartPrice = array_sum(array_column($cart['products'], 'total'));

        return view('frontend.pages.cart', compact('cart', 'totalCartPrice', 'breadcrumb', 'categories'));
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

        if ($request->pack_id) {
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
        }



        if ($product) {
            //verifie si le produit est deja dans le panier
            if (isset($cart['products'][$productId])) {
                //augmente la qté si le produit existe
                $request->quantity ? $cart['products'][$productId]['quantity'] += $request->quantity : $cart['products'][$productId]['quantity']++;
            } else {
                //ajoute le produit au panier avec une qté initiale de 1
                $cart['products'][$productId] = [
                    'quantity' => $request->quantity ?? 1,
                    'total' => $product['price'],
                    'product' => $product,
                ];
            }

            $cart['products'][$productId]['total'] = $cart['products'][$productId]['quantity'] * $product['price'];

            //sauvegarde le panier dans la session
            session()->put('cart', $cart);

            $productNumber = count($cart['products']);

            if ($request->ajax()) {
                return response()->json(['message' => 'Produit ajouté au panier !', 'productNumber' => $productNumber]);
            }

            return redirect()->route('cart')->with('success', 'Produit ajouté au panier !');
        }

        return redirect()->back()->with('error', 'Product non existant !');
    }

    public function remove(Request $request)
    {
        // return $request->all();

        $productId = decryptData($request->product_id);

        $cart = session()->get('cart', []);

        if (isset($cart['products'][$productId])) {

            unset($cart['products'][$productId]);

            session()->put('cart', $cart);

            $productNumber = count($cart['products']);

            // Calcul du prix total du panier
            $totalCartPrice = array_sum(array_column($cart['products'], 'total'));
            $productNumber = count($cart['products']);

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

        if (isset($cart['products'][$productId])) {
            //si la nouvelle qte est supérieure à 0
            if ($newQuantity > 0) {
                //mise à jour de la qte
                $cart['products'][$productId]['quantity'] = $newQuantity;
                //calcul du nouveau total
                $cart['products'][$productId]['total'] = $newQuantity * $cart['products'][$productId]['product']['price'];
            } else {
                //si la qte est egale à 0, on retire le produit du panier
                unset($cart['products'][$productId]);
            }
        }

        //mettre à jour le panier dans la session
        session()->put('cart', $cart);

        $totalCartPrice = array_sum(array_column($cart['products'], 'total'));

        return response()->json([
            'productTotal' => $cart['products'][$productId]['total'] ?? 0,
            'totalCartPrice' => $totalCartPrice
        ]);
    }

    public function couponcheck(Request $request)
    {
        $coupon = Coupon::where('name', $request->coupon_name)->where('status', '1')->first();

        if (empty($coupon)) {
            return back()->withError('Coupon not found.');
        }

        $couponPrice = $coupon->price ?? 0;
        session()->put('couponPrice', $couponPrice);

        $this->cartList();

        return back()->withSuccess('Coupon applied successfully.');
    }

    public function cartform()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Commande'
        ];

        $categories = Category::where('category_id', null)->get();

        $cartItem = session()->get('cart', []);
        //return $cartItem;
        return view('frontend.pages.cartform', compact('breadcrumb', 'categories'));
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

        $cart = session()->get('cart') ?? [];

        $totalCartPrice = array_sum(array_column($cart['products'], 'total'));

        foreach ($cart['products'] as $key => $item) {
            OrderItem::create([
                'order_no' => $invoice['order_no'],
                'product_id' => $key,
                'name' => $item['product']['name'],
                'price' => $item['product']['price'],
                'quantity' => $item['quantity'],
                //'kdvd' => $item['kdv'],
            ]);
        }

        /* Mail::send(
            'frontend.pages.mails.order',
            [
                'order_no' => $invoice['order_no'],
                'lastname' => $invoice['lastname'],
                'firstname' => $invoice['firstname'],
                'company_name' => $invoice['company_name'],
                'city' => $invoice['city'],
                'address' => $invoice['address'],
                'district' => $invoice['district'],
                'phone' => $invoice['phone'],
                'note' => $invoice['note'],
                'totalCartPrice' => $totalCartPrice,
                'cart' => $cart,
            ],
            function ($message) {

                $config = config('mail');

                $message->subject("Nouvelle commande reçue !")
                    ->from($config['from']['address'], $config['from']['name'])
                    ->to('arso@yopmail.com');
            }
        ); */

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
