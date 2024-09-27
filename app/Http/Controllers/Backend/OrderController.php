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

        return view('backend.pages.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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

                $user = Auth::user();
                $role = $user->role == '0' || '1' ? 'Administrateur' : 'Utilisateur';

                // Enregistrer l'action de l'utilisateur
                activity()
                    ->causedBy($user)
                    ->performedOn($order)
                    ->withProperties(['menu' => 'Commandes', 'action' => 'Mise à jour'])
                    ->log("{$user->name} ({$role}) a modifié la commande : {$order->name}.");

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
        $role = $user->role == '0' || '1' ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de l'utilisateur
        activity()
            ->causedBy($user)
            ->performedOn($order)
            ->withProperties(['menu' => 'Commandes', 'action' => 'Suppression'])
            ->log("{$user->name} ({$role}) a supprimé la commande : {$order->name}.");

        return response(['error' => false, 'message' => 'Commande supprimée avec succès !']);
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
    }
}
