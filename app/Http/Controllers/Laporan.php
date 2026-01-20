<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiModel as Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Laporan extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal
        $start = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();

        $end = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        // Ambil transaksi
        $transaksis = Transaksi::whereBetween('tanggal_transaksi', [$start, $end])
            ->get();

        // Statistik
        $totalTransaksi = $transaksis->count();
        $totalPendapatan = $transaksis->sum('total_harga');
        $rataRata = $totalTransaksi > 0
            ? $totalPendapatan / $totalTransaksi
            : 0;

        // Laporan harian
        $laporanHarian = Transaksi::select(
            DB::raw('DATE(tanggal_transaksi) as tanggal'),
            DB::raw('COUNT(*) as jumlah_transaksi'),
            DB::raw('SUM(total_harga) as total_pendapatan')
        )
            ->whereBetween('tanggal_transaksi', [$start, $end])
            ->groupBy(DB::raw('DATE(tanggal_transaksi)'))
            ->orderBy('tanggal')
            ->get();

        return view('laporan.index', compact(
            'start',
            'end',
            'totalTransaksi',
            'totalPendapatan',
            'rataRata',
            'laporanHarian'
        ));
    }

    public function cetak(Request $request)
    {
        $start = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();

        $end = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        $laporanHarian = Transaksi::select(
            DB::raw('DATE(tanggal_transaksi) as tanggal'),
            DB::raw('COUNT(*) as jumlah_transaksi'),
            DB::raw('SUM(total_harga) as total_pendapatan')
        )
            ->whereBetween('tanggal_transaksi', [$start, $end])
            ->groupBy(DB::raw('DATE(tanggal_transaksi)'))
            ->orderBy('tanggal')
            ->get();

        $totalTransaksi = $laporanHarian->sum('jumlah_transaksi');
        $totalPendapatan = $laporanHarian->sum('total_pendapatan');
        $rataRata = $totalTransaksi > 0
            ? $totalPendapatan / $totalTransaksi
            : 0;

        $pdf = Pdf::loadView('laporan.cetak', compact(
            'start',
            'end',
            'laporanHarian',
            'totalTransaksi',
            'totalPendapatan',
            'rataRata'
        ));

        return $pdf->download('laporan-penjualan.pdf');
    }

}
