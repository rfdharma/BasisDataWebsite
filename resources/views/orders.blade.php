<x-front-layout>
    <div class="container mx-auto py-4">
        @if ($userBookings->isEmpty())
            <div class="text-center bg-dark rounded-3xl flex flex-col justify-center items-center p-[30px]" style="height: 500px">
                <header style="margin-bottom: 15px">
                    <h2 class="font-bold text-white" style="padding-bottom: 15px;font-size: 30px">
                        You don't have any reservations
                    </h2>
                    <p class="text-base text-subtlePars" style="font-size: 15px">Get an instant booking to catch up whatever you really want to achieve today, yes.</p>
                </header>
                <!-- Button Primary -->
                <div class="group w-max rounded-full bg-primary p-1 mt-6">
                    <a href="{{route('front.catalog')}}" class="btn-primary">
                        <p>
                            Book Now
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
        @else
            <h1 class="text-center text-2xl font-bold mb-4">Your Bookings</h1>
            <div class="flex justify-center items-center">
            <table class="min-w-full bg-white border rounded-lg shadow overflow-hidden">
                <thead class="bg-dark text-white text-gray-600">
                <tr>
                    <th class="py-2 px-3 text-left">Invoice</th>
                    <th class="py-2 px-3 text-left">Name</th>
                    <th class="py-2 px-3 text-left">Vehicle</th>
                    <th class="py-2 px-3 text-left">Start Date</th>
                    <th class="py-2 px-3 text-left">End Date</th>
                    <th class="py-2 px-3 text-left">Booking</th>
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
