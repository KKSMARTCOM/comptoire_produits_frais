<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pack;

class PageHomeController extends Controller
{
    public function index(Request $request)
    {
        //$categories = Category::where('category_id', null)->get();
        $limit = 3;
        $offset = $request->input('offset', 0);

        // Récupère les coffrets avec une pagination personnalisée
        $packs = Pack::where('status', '1')->skip($offset)->take($limit)->get();

        // Vérifie s'il reste d'autres coffrets à charger
        $remaining = Pack::count() > ($offset + $limit);

        if ($request->ajax()) {
            return response()->json([
                'packs' => view('frontend.ajax.packList', compact('packs'))->render(),
                'remaining' => $remaining
            ]);
        }

        return view('frontend.pages.index', compact('packs', 'remaining'));
    }
}
