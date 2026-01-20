<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiModel as Transaksi;
use App\Models\ProdukModel as Produk;
use App\Models\CategorieModel as Kategori;
use App\Models\DetailTransaksiModel as DetailTransaksi;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transaksi = Transaksi::all();
        $kategoris = Kategori::all();
        $products = Produk::when(
            $request->kategori,
            function ($query) use ($request) {
                $query->where('id_kategori', $request->kategori);
            }
        )
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_produk', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('transaksi.index', compact('transaksi', 'products', 'kategoris', ));
    }

    public function addToCart(Request $request, Produk $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
            $cart[$product->id]['subtotal'] =
                $cart[$product->id]['qty'] * $product->harga;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'nama' => $product->nama_produk,
                'harga' => $product->harga,
                'qty' => 1,
                'subtotal' => $product->harga,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }
    public function clearCart()
    {
        session()->forget('cart');
        session()->forget('metode_pembayaran');
        return redirect()->back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        $cart[$id]['qty']--;

        if ($cart[$id]['qty'] <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['subtotal'] =
                $cart[$id]['qty'] * $cart[$id]['harga'];
        }

        session()->put('cart', $cart);
        return back();
    }

    public function setPaymentMethod(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:cash,qris',
        ]);

        session()->put('metode_pembayaran', $request->metode_pembayaran);

        return back();
    }

    public function bayar(Request $request)
    {
        $cart = session('cart', []);
        $metode = session('metode_pembayaran');

        if (empty($cart)) {
            return back()->withErrors('Keranjang kosong');
        }

        if (!$metode) {
            return back()->withErrors('Metode pembayaran belum dipilih');
        }

        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $total = collect($cart)->sum('subtotal');

        if ($request->jumlah_bayar < $total) {
            return back()->withErrors('Jumlah bayar kurang');
        }

        $kembalian = $request->jumlah_bayar - $total;

        DB::beginTransaction();
        try {
            // 1. Simpan transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . now()->timestamp,
                'user_id' => auth()->id(),
                'total_harga' => $total,
                'total_bayar' => $request->jumlah_bayar,
                'kembalian' => $kembalian,
                'metode_pembayaran' => $metode,
                'tanggal_transaksi' => now(),
            ]);

            // 2. Simpan detail transaksi
            foreach ($cart as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $item['id'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();

            // 3. Bersihkan session
            session()->forget(['cart', 'metode_pembayaran']);

            // 4. Trigger modal sukses
            return redirect()
                ->route('transaksi.index')
                ->with('success_transaksi', [
                    'total' => $total,
                    'bayar' => $request->jumlah_bayar,
                    'kembalian' => $kembalian,
                ]);

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function riwayat(Request $request)
    {
        $query = Transaksi::with(['user', 'detailTransaksi']);

        // Filter tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate(
                'tanggal_transaksi',
                '>=',
                $request->tanggal_mulai
            );
        }

        // Filter tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate(
                'tanggal_transaksi',
                '<=',
                $request->tanggal_akhir
            );
        }

        $transaksis = $query
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('transaksi.riwayat', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = session('cart');
        $metode = session('metode_pembayaran');

        if (empty($cart)) {
            return back()->withErrors('Keranjang masih kosong');
        }

        if (!$metode) {
            return back()->withErrors('Pilih metode pembayaran');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::with([
            'user',
            'detailTransaksi.produk'
        ])->findOrFail($id);

        return view('transaksi.detail', compact('transaksi'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
