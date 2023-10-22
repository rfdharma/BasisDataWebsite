<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Vehicle::with(['type', 'brand'])->findOrFail($id);
        if (auth()->check()) {
            // User is authenticated
            $notification = Notification::where('user_id', auth()->user()->id)->latest()->get();
        } else {
            // User is not authenticated
            $notification = null; // Adjust for handling unauthenticated users
        }

        if ($notification) {
            if ($notification->isEmpty()) {
                $notification = 'No notifications available.';
            }
        } else {
            // Handle the case when the user is not authenticated or other errors occur
        }
        View::share('notification', $notification);
        return view('checkout', [
            'item' => $item,
            'notification' => $notification
        ]);
    }

    public function store(Request $request, $id)
    {
        if (auth()->check()) {
            // User is authenticated
            $notification = Notification::where('user_id', auth()->user()->id)->latest()->get();
        } else {
            // User is not authenticated
            $notification = null; // Adjust for handling unauthenticated users
        }

        if ($notification) {
            if ($notification->isEmpty()) {
                $notification = 'No notifications available.';
            }
        } else {
            // Handle the case when the user is not authenticated or other errors occur
        }
        View::share('notification', $notification);

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
        $item = Vehicle::findOrFail($id);

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

        return view('success', ['booking' => $booking, 'item' => $item, 'notification' => $notification]);
    }
}
