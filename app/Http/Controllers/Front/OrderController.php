<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\Payments;
use App\Models\Photo;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
class OrderController extends Controller
{
    public function index()
    {
        $userBookings = Booking::with('vehicle')
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

    public function store(Request $request, $id)
    {
        // Validasi permintaan
        $request->validate([
            'photos_payments' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);

        // Dapatkan booking yang sesuai dengan ID
        $booking = Booking::findOrFail($id);

        $path = $request->file('photos_payments')->store('payment-proofs', 'public');

        // Buat entri Payments
        Payments::create([
            'photos_payment' => $path, // Simpan path foto
            'booking_id' => $booking->id,
            'user_id' => auth()->user()->id,
        ]);

        $booking->update(['payment_status' => 'verifikasi']);

        $request->session()->put('checkout_completed', true);

        return redirect()->back()->with('success', 'Pembayaran berhasil dibuat');
    }




}


