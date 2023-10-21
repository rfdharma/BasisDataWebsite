<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('owner.types.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Buat Type
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
                        @foreach ($types as $type)
                            <tr>
                                <td class="px-4 py-2">{{ $type->id }}</td>
                                <td class="px-4 py-2">{{ $type->name }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('owner.types.edit', $type->id) }}"
                                       class="px-4 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700"
                                       onsubmit="return confirm('Apakah Anda yakin ingin mengedit type ini?">Edit</a>
                                    <form action="{{ route('owner.types.destroy', $type->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus type {{ $type->name }} ini?')">
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
