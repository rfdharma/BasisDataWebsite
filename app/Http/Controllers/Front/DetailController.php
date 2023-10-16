<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DetailController extends Controller
{
	public function index($slug)
	{
		$item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();
		// dd($item);
		$similiarItems = Item::with(['type', 'brand'])
			->where('id', '!=', $item->id)
			->get();

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
		return view('detail', [
			'item' => $item,
			'similiarItems' => $similiarItems,
            'notification' => $notification
		]);
	}
}
