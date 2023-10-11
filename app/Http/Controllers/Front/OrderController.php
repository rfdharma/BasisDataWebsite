<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $items = Item::with(['type', 'brand'])->latest()->get(); // Mengambil semua item

        return view('orders', [
            'items' => $items,
        ]);
    }

}
