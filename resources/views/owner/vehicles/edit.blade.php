<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{ route('owner.vehicles.index') }}">
                ← Kembali
            </a>
            Edit Kendaraan: {{ $vehicle->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="rounded-t bg-red-500 text-white px-4 py-2 font-bold">
                            Terdapat kesalahan!
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

                <form class="w-full" action="{{ route('owner.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input untuk Nama Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="name">
                                Nama Kendaraan*
                            </label>
                            <input value="{{ old('name') ?? $vehicle->name }}" name="name"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Nama Kendaraan" required />
                            <div class="mt-2 text-sm text-gray-500">
                                Nama kendaraan. Contoh: Kendaraan 1, Kendaraan 2, Kendaraan 3, dsb. Wajib diisi. Maksimal 255 karakter.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Type Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="type_id">Type*</label>
                            <select name="type_id"
                                    class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                    required>
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id', $vehicle->type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Type of the vehicle. E.g., Sport Car, Electric Car, etc. Required.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Brand ID -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="brand_id">
                                Merek Kendaraan*
                            </label>
                            <select name="brand_id" id="brand_id" class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" required>
                                <option value="" disabled selected>Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $vehicle->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Pilih merek kendaraan. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Capacity -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="capacity">
                                Kapasitas*
                            </label>
                            <input value="{{ old('capacity') ?? $vehicle->capacity }}" name="capacity"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Kapasitas Kendaraan" required />
                            <div class="mt-2 text-sm text-gray-500">
                                Kapasitas kendaraan. Contoh: 4 orang. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Harga Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="price">
                                Harga Kendaraan
                            </label>
                            <input value="{{ old('price') ?? $vehicle->price }}" name="price"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="number" placeholder="Harga Kendaraan" />
                            <div class="mt-2 text-sm text-gray-500">
                                Harga kendaraan. Contoh: 1000000. Opsional.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Fitur Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="features">
                                Fitur Kendaraan
                            </label>
                            <input value="{{ old('features') ?? $vehicle->features }}" name="features"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Fitur Kendaraan" />
                            <div class="mt-2 text-sm text-gray-500">
                                Fitur kendaraan. Misalnya: Fitur 1, Fitur 2, Fitur 3, dsb. Opsional.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Menambah Foto Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                Tambah Foto Kendaraan
                            </label>
                            <input name="photos[]" accept="image/*" multiple type="file"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" />
                            <div class="mt-2 text-sm text-gray-500">
                                Unggah satu atau lebih foto kendaraan. Opsional.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

                    <!-- Tampilan Foto Kendaraan yang Sudah Ada -->
                    @if ($photos !== null && count($photos) > 0)
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold leading-tight text-gray-800">List Foto Kendaraan {{$vehicle->name}}</h2>
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                @foreach ($photos as $photo)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $photo->photos) }}" alt="Vehicle Photo" class="w-full h-40 object-cover">
                                        <form action="{{ route('owner.vehicles.deletePhoto', ['vehicle' => $vehicle, 'id' => $photo->id]) }}" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Are you sure you want to delete this photo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white p-1 rounded-full hover:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M6.293 5.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</x-app-layout>
