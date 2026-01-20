<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Penjualan</h2>
    <p>
        Periode :
        {{ $start->format('d/m/Y') }} -
        {{ $end->format('d/m/Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th class="center">Jumlah Transaksi</th>
                <th class="right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanHarian as $row)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                    <td class="center">{{ $row->jumlah_transaksi }}</td>
                    <td class="right">
                        Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <p>
        <strong>Total Transaksi:</strong> {{ $totalTransaksi }} <br>
        <strong>Total Pendapatan:</strong>
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }} <br>
        <strong>Rata-rata:</strong>
        Rp {{ number_format($rataRata, 0, ',', '.') }}
    </p>

</body>

</html>