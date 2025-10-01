<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteSettingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // key - value şeklinde array oluşturur
        //$settings = SiteSetting::pluck('data', 'name')->toArray();
        $categories = Category::where('category_id', null)->where('slug', '!=', 'coffrets-paniers')->get();

        $countQty = 0;

        $cartItem = session('cart')['products'] ?? [];

        $cartPack = session('cart')['packs'] ?? [];

        if (isset($cartItem)) {
            foreach ($cartItem as $cart) {
                $countQty += $cart['quantity'];
            }
        }

        view()->share([/* 'settings'=>$settings,*/'categories' => $categories, 'countQty' => $countQty]);

        return $next($request);
    }
}
