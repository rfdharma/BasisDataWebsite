<x-app-layout>
    <x-slot name="title">Brand Car</x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('owner.brands.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Add Brand
                </a>
            </div>
            @if ($errors->any())
                <div class="mb-5" role="alert">
                    <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                        Ada kesalahan!
                    </div>
                    <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                        <p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-5" role="alert">
                    <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                        Terjadi Kesalahan!
                    </div>
                    <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table class="text-center table-auto border w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 border-2">ID</th>
                            <th class="px-4 py-2 border-2">Nama</th>
                            <th class="px-4 py-2 border-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td class="px-4 py-2 border-2">{{ $brand->id }}</td>
                                <td class="px-4 py-2 border-2">{{ $brand->name }}</td>
                                <td class="px-4 py-2 border-2">
                                    <a href="{{ route('owner.brands.edit', $brand->id) }}"
                                       class="px-3 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700"
                                       onsubmit="return confirm('Apakah Anda yakin ingin mengedit brand ini?')">Edit</a>
                                    <form action="{{ route('owner.brands.destroy', $brand->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus brand {{$brand->name}} ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-1 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-red-700">Hapus
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
