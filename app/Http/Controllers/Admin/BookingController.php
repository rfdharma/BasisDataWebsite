<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CarPlate;
use App\Models\Inventories;
use App\Models\Notification;
use App\Models\RentalPlate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingUpdateRequest;

class BookingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
        $bookings = Booking::with(['brand', 'user','payments'])->get();

        return view('admin.bookings.index', compact('bookings'));
    }


    /**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

//	/**
//	 * Show the form for editing the specified resource.
//	 *
//	 * @param  int  $id
//	 * @return \Illuminate\Http\Response
//	 */
//	public function edit(Booking $booking)
//	{
//		return view('admin.bookings.edit', compact('booking'));
//	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $originalStatus = $booking->status;
        $originalPaymentStatus = $booking->payment_status;
        $originalReturnStatus = $booking->return_status;

        // Proses perubahan status booking
        if ($request->has('status')) {
            $newStatus = $request->input('status');
            $booking->status = $newStatus;

            if ($newStatus == 'failed') {
                $booking->payment_status = 'failed';
            } elseif ($newStatus == 'pending') {
                $booking->payment_status = 'pending';
            } elseif ($newStatus == 'confirmed') {
                $booking->payment_status = 'unpaid';
            }
        }

        // Proses perubahan status pembayaran
        if ($request->has('payment_status')) {
            $newPaymentStatus = $request->input('payment_status');
            $booking->payment_status = $newPaymentStatus;

            if ($newPaymentStatus == 'failed') {
                $booking->status = 'failed';
            } elseif ($newPaymentStatus == 'success') {
                $booking->status = 'done';

                // Create a new record in rental_plates
                $bookingVehicleId = $booking->vehicle->id;
                $carPlate = CarPlate::where('vehicles_id', $bookingVehicleId)->inRandomOrder()->first();

                if ($carPlate) {
                    $existingRentalPlate = RentalPlate::where('vehicle_id', $bookingVehicleId)
                        ->where('plate', $carPlate->plate)
                        ->first();

                    if ($existingRentalPlate) {
                        // Cari nomor plat lain yang belum ada di rental_plates
                        $carPlate = CarPlate::where('vehicles_id', $bookingVehicleId)
                            ->whereNotIn('plate', RentalPlate::where('vehicle_id', $bookingVehicleId)->pluck('plate'))
                            ->inRandomOrder()
                            ->first();
                    }

                    if ($carPlate) {
                        $rentalPlate = new RentalPlate([
                            'booking_id' => $booking->id,
                            'vehicle_id' => $bookingVehicleId,
                            'plate' => $carPlate->plate,
                        ]);
                        $rentalPlate->save();

                        // Decrement the inventory quantity
                        $inventory = Inventories::where('vehicle_id', $bookingVehicleId)->first();
                        if ($inventory) {
                            $inventory->decrement('quantity');
                            if ($inventory->quantity === 0) {
                                $inventory->update(['available' => 0]);
                            }
                        }

                    }
                }
            } elseif ($newPaymentStatus == 'verifikasi') {
                $booking->status = 'confirmed';
            }
        }

        // Proses perubahan status pengembalian
        if ($request->has('return_status')) {
            $returnStatus = $request->input('return_status');
            $booking->return_status = $returnStatus;

            if ($returnStatus === 'returned' || $returnStatus === 'expired') {
                // Hapus record di rental_plates
                RentalPlate::where('booking_id', $booking->id)->delete();

                // Tambahkan kembali ke inventory
                $inventory = Inventories::where('vehicle_id', $booking->vehicle_id)->first();
                if ($inventory) {
                    $inventory->increment('quantity');
                    if ($inventory->quantity > 0) {
                        $inventory->update(['available' => 1]);
                    }
                }
            }
        }

        // Simpan perubahan ke database
        $booking->save();

        if ($request->has('status') || $request->has('payment_status') || $request->has('return_status')) {
            // Construct a descriptive notification message
            $notificationMessage = 'Booking: ' . $originalStatus . ' -> ' . $booking->status;

            if ($originalPaymentStatus != $booking->payment_status) {
                $notificationMessage .= ', Payment: ' . $originalPaymentStatus . ' -> ' . $booking->payment_status;
            }

            if ($originalReturnStatus != $booking->return_status) {
                $notificationMessage .= ', Return: ' . $originalReturnStatus . ' -> ' . $booking->return_status;
            }

            // Replace HTML line breaks with newlines
            $notificationMessage = str_replace('<br>', "\n", $notificationMessage);

            $notification = new Notification([
                'user_id' => $booking->user_id,
                'message' => $notificationMessage,
            ]);
            $booking->notifications()->save($notification);
        }

        // Redirect kembali ke halaman sebelumnya atau halaman yang sesuai
        return redirect()->back();
    }





    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Booking $booking)
	{
		$booking->delete();
        $notificationMessage = 'Invoice ' . $booking->id . ' has been deleted by admin.';

        // Replace HTML line breaks with newlines
        $notificationMessage = str_replace('<br>', "\n", $notificationMessage);

        $notification = new Notification([
            'user_id' => $booking->user_id,
            'message' => $notificationMessage,
        ]);
        $booking->notifications()->save($notification);
		return redirect()->route('admin.bookings.index');
	}
}
