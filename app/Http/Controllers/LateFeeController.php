<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LateFeeController extends Controller
{
    public function calculateLateFees()
    {
        // Get bookings that meet the conditions
        $bookings = Booking::where('start_date', '<=', now())
            ->where('end_date', '<', now())
            ->where('payment_status', 'success')
            ->where('return_status', 'not returned')
            ->get();

        // Calculate and create late fees
        foreach ($bookings as $booking) {
            $daysLate = now()->diffInDays($booking->end_date);

            // Check if the late fee doesn't already exist for this booking
            if (!$booking->lateFee) {
                // Calculate late fee amount based on total price and a fixed increment
                $lateFeeAmount = $booking->total_price + ($daysLate * 50000);

                LateFee::create([
                    'booking_id' => $booking->id,
                    'amount' => $lateFeeAmount,
                    'days_late' => $daysLate,
                ]);
            }
        }

        return response()->json(['message' => 'Late fees calculated successfully']);
    }
}
