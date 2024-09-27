<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->hasRole('admin') ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de l'utilisateur
        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Commandes', 'action' => 'Accès à la liste'])
            ->log("{$userName} ({$role}) a accédé à la liste des commandes.");

        $orders = Order::withCount('orderItems')->paginate(10);
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
        $order = Order::where('id', $id)->with('orderItems')->firstOrFail();
        //dd($order);
        return view('backend.pages.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::where('id', $id)->with('orderItems')->firstOrFail();
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->hasRole('admin') ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de l'utilisateur
        activity()
            ->causedBy($user)
            ->performedOn($order)
            ->withProperties(['menu' => 'Commandes', 'action' => 'Édition'])
            ->log("{$userName} ({$role}) est en train de modifier la commande : {$order->id}.");

        return view('backend.pages.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            $order = Order::where('order_no', $request->order_no)->first();

            if ($order) {

                foreach ($request->product_id as $index => $product_id) {
                    $quantity = $request->quantity[$index];

                    $orderItems = $order->orderItems->where('product_id', $product_id)->first();

                    if ($orderItems) {
                        $orderItems->quantity = $quantity;
                        $orderItems->save();
                    }
                }

                $order->update([
                    'status' => $request->status,
                ]);

                return redirect()->back()->with('success', 'Mise à jour éffectuée avec succès !');
            }
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $order = Order::where('id', $request->id)->firstOrFail();
        OrderItem::where('order_no', $order->order_no)->delete();

        $order->delete();
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->hasRole('admin') ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de l'utilisateur
        activity()
            ->causedBy($user)
            ->performedOn($order)
            ->withProperties(['menu' => 'Commandes', 'action' => 'Suppression'])
            ->log("{$userName} ({$role}) a supprimé la commande : {$order->id}.");

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
