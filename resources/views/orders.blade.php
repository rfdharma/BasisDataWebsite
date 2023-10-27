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
                    <a href="{{ route('front.catalog') }}" class="btn-primary">
                        <p>
                            Book Now
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
        @else
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-center text-2xl font-bold mb-4">Your Bookings</h1>
            <div class="flex justify-center items-center">
                <table class="min-w-full bg-white border rounded-lg shadow overflow-hidden text-center">
                    <thead class="bg-dark text-white text-gray-600">
                    <tr>
                        <th class="py-2 px-3 text-center">Invoice</th>
                        <th class="py-2 px-3 text-center">Name</th>
                        <th class="py-2 px-3 text-center">Vehicle</th>
                        <th class="py-2 px-3 text-center">Start Date</th>
                        <th class="py-2 px-3 text-center">End Date</th>
                        <th class="py-2 px-3 text-center">Price</th>
                        <th class="py-2 px-3 text-center">Booking</th>
                        <th class="py-2 px-3 text-center">Payment</th>
                        <th class="py-2 px-3 text-center">Return</th>
                        <th class="py-2 px-3 text-center">Plate</th>
                        <th class="py-2 px-3 text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($userBookings as $booking)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $booking->id }}</td>
                            <td class="py-2 px-3 text-left">{{ $booking->name }}</td>
                            <td class="py-2 px-3 text-left">
                                @if($booking->vehicle)
                                    {{ $booking->vehicle->brand->name }}
                                    {{ $booking->vehicle->type->name }}
                                    {{ $booking->vehicle->name }}
                                @else
                                    @php
                                        $deletedVehicle = App\Models\Vehicle::withTrashed()->find($booking->vehicle_id);
                                    @endphp
                                    @if($deletedVehicle)
                                        {{ $deletedVehicle->brand->name }}
                                        {{ $deletedVehicle->type->name }}
                                        {{ $deletedVehicle->name }}
                                    @else
                                        Data Kendaraan Tidak Ditemukan
                                    @endif
                                @endif
                            </td>


                            <td class="py-2 px-3">{{ $booking->start_date }}</td>
                            <td class="py-2 px-3">{{ $booking->end_date }}</td>
                            <td class="py-2 px-3">{{ $booking->total_price }}</td>
                            <td class="py-2 px-3 @if($booking->status == 'done') text-green-500 font-bold @elseif($booking->status == 'failed') text-red-500 font-bold @endif">{{ $booking->status }}</td>
                            @if ($booking->payment_status === 'unpaid')
                                <td class="py-2 px-3">
                                    <button class="bg-red-500 rounded w-full text-white hover:bg-red-600 btn" data-target="popup-{{ $booking->id }}">Bayar</button>
                                    <div id="popup-{{ $booking->id }}" class="popup text-left fixed inset-0 z-50 border-gray-700 overflow-hidden bg-black flex items-center justify-center hidden" style="margin-top: -13%">
                                        <form action="{{ route('front.orders.store', ['id' => $booking->id]) }}" method="POST" enctype="multipart/form-data" style="height: 450px;width: 50%;">
                                            @csrf
                                            <div class="modal-container bg-white border-gray-700 w-11/12 md:max-w-4xl mx-auto rounded shadow-lg">
                                                <main class="p-4">
                                                    <h1 class="text-xl font-bold mb-4">Invoice ({{$booking->id}})</h1>
                                                    <hr class="border-t-2 border-gray-400 my-4">
                                                    <div class="mb-4">
                                                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                                            Detail Pesanan
                                                        </label>
                                                        <!-- Tambahkan detail pesanan di sini -->
                                                        <p class="text-gray-700">Nama: {{ $booking->name }}</p>
                                                        <p class="text-gray-700">Tanggal Mulai : {{ $booking->start_date }}</p>
                                                        <p class="text-gray-700">Tanggal Selesai : {{ $booking->end_date }}</p>
                                                        <p class="text-gray-700">Alamat : {{ $booking->address }}</p>
                                                        <p class="text-gray-700">Kota : {{ $booking->city }}</p>
                                                        <p class="text-gray-700">Kode Post : {{ $booking->zip }}</p>
                                                        <hr class="border-t-2 border-gray-400 my-4">
                                                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                                            Detail Kendaraan
                                                        </label>
                                                        <p class="text-gray-700">Mobil : {{ $booking->vehicle->brand->name }}
                                                            {{ $booking->vehicle->type->name }}
                                                            {{ $booking->vehicle->name }}</p>
                                                        <p class="text-gray-700">Keluaran : {{ $booking->vehicle->year }}</p>
                                                        <p class="text-gray-700">Transmission : {{ $booking->vehicle->transmission }}</p>
                                                        <p class="text-gray-700">Capacity : {{ $booking->vehicle->capacity }}</p>
                                                        <p class="text-gray-700">Total Harga : {{ $booking->total_price }}</p>
                                                    </div>
                                                    <hr class="border-t-2 border-gray-400 my-4">
                                                    <div class="mt-1 flex justify-center items-center">
                                                        <div class="w-full">
                                                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                                                Upload Bukti Pembayaran
                                                            </label>
                                                            <input name="photos_payments" accept="image/*" type="file"
                                                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus-bg-white focus:outline-none" />
                                                            <div class="mt-2 text-sm text-gray-500">
                                                                Unggah bukti pembayaran Anda di sini.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-t-2 border-gray-400 my-4">
                                                    <div class="flex flex-wrap mt-4 mb-4 -mx-3">
                                                        <div class="w-auto px-3 text-right">
                                                            <button type="submit"
                                                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                                                Kirim Bukti Pembayaran
                                                            </button>
                                                        </div>
                                                    </div>
                                                </main>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            @else
                                <td class="py-2 px-3 @if($booking->payment_status == 'success') text-green-500 font-bold @elseif($booking->payment_status == 'failed') text-red-500 font-bold @endif">{{ $booking->payment_status }}</td>

                            @endif
                            <td class="py-2 px-3 @if($booking->return_status == 'not returned') text-red-500 font-bold @endif">
                                @if($booking->status != 'done')
                                    -
                                @else
                                    {{ $booking->return_status }}
                                @endif

                            </td>

                            @if($booking->return_status == 'not returned')
                                <td class="py-2 px-3">
                                    {{ $booking->rentalPlates->first()?->plate ?? '-' }}
                                </td>
                            @else
                                <td class="py-2 px-3">-</td>
                            @endif
                            <td class="py-2 px-3">
                                @if ($booking->status == 'pending' && $booking->payment_status == 'pending')
                                    <form action="{{ route('front.cancel.booking', ['id' => $booking->id]) }}" method="POST" onsubmit="return confirm('Yakin cancel sekarang?, setelah dikonfirmasi admin tidak bisa cancel')">
                                        @csrf
                                        <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 rounded">Cancel</button>
                                    </form>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        // Function to show a specific popup
        function showPopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.remove('hidden');
        }

        // Function to hide a specific popup
        function hidePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.add('hidden');
        }

        // Event listeners for the "Bayar" buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const popupId = event.target.getAttribute('data-target');
                showPopup(popupId);
            });
        });

        // Event listeners to hide popups when the overlay is clicked
        document.querySelectorAll('.popup').forEach(popup => {
            popup.addEventListener('click', (event) => {
                if (event.target === popup) {
                    hidePopup(popup.id);
                }
            });
        });
    </script>
</x-front-layout>
