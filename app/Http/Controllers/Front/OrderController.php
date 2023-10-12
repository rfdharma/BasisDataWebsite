<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class OrderController extends Controller
{
    public function index()
    {
        $userBookings = Booking::with('item.brand', 'item.type')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('orders', [
            'userBookings' => $userBookings,
        ]);
    }
}


