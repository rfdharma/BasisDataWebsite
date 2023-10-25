<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Inventories;
use App\Models\Vehicle;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CatalogController extends Controller
{
    public function index()
    {
        $items = Vehicle::with(['type', 'brand', 'inventory'])->latest()->get();

        // Memisahkan item yang 'available' adalah true dan false
        $availableItems = $items->filter(function ($item) {
            return $item->inventory->available;
        });

        $unavailableItems = $items->filter(function ($item) {
            return !$item->inventory->available;
        });

        // Menggabungkan item yang 'available' adalah true diikuti oleh yang 'available' adalah false
        $sortedItems = $availableItems->concat($unavailableItems);

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

        return view('catalog', [
            'items' => $sortedItems,
            'notification' => $notification
        ]);
    }


}
