<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 items-center">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <div class="p-6">
                    <table class="w-full border divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="py-2">Invoice</th>
                            <th class="py-2">User</th>
                            <th class="py-2">Brand</th>
                            <th class="py-2">Item</th>
                            <th class="py-2">Mulai</th>
                            <th class="py-2">Selesai</th>
                            <th class="py-2">Status Booking</th>
                            <th class="py-2">Status Pembayaran</th>
                            <th class="py-2">Status Pengembalian</th>
                            <th class="py-2">Total Dibayar</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="text-center">{{ $booking->id }}</td>
                                <td class="text-center">{{ $booking->user->name }}</td>
                                <td class="text-center">{{ $booking->item->brand->name }}</td>
                                <td class="text-center">{{ $booking->item->name }}</td>
                                <td class="text-center">{{ $booking->start_date }}</td>
                                <td class="text-center">{{ $booking->end_date }}</td>
                                <td class="py-2 px-1">
                                    <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" onsubmit="return confirm('Are you sure you want to update the data?')">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="border-0 rounded-3xl block w-full outline-none @if ($booking->status != 'done' && $booking->status != 'failed') border-2 border-blue-500 @endif" @if ($booking->status == 'done' || $booking->status == 'failed') disabled @endif>
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
                                            <option value="failed" {{ $booking->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                </td>
                                <td class="py-2 px-1">
                                    <select name="payment_status" class="border-0 rounded-3xl block w-full outline-none @if ($booking->status == 'confirmed') border-2 border-blue-500 @endif" @if ($booking->status != 'confirmed') disabled @endif>
                                        <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </td>
                                <td class="py-2 px-1">
                                    <select name="return_status" class="border-0 rounded-3xl block w-full outline-none @if ($booking->status == 'done' && $booking->return_status == 'not returned') border-2 border-blue-500 @endif" @if ($booking->status != 'done' || $booking->return_status != 'not returned') disabled @endif>
                                        <option value="not returned" {{ $booking->return_status == 'not returned' ? 'selected' : '' }}>Not Returned</option>
                                        <option value="returned" {{ $booking->return_status == 'returned' ? 'selected' : '' }}>Returned</option>
                                        <option value="expired" {{ $booking->return_status == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </td>
                                <td class="text-center">{{ $booking->total_price }}</td>
                                <td class="py-2 px-2">
                                    <button type="submit" class="mb-1 w-full px-2 py-1 text-xs text-white transition duration-500 rounded-md select-none ease focus:outline-none focus:shadow-outline" style="background: #008652">Save</button>
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

