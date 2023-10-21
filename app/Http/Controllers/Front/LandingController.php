<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Item;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class LandingController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->roles === 'ADMIN') {
            return Redirect::to('dashboard'); // Redirect to the admin dashboard
        }
        $items = Item::with(['type', 'brand'])
            ->orderBy('star', 'desc') // Mengurutkan berdasarkan star terbanyak
            ->take(5)
            ->get();
        $items_landing = Item::with(['type', 'brand'])->get();

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
        return view('landing', [
            'items' => $items,
            'items_landing' => $items_landing,
            'notification' => $notification
        ]);
    }


}
