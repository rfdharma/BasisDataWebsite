<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 items-center">
        <div class="mx-auto max-w-full sm:px-6 lg:px-1">
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <div class="p-2">
                    <table class="w-full table-auto border divide-y divide-gray-200 text-center">
                        <thead>
                        <tr>
                            <th class="px-1 py-2 border-2">Invoice</th>
                            <th class="px-2 py-2 border-2">User</th>
                            <th class="px-1 py-3 border-2">Vehicle</th>
                            <th class="px-1 py-2 border-2">Start</th>
                            <th class="px-1 py-2 border-2">End</th>
                            <th class="px-[26px] py-3 border-2">Booking</th>
                            <th class="px-[26px] py-3 border-2">Payments</th>
                            <th class="px-[26px] py-3 border-2">Return</th>
                            <th class="px-3 py-2 border-2">Paid</th>
                            <th class="px-3 py-2 border-2">Available</th>
                            <th class="px-3 py-2 border-2">Proof</th>
                            <th class="px-3 py-2 border-2">Plate</th>
                            <th class="px-3 py-2 border-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="text-center px-0 py-2 border-2">{{ $booking->id }}</td>
                                <td class="text-left px-2 py-2 border-2">{{ $booking->user->name }}</td>
                                <td class="text-left px-1 py-4 border-2">
                                    {{ $booking->vehicle->brand->name }}
                                    {{ $booking->vehicle->type->name }}
                                    {{ $booking->vehicle->name }}
                                </td>
                                <td class="text-center py-2 px-0 border-2">{{ $booking->start_date }}</td>
                                <td class="text-center py-2 px-0 border-2">{{ $booking->end_date }}</td>
                                <td class="text-left px-4 py-3 border-2" >
                                    <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" onsubmit="return confirm('Are you sure you want to update the data?')">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="border-0 rounded-3xl block w-full outline-none @if ($booking->status != 'done' && $booking->status != 'failed' && $booking->status != 'confirmed') border-2 border-blue-500 @endif" @if ($booking->status == 'done' || $booking->status == 'failed' || $booking->status == 'confirmed') disabled @endif>
                                        @if($booking->status == 'confirmed')
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="failed" {{ $booking->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        @elseif($booking->status == 'pending')
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="failed" {{ $booking->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        @else
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
                                            <option value="failed" {{ $booking->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        @endif
                                        </select>
                                </td>
                                <td class=" text-left px-4 py-2 border-2">
                                    <select name="payment_status" class="border-0 rounded-3xl block w-full outline-none @if (($booking->status != 'done' && $booking->status != 'pending' && $booking->payment_status != 'unpaid' && $booking->payment_status != 'failed') || ($booking->status == 'confirmed' && $booking->payment_status != 'unpaid')) border-2 border-blue-500 @endif" @if (($booking->status == 'done' && $booking->payment_status != 'verifikasi') || ($booking->status == 'confirmed' && $booking->payment_status != 'verifikasi') || ($booking->payment_status == 'pending') || ($booking->payment_status == 'failed')) disabled @endif>
                                        @if($booking->status == 'confirmed' && $booking->payment_status == 'verifikasi')
                                            <option value="verifikasi" {{ $booking->payment_status == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                            <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>Success</option>
                                            <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        @else
                                            <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                            <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>Success</option>
                                            <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        @endif
                                    </select>
                                </td>
                                <td class="text-left px-4 py-2 border-2">
                                    <select name="return_status" class="border-0 rounded-3xl block w-full outline-none @if ($booking->status == 'done' && $booking->return_status == 'not returned') border-2 border-blue-500 @endif" @if ($booking->status != 'done' || $booking->return_status != 'not returned') disabled @endif>
                                        <option value="not returned" {{ $booking->return_status == 'not returned' ? 'selected' : '' }}>Not Returned</option>
                                        <option value="returned" {{ $booking->return_status == 'returned' ? 'selected' : '' }}>Returned</option>
                                        <option value="expired" {{ $booking->return_status == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </td>
                                <td class="text-center py-2 px-1 border-2">{{ $booking->total_price }}</td>
                                <td class="text-center py-2 px-1 border-2">
                                    @if ($booking->vehicle->inventory->available == 1)
                                        True
                                    @else
                                        False
                                    @endif
                                </td>

                                <td class="text-center px-1 py-2 border-2">
                                    @if($booking->payments->isNotEmpty())
                                        @foreach($booking->payments as $payment)
                                            @if (!empty($payment->photos_payment))
                                                <a href="{{ asset('storage/' . $payment->photos_payment) }}" target="_blank" class="hover:underline font-bold" style="color: cornflowerblue">View</a>
                                            @else
                                                None
                                            @endif
                                        @endforeach
                                    @else
                                        None
                                    @endif
                                </td>

                                <td class="text-center py-2 px-2 border-2">
                                    @foreach ($booking->rentalPlates()->withTrashed()->get() as $rentalPlate)
                                        {{ $rentalPlate->plate }}
                                        <br>
                                    @endforeach
                                </td>




                                <td class="py-2 px-2 border-2">
                                    <button type="submit" class="mb-1 w-full px-2 py-1 text-xs text-white transition duration-500 rounded-md select-none ease focus:outline-none focus:shadow-outline bg-green-500 hover:bg-green-700">Save</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" onsubmit="return confirm('Are you sure you want to delete the data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

