<x-app-layout>
    <div class="p-6">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold">Riwayat Transaksi</h2>
            <p class="text-sm text-gray-500">Lumpia Beef Twins</p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Total transaksi</p>
                <p class="text-2xl font-semibold text-purple-600">
                    {{ $transaksis->count() }}
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Total penjualan</p>
                <p class="text-2xl font-semibold text-blue-600">
                    Rp {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- FILTER BERDASARKAN TANGGAL -->
        <form method="GET" action="{{ route('transaksi.riwayat') }}" class="flex flex-wrap gap-3 items-center mb-6">

            <div>
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                    class="border rounded px-3 py-2 text-sm">
            </div>

            <div>
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                    class="border rounded px-3 py-2 text-sm">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                Filter
            </button>

            @if(request('tanggal_mulai') || request('tanggal_akhir'))
                <a href="{{ route('transaksi.riwayat') }}" class="text-sm text-gray-500 hover:underline">
                    Reset
                </a>
            @endif
        </form>

        <!-- Table -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">No. Transaksi</th>
                        <th class="px-4 py-3">Tanggal / Jam</th>
                        <th class="px-4 py-3">Kasir</th>
                        <th class="px-4 py-3">Total item</th>
                        <th class="px-4 py-3">Total pembayaran</th>
                        <th class="px-4 py-3">Metode bayar</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td class="px-4 py-3 font-medium">
                                {{ $transaksi->kode_transaksi }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $transaksi->tanggal_transaksi->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $transaksi->user->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $transaksi->detailTransaksi->sum('qty') }}
                            </td>

                            <td class="px-4 py-3 text-center font-semibold">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ strtoupper($transaksi->metode_pembayaran) }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('transaksi.show', $transaksi->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-blue-50 text-blue-600">
                                    <!-- Eye Icon (Heroicons style) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639 C3.423 7.51 7.36 4.5 12 4.5 c4.638 0 8.573 3.007 9.963 7.178 .07.207.07.431 0 .639 C20.577 16.49 16.64 19.5 12 19.5 c-4.638 0-8.573-3.007-9.964-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-400">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>