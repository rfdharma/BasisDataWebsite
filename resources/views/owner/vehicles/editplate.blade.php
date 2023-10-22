<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{ route('owner.vehicles.index') }}">
                ← Back
            </a>
            Edit Plate Number
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="rounded-t bg-red-500 px-4 py-2 font-bold text-white">
                            There are errors!
                        </div>
                        <div class="rounded-b border border-t-0 border-red-400 bg-red-100 px-4 py-3 text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form class="w-full" action="{{ route('owner.vehicles.plates.update', ['vehicleId' => $carPlate->vehicles_id, 'plate' => $carPlate->plate]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="plate">
                                Plate Number*
                            </label>
                            <input value="{{ old('plate') ?? $carPlate->plate }}" name="plate"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Plate Number" required />
                            <div class="mt-2 text-sm text-gray-500">
                                Plate number of the vehicle. Example: L3309DDA, etc. Required.
                            </div>
                        </div>
                    </div>

                    <div class="-mx-3 mb-6 flex flex-wrap">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="rounded bg-green-500 px-4 py-2 font-bold text-white shadow-lg hover:bg-green-700">
                                Save Plate Number
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
