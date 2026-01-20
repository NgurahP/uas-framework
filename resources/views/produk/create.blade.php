<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf

                    <!-- Kode Produk -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Kode Produk</label>
                        <input type="text" name="kode_produk" value="{{ old('kode_produk') }}"
                            class="w-full border rounded px-3 py-2" placeholder="LMP-001" required>
                        @error('kode_produk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Produk -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                            class="w-full border rounded px-3 py-2" required>
                        @error('nama_produk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Harga</label>
                        <input type="number" name="harga" value="{{ old('harga') }}"
                            class="w-full border rounded px-3 py-2" required>
                        @error('harga')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Stok</label>
                        <input type="number" name="stok" value="{{ old('stok') }}"
                            class="w-full border rounded px-3 py-2" required>
                        @error('stok')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Kategori</label>
                        <select
                            name="id_kategori"
                            class="w-full border rounded px-3 py-2"
                            required
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end">
                        <a href="{{ route('produk.index') }}" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>