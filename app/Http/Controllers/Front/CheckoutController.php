<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
	public function index(Request $request, $slug)
	{
		$item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();
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
		return view('checkout', [
			'item' => $item,
            'notification' => $notification
		]);
	}

	public function store(Request $request, $slug)
	{
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
        $item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();
		// Validate the request
		$request->validate([
			'name' => 'required|string|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			'address' => 'required|string|max:255',
			'city' => 'required|string|max:255',
			'zip' => 'required|string|max:5',
		]);

		// Format start_date and end_date from dd mm yy to timestamp
		$start_date = Carbon::createFromFormat('d m Y', $request->start_date);
		$end_date = Carbon::createFromFormat('d m Y', $request->end_date);

		// Count the number of days between start_date and end_date
		$days = $start_date->diffInDays($end_date);

		// Get the item
		$item = Item::whereSlug($slug)->firstOrFail();

		// Calculate the total price
		$total_price = $days * $item->price;

		// Add 10% tax
		$tax = $total_price * ($total_price * 0.10);

        $booking = $item->bookings()->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'total_price' => $total_price,
        ]);

        $request->session()->put('checkout_completed', true);

        return view('success', ['booking' => $booking, 'item' => $item,'notification' => $notification]);



    }
}
