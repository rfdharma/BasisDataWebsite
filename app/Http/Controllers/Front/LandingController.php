<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $items = Item::with(['type', 'brand'])
            ->orderBy('star', 'desc') // Mengurutkan berdasarkan star terbanyak
            ->take(5)
            ->get();
        $items_landing = Item::with(['type', 'brand'])->latest()->get();

        return view('landing', [
            'items' => $items,
            'items_landing' => $items_landing
        ]);
    }


}
