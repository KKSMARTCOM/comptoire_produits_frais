<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::withCount('orderItems')->paginate(20);
        //dd($orders);
        return view('backend.pages.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::where('id', $id)->with('orderItems')->firstOrFail();
        //dd($order);
        return view('backend.pages.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $order = Order::where('id', $request->id)->firstOrFail();
        OrderItem::where('order_no', $order->order_no)->delete();

        $order->delete();
        return response(['error' => false, 'message' => 'Commande supprimée avec succès !']);
    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Order::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false, 'status' => $update]);
    }

    public function change(Request $request)
    {
        $orderId = $request->order_id;
        $productId = $request->product_id;
        $newQty = $request->quantity;

        $order = Order::where('id', $orderId)->firstOrFail();
        $orderItems = OrderItem::where('order_no', $order->order_no)->get();

        $product = $orderItems->filter(function ($item) use ($productId) {
            return $item['product_id'] == $productId;
        });

        if (isset($newQty) && $newQty > 0) {
            OrderItem::where('id', $product->first()['id'])->update([
                'quantity' => $newQty,
            ]);

            $newTotal = $newQty * $product->first()['price'];

            return response(['error' => false, 'newTotal' => $newTotal]);
        }

        //dd($product->first()['id']);

        /* if (isset($cart[$productId])) {
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
        } */

        //mettre à jour le panier dans la session
        //session()->put('cart', $cart);

        //$totalCartPrice = array_sum(array_column($cart, 'total'));

        /* return response()->json([
            'productTotal' => $cart[$productId]['total'] ?? 0,
            'totalCartPrice' => $totalCartPrice
        ]); */
    }
}
