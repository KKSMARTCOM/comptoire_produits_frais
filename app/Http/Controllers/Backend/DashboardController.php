<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            //code...
            $totalOrders = Order::count();

            // Nombre de commandes traitées
            $processedOrders = Order::where('status', '1')->count();

            // Nombre de commandes en attente
            $pendingOrders = $totalOrders - $processedOrders;

            // Nombre d'utilisateurs
            $totalUsers = User::where('email', '!=', 'superadmin@gmail.com')->count();

            //Produits les plus commandés
            $mostOrderedProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->where('product_id', '!=', null)
                ->groupBy('product_id')
                ->orderBy('total_quantity', 'desc')
                ->take(10)
                ->with('product')
                ->get();

            // Récupérer les commandes groupées par mois
            $monthlyTotals = OrderItem::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(price * quantity) as total_price'),
                DB::raw('COUNT(DISTINCT order_no) as total_orders')
            )
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->get()
                ->map(function ($item) {
                    $item->month_name = getMonthName($item->month);
                    return $item;
                });

            // Calcul des pourcentages
            $processedPercentage = $totalOrders > 0 ? ($processedOrders / $totalOrders) * 100 : 0;
            $pendingPercentage = $totalOrders > 0 ? ($pendingOrders / $totalOrders) * 100 : 0;

            return view('backend.pages.index', compact(
                'totalOrders',
                'processedOrders',
                'pendingOrders',
                'processedPercentage',
                'pendingPercentage',
                'totalUsers',
                'mostOrderedProducts',
                'monthlyTotals'
            ));
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
        //Nombre total de commandes
    }

    public function getOrderStatistics(Request $request)
    {
        $year = $request->input('year');
        //dd($year);
        $monthlyStatistics = OrderItem::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(price * quantity) as total_price'),
            DB::raw('COUNT(DISTINCT order_no) as total_orders')
        )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($item) {
                $item->month_name = getMonthName($item->month); // Nom du mois
                return $item;
            });

        return response()->json(["data" => $monthlyStatistics]);
    }
}
