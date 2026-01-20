<x-app-layout>

    <div class="p-6 space-y-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold">Kasir</h2>
                <p class="text-sm text-gray-500">Lumpia Beef Twins</p>
            </div>

            <div class="text-sm text-gray-600 text-right">
                <p>Waktu</p>
                <p class="font-semibold">{{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>

        <form method="GET" action="{{ route('laporan.index') }}"
            class="flex items-center gap-4 bg-white p-4 rounded shadow">

            <div class="flex items-center gap-2">
                <span>📅 Filter periode :</span>
                <input type="date" name="start_date" value="{{ request('start_date', $start->toDateString()) }}"
                    class="border rounded px-2 py-1">

                <span>-</span>

                <input type="date" name="end_date" value="{{ request('end_date', $end->toDateString()) }}"
                    class="border rounded px-2 py-1">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded text-sm">
                Filter
            </button>

            <a href="{{ route('laporan.cetak', request()->query()) }}"
                class="ml-auto px-4 py-2 bg-blue-700 text-white rounded text-sm">
                Cetak Laporan
            </a>
        </form>
        <div class="grid grid-cols-3 gap-4">

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Total transaksi</p>
                <p class="text-2xl font-semibold text-purple-600">
                    {{ $totalTransaksi }}
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Total pendapatan</p>
                <p class="text-2xl font-semibold text-blue-600">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-sm text-gray-500">Rata-rata transaksi</p>
                <p class="text-2xl font-semibold text-orange-500">
                    Rp {{ number_format($rataRata, 0, ',', '.') }}
                </p>
            </div>

        </div>
        <div class="bg-white rounded shadow">
            <div class="p-4 border-b font-semibold">
                Laporan Penjualan Harian Per Periode :
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-center">Jumlah Transaksi</th>
                        <th class="px-4 py-3 text-right">Total Pendapatan</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($laporanHarian as $row)
                        <tr>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                {{ $row->jumlah_transaksi }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-400">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>