<x-front-layout>
    <div class="container mx-auto py-4">
        <h1 class="text-center text-2xl font-bold mb-4">Your Bookings</h1>

        @if ($userBookings->isEmpty())
            <p class="text-gray-600">You have no bookings at the moment.</p>
        @else
            <div class="flex justify-center items-center">
            <table class="min-w-full bg-white border rounded-lg shadow overflow-hidden">
                <thead class="bg-dark text-white text-gray-600">
                <tr>
                    <th class="py-2 px-3 text-left">Invoice</th>
                    <th class="py-2 px-3 text-left">Name</th>
                    <th class="py-2 px-3 text-left">Vehicle</th>
                    <th class="py-2 px-3 text-left">Start Date</th>
                    <th class="py-2 px-3 text-left">End Date</th>
                    <th class="py-2 px-3 text-left">Status</th>
                    <th class="py-2 px-3 text-left">Payment</th>
                    <th class="py-2 px-3 text-left">Return</th>
                    <th class="py-2 px-3 text-left">Total Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($userBookings as $booking)
                    <tr class="border-b">
                        <td class="py-2 px-3">{{ $booking->id }}</td>
                        <td class="py-2 px-3">{{ $booking->name }}</td>
                        <td class="py-2 px-3">
                            {{ $booking->item->brand->name }}
                            {{ $booking->item->type->name }}
                            {{ $booking->item->name }}
                        </td>
                        <td class="py-2 px-3">{{ $booking->start_date }}</td>
                        <td class="py-2 px-3">{{ $booking->end_date }}</td>
                        <td class="py-2 px-3">{{ $booking->status }}</td>
                        <td class="py-2 px-3">{{ $booking->payment_status }}</td>
                        <td class="py-2 px-3">{{ $booking->return_status }}</td>
                        <td class="py-2 px-3">{{ $booking->total_price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            </div>
        @endif
    </div>
</x-front-layout>
