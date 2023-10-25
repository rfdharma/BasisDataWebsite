<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class LandingController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->roles === 'ADMIN') {
            return Redirect::to('dashboard'); // Redirect to the admin dashboard
        }

        // Fetch the latest vehicle based on your criteria
        $latestVehicle = Vehicle::with(['type', 'brand', 'photos'])
            ->whereHas('inventory', function ($query) {
                $query->where('available', true);
            })
            ->orderBy('created_at', 'desc')
            ->first();



        $photos = $latestVehicle->photos;


        $items = Vehicle::with(['type', 'brand'])
            ->get();
        $items_landing = Vehicle::with(['type', 'brand'])->get();

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

        $popularVehicles = Vehicle::with(['type', 'brand']) // Replace 'popularity_column' with the actual column name you want to use for popularity
            ->take(5) // Adjust the number of popular vehicles to display
            ->get();

        return view('landing', [
            'latestVehicle' => $latestVehicle,
            'popularVehicles' => $popularVehicles, // Pass the popular vehicles to the view
            'items' => $items,
            'items_landing' => $items_landing,
            'notification' => $notification
        ]);

    }



}
