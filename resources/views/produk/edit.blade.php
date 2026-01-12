<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="mb-4">
                        <label class="block mb-1">Nama Produk</label>
                        <input type="text" name="nama"
                            value="{{ old('nama', $produk->nama) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label class="block mb-1">Harga</label>
                        <input type="number" name="harga"
                            value="{{ old('harga', $produk->harga) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>

                    <!-- Stok -->
                    <div class="mb-4">
                        <label class="block mb-1">Stok</label>
                        <input type="number" name="stok"
                            value="{{ old('stok', $produk->stok) }}"
                            class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('produk.index') }}"
                           class="mr-2 px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
