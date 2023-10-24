<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Daftar Pembayaran</h1>

        @if($payments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-md">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-100 border-b">No</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">ID Pembayaran</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">ID Pemesanan</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">ID Pengguna</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">Foto Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $payment->id }}</td>
                            <td class="px-6 py-4">{{ $payment->booking_id }}</td>
                            <td class="px-6 py-4">{{ $payment->user_id }}</td>
                            <td class="px-6 py-4">
                                @if(is_array($payment->photos_payment))
                                    @foreach($payment->photos_payment as $photo)
                                        <a href="{{ asset('storage/' . $photo) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $photo) }}" alt="Bukti Pembayaran" class="w-16 h-16 rounded-lg">
                                        </a>
                                    @endforeach
                                @else
                                    <img src="{{ asset('storage/' . $payment->photos_payment) }}" alt="Bukti Pembayaran" class="w-16 h-16 rounded-lg">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mt-4">Tidak ada data pembayaran yang tersedia.</p>
        @endif
    </div>
</x-app-layout>
