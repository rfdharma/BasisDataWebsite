<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
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
        $bookings = Booking::with(['item.brand', 'user'])->get();

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
            } elseif ($newStatus == 'done' && $booking->payment_status == 'pending') {
                $booking->status = 'pending';
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
            }
        }

        // Proses perubahan status pengembalian
        if ($request->has('return_status')) {
            $booking->return_status = $request->input('return_status');
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
