<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DetailController extends Controller
{
    public function index($id)
    {
        $item = Vehicle::with(['type', 'brand'])->findOrFail($id);
        $similiarItems = Vehicle::with(['type', 'brand'])
            ->where('id', '!=', $id)
            ->get();

        $notification = null; // Initialize notification variable

        if (auth()->check()) {
            // User is authenticated, fetch their notifications
            $notification = Notification::where('user_id', auth()->user()->id)->latest()->get();
        }

        if ($notification && $notification->isEmpty()) {
            $notification = 'Tidak ada notifikasi.';
        }

        View::share('notification', $notification);

        return view('detail', [
            'item' => $item,
            'similiarItems' => $similiarItems,
            'notification' => $notification
        ]);
    }
}

