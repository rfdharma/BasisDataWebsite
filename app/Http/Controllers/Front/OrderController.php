<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
<<<<<<< HEAD
use App\Models\Notification;
use Illuminate\Support\Facades\View;
=======
>>>>>>> f9e89d9e445af32e57d6199e469c779fedc87658

class OrderController extends Controller
{
    public function index()
    {
        $userBookings = Booking::with('item.brand', 'item.type')
            ->where('user_id', auth()->user()->id)
<<<<<<< HEAD
            ->latest()->get();
        if (auth()->check()) {
            // Pengguna diotentikasi
            $notification = Notification::where('user_id', auth()->user()->id)->latest()->get();
        } else {
            // Pengguna tidak diotentikasi
            $notification = null; // Atau sesuaikan dengan penanganan yang sesuai untuk pengguna yang tidak diotentikasi
        }
=======
            ->get();
>>>>>>> f9e89d9e445af32e57d6199e469c779fedc87658

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
<<<<<<< HEAD
            'notification' => $notification
=======
>>>>>>> f9e89d9e445af32e57d6199e469c779fedc87658
        ]);
    }
}


