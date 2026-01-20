<x-app-layout>

    <div class="p-6 space-y-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold">Manajemen Kategori</h2>
                <p class="text-sm text-gray-500">Lumpia Beef Twins</p>
            </div>

            <div class="text-sm text-gray-600 text-right">
                <p>Waktu</p>
                <p class="font-semibold">{{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <!-- ACTION BAR -->
        <div class="flex justify-between items-center">

            <!-- Tambah Produk -->
            <a href="{{ route('kategori.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium">
                ➕ Tambah Kategori
            </a>

            <!-- Search -->
            <form method="GET" action="{{ route('kategori.index') }}" class="relative">
                <input type="text" name="search" placeholder="Cari nama kategori..." value="{{ request('search') }}"
                    class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring focus:ring-blue-200">
                <span class="absolute left-3 top-2.5 text-gray-400 text-sm">
                    🔍
                </span>
            </form>

        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE PRODUK -->
        <div class="bg-white rounded shadow">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">ID Kategori</th>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($kategoris as $kategori)
                        <tr>
                            <td class="px-4 py-3">{{ $kategori->id }}</td>
                            <td class="px-4 py-3 text-center">{{ $kategori->nama_kategori }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                    class="px-3 py-1 bg-yellow-400 rounded text-xs">Edit</a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>