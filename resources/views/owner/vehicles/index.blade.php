<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('owner.vehicles.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Add Vehicle
                </a>
            </div>
            @if(session('error'))
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <div class="overflow-hidden shadow sm:rounded-md text-center">
                <div class="px-2 py-5 bg-white sm:p-6">
                    <table class="text-center table-auto w-full border w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 border-2">ID</th>
                            <th class="px-4 py-2 border-2">Brand</th>
                            <th class="px-4 py-2 border-2">Type</th>
                            <th class="px-4 py-2 border-2">Name</th>
                            <th class="px-3 py-2 border-2">Transmission</th>
                            <th class="px-4 py-2 border-2">Price</th>
                            <th class="px-3 py-2 border-2">Features</th>
                            <th class="px-4 py-2 border-2">Year</th>
                            <th class="px-2 py-2 border-2">Quantity</th>
                            <th class="px-2 py-2 border-2">Total</th>
                            <th class="px-4 py-2 border-2">Photos</th> <!-- Tambah kolom untuk menampilkan foto -->
                            <th class="px-4 py-2 border-2">Actions Vehicle</th>
                            <th class="px-4 py-2 border-2">Actions Plate Vehicle</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vehicles as $vehicle)
                            @php
                                $inventory = $vehicle->inventory;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 border-2">{{ $vehicle->id }}</td>
                                <td class="px-4 py-2 border-2 text-left">{{ $vehicle->brand->name }}</td>
                                <td class="px-4 py-2 border-2 text-left">{{ $vehicle->type->name }}</td>
                                <td class="px-4 py-2 border-2 text-left">{{ $vehicle->name }}</td>
                                <td class="px-4 py-2 border-2 text-left">{{ $vehicle->transmission }}</td>
                                <td class="px-4 py-2 border-2">{{ $vehicle->price }}</td>
                                <td class="px-4 py-2 border-2 text-left">{{ $vehicle->features }}</td>
                                <td class="px-4 py-2 border-2">{{ $vehicle->year }}</td>
                                <td class="px-4 py-2 border-2">{{ $vehicle->inventory ? $vehicle->inventory->quantity : 'None' }}</td>
                                <td class="px-4 py-2 border-2">{{ $vehicle->carPlates()->count() }}</td>
                                <td class="px-4 py-2 border-2">
                                    @if ($vehicle->photos)
                                        @php
                                            $photos = json_decode($vehicle->photos, true);
                                            $photoCount = count($photos);
                                        @endphp

                                        @if ($photoCount > 0)
                                            @php
                                                $photoName = $photos[$photoCount - 1]['photos']; // Mengakses foto terakhir dalam array
                                            @endphp
                                        <a href="{{ asset('storage/' . $photoName)}}" target="_blank">
                                            <img src="{{ asset('storage/' . $photoName) }}" alt="Vehicle Photo" style="max-width: 100px; max-height: 100px">
                                        </a>
                                        @else
                                            No Photos
                                        @endif
                                    @else
                                        No Photos
                                    @endif


                                </td>
                                <td class="px-2 py-2 border-2">
                                    <div>
                                        <a href="{{ route('owner.vehicles.edit', $vehicle->id) }}"
                                           class="px-1 py-1 mb-2 text-white bg-gray-500 rounded shadow-lg hover:bg-gray-700 block"
                                           onclick="return confirm('Are you sure you want to edit this vehicle?">Edit</a>
                                    </div>
                                    <div>
                                        <form action="{{ route('owner.vehicles.destroy', $vehicle->id) }}" method="POST" class="block"
                                              onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-1 py-1 text-white bg-red-500 rounded shadow-lg hover:bg-red-600 w-full block">Delete</button>
                                        </form>
                                    </div>
                                </td>


                                <td class="px-2 py-2 border-2">
                                    <div>
                                        <a href="{{ route('owner.vehicles.plates.create', $vehicle->id) }}"
                                           class="px-2 py-1 mb-2 text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700 block">Add Plate</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('owner.vehicles.plates.index', $vehicle->id) }}"
                                           class="px-2 py-1 text-white bg-green-500 rounded shadow-lg hover:bg-green-700 block">List All Plate</a>
                                    </div>
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
