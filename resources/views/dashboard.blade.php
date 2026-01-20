<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-5 rounded shadow">
                <p class="text-sm text-gray-500">Total Transaksi Hari Ini</p>
                <h3 class="text-2xl font-bold text-purple-600">
                    {{ $totalTransaksiHariIni }}
                </h3>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <p class="text-sm text-gray-500">Total Pendapatan Hari Ini</p>
                <h3 class="text-2xl font-bold text-blue-600">
                    Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        {{-- CHART --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-3">Pendapatan Harian</h3>
                <canvas id="lineChart"></canvas>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-3">Metode Pembayaran</h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        {{-- PRODUK TERLARIS --}}
        <div class="bg-white p-5 rounded shadow">
            <h3 class="font-semibold mb-3">Produk Terlaris</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="text-left">Produk</th>
                        <th class="text-right">Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produkTerlaris as $item)
                        <tr class="border-b">
                            <td>{{ $item->nama_produk }}</td>
                            <td class="text-right">{{ $item->terjual }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const lineCanvas = document.getElementById('lineChart');
        if (lineCanvas) {
            new Chart(lineCanvas, {
                type: 'line',
                data: {
                    labels: {!! json_encode($pendapatanHarian->pluck('tanggal')) !!},
                    datasets: [{
                        label: 'Pendapatan',
                        data: {!! json_encode($pendapatanHarian->pluck('total')) !!},
                        borderWidth: 2
                    }]
                }
            });
        }

        const pieCanvas = document.getElementById('pieChart');
        if (pieCanvas) {
            new Chart(pieCanvas, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($metodePembayaran->pluck('metode_pembayaran')) !!},
                    datasets: [{
                        data: {!! json_encode($metodePembayaran->pluck('total')) !!}
                    }]
                }
            });
        }
    </script>

</x-app-layout>