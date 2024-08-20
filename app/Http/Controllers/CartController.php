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
    public function cartList()
    {
        $cart = session()->get('cart') ?? [];

        /* foreach ($cart as $cartItem) {
            $vatRate = $cartItem['kdv'] ?? 0;
            $vatAmount = ($cartItem['product']['price'] * $cartItem['quantity']) * ($vatRate / 100);
            $totalAmount = $cartItem['product']['price'] * $cartItem['quantity'] + $vatAmount;
            $totalPrice += $totalAmount;
        } */

        /* if (session()->get('couponCode') && $totalPrice != 0) {
            $coupon = Coupon::where('name', session()->get('couponCode'))->where('status', '1')->first();
            $couponPrice = $coupon->price ?? 0;
            $totalPrice -= $couponPrice;
        } else {
            $totalPrice = $totalPrice;
        }*/

        //session()->put('totalPrice', $totalPrice);

        /*if (count(session()->get('cart')) == 0) {
            session()->forget('couponCode');
        } */

        return $cart;
    }

    public function index()
    {
        $breadcrumb = [
            'pages' => [],
            'active' => 'Cart'
        ];

        $cart = $this->cartList();
        $subTotal = $this->calculTotal($cart);


        //return $cartItem;
        return view('frontend.pages.cart', compact('cart', 'subTotal', 'breadcrumb'));
    }

    public function add(Request $request)
    {
        //recupere le panier depuis la session ou initialise un tableau vide
        $cart = session()->get('cart', []);
        //decrypte l'id crypté
        $productID = decryptData($request->product_id);
        //recherche le produit par son id
        $product = $this->getProductById($productID);
        //$qty = $request->qty ?? 1;
        //$size = $request->size;

        //$product = Product::find($productID);

        if ($product) {
            //verifie si le produit est deja dans le panier
            if (isset($cart[$productID])) {
                //augmente la qté si le produit existe
                $cart[$productID]['quantity']++;
            } else {
                //ajoute le produit au panier avec une qté initiale de 1
                $cart[$productID] = [
                    'quantity' => 1,
                    'product' => $product,
                ];
            }
            //sauvegarde le panier dans la session
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Produit ajouté au panier !');
        }

        return redirect()->back()->with('error', 'Product non existant !');


        /* if (array_key_exists($productID, $cartItem)) {
            $cartItem[$productID]['qty'] += $qty; // adet ekleme
        } else {
            $cartItem[$productID] = [
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'kdv' => $product->kdv,
                'size' => $size
            ];
        }

        session(['cart' => $cartItem]);

        if ($request->ajax()) {
            return response()->json(['sepetCount' => count(session()->get('cart')), 'message' => 'Product successfully added to cart!']);
        }

        return back()->withSuccess('Product successfully added to cart.'); */
    }

    public function remove(Request $request)
    {
        // return $request->all();

        $productID = decryptData($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$productID])) {
            unset($cart[$productID]);
        }

        session()->put('cart', $cart);

        /* if (count(session()->get('cart')) == 0) {
            session()->forget('couponCode');
        } */

        /* if ($request->ajax()) {
            return response()->json(['sepetCount' => count(session()->get('cart')), 'message' => 'The product has been successfully deleted from the cart!']);
        } */

        return redirect()->back()->with('success', 'Produit supprimé du panier avec succès !');
    }

    public function couponcheck(Request $request)
    {
        $coupon = Coupon::where('name', $request->coupon_name)->where('status', '1')->first();

        if (empty($coupon)) {
            return back()->withError('Coupon not found.');
        }
        $couponCode = $coupon->name ?? '';
        session()->put('couponCode', $couponCode);

        $couponPrice = $coupon->price ?? 0;
        session()->put('couponPrice', $couponPrice);

        $this->cartList();

        return back()->withSuccess('Coupon applied successfully.');
    }

    public function updateCart(Request $request)
    {
        $productId = $request->id;
        $newQuantity = $request->quantity ?? 1;
        $itemTotal = 0;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($newQuantity > 0) {
            }
        }

        /* $product = Product::find($productID);
        if (!$product) {
            return response()->json('Product not found!');
        }
        $cartItem = session('cart', []);


        if (array_key_exists($productID, $cartItem)) {
            $cartItem[$productID]['qty'] = $qty; // adet güncelleme
            if ($qty == 0 || $qty < 0) {
                unset($cartItem[$productID]);
            }
            // $itemTotal = $product->price * $qty;
            $kdvOraniItem = $product->kdv ?? 0;
            $kdvTutarItem = ($product->price * $qty) * ($kdvOraniItem / 100);
            $itemTotal = $product->price * $qty + $kdvTutarItem;
        }

        session(['cart' => $cartItem]);

        $this->cartList();

        if ($request->ajax()) {
            return response()->json(['itemTotal' => $itemTotal, 'totalPrice' => session()->get('totalPrice'), 'message' => 'Cart updated successfully']);
        } */
    }

    public function cartform()
    {
        $cartItem = $this->cartList();
        //return $cartItem;
        return view('frontend.pages.cartform', compact('cartItem'));
    }

    function generateKod()
    {
        $siparisno = generateOTP(7);
        if ($this->barcodeKodExists($siparisno)) {
            return $this->generateKod();
        }

        return $siparisno;
    }

    function barcodeKodExists($siparisno)
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
    }

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

    private function calculTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['product']['price'] * $item['quantity'];
        }

        return $total;
    }
}
