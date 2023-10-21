<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('owner.brands.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Buat Brand
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td class="px-4 py-2">{{ $brand->id }}</td>
                                <td class="px-4 py-2">{{ $brand->name }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('owner.brands.edit', $brand->id) }}"
                                       class="px-4 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700"
                                       onsubmit="return confirm('Apakah Anda yakin ingin mengedit brand ini?')">Edit</a>
                                    <form action="{{ route('owner.brands.destroy', $brand->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus brand {{$brand->name}} ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-red-700">Hapus
                                        </button>
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
