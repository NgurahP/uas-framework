<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel as Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // =========================
        // CARD RINGKASAN
        // =========================
        $totalTransaksiHariIni = Transaksi::whereDate('tanggal_transaksi', $today)
            ->count();

        $totalPendapatanHariIni = Transaksi::whereDate('tanggal_transaksi', $today)
            ->sum('total_harga');

        // =========================
        // CHART GARIS (7 HARI)
        // =========================
        $pendapatanHarian = Transaksi::select(
                DB::raw('DATE(tanggal_transaksi) as tanggal'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // =========================
        // CHART LINGKARAN
        // =========================
        $metodePembayaran = Transaksi::select(
                'metode_pembayaran',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('metode_pembayaran')
            ->get();

        // =========================
        // PRODUK TERLARIS
        // =========================
        $produkTerlaris = DB::table('detail_transaksi')
            ->join('products', 'products.id', '=', 'detail_transaksi.produk_id')
            ->select('products.nama_produk', DB::raw('SUM(detail_transaksi.qty) as terjual'))
            ->groupBy('products.nama_produk')
            ->orderByDesc('terjual')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalTransaksiHariIni',
            'totalPendapatanHariIni',
            'pendapatanHarian',
            'metodePembayaran',
            'produkTerlaris'
        ));
    }
}
