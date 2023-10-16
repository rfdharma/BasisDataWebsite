<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
class OrderController extends Controller
{
    public function index()
    {
        $userBookings = Booking::with('item.brand', 'item.type')
            ->where('user_id', auth()->user()->id)
            ->latest()->get();
        if (auth()->check()) {
            // Pengguna diotentikasi
            $notification = Notification::where('user_id', auth()->user()->id)->latest()->get();
        } else {
            // Pengguna tidak diotentikasi
            $notification = null; // Atau sesuaikan dengan penanganan yang sesuai untuk pengguna yang tidak diotentikasi
        }

        if ($notification) {
            if ($notification->isEmpty()) {
                $notification = 'Tidak ada notifikasi.';
            }
        } else {
            // Handle situasi ketika pengguna tidak diotentikasi atau terjadi kesalahan lainnya
        }
        View::share('notification', $notification);
        return view('orders', [
            'userBookings' => $userBookings,
            'notification' => $notification
        ]);
    }
}


