<x-app-layout>
    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative">

            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Detail Transaksi</h2>
                <a href="{{ route('transaksi.riwayat') }}" class="text-gray-400 hover:text-gray-600">
                    ✕
                </a>
            </div>

            <!-- Info Transaksi -->
            <div class="bg-blue-50 rounded-lg p-4 text-sm mb-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500">No. Transaksi</p>
                        <p class="font-semibold">{{ $transaksi->kode_transaksi }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tanggal / Jam</p>
                        <p class="font-semibold">
                            {{ $transaksi->tanggal_transaksi}}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Kasir</p>
                        <p class="font-semibold">{{ $transaksi->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Status</p>
                        <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Lunas
                        </span>
                    </div>
                </div>
            </div>

            <!-- Item Transaksi -->
            <div class="mb-4">
                <h3 class="text-sm font-semibold mb-2">Item Transaksi</h3>

                <div class="space-y-2">
                    @foreach ($transaksi->detailTransaksi as $detail)
                        <div class="bg-gray-50 rounded-lg p-3 flex justify-between">
                            <div>
                                <p class="font-medium">
                                    {{ $detail->produk->nama_produk }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                    x {{ $detail->qty }}
                                </p>
                            </div>
                            <p class="font-semibold text-blue-600">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="text-sm space-y-2 border-t pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-500">Sub total</span>
                    <span>
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between font-semibold">
                    <span>Total pembayaran</span>
                    <span class="text-blue-600">
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </span>
                </div>

                <div class="mt-3">
                    <p class="font-medium">Pembayaran</p>
                    <div class="flex justify-between text-sm mt-1">
                        <span>{{ ucfirst($transaksi->metode_pembayaran) }}</span>
                        <span>
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm text-green-600">
                        <span>Kembalian</span>
                        <span>
                            Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action -->
            <div class="flex gap-3 mt-6">
                <a href="{{ route('transaksi.riwayat') }}"
                    class="flex-1 border rounded-lg py-2 text-center text-gray-600 hover:bg-gray-100">
                    Tutup
                </a>

                <button
                    class="flex-1 bg-blue-600 text-white rounded-lg py-2 hover:bg-blue-700">
                    🖨 Cetak ulang
                </button>
            </div>

        </div>
    </div>
</x-app-layout>
