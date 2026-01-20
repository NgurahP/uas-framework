<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TransaksiModel as Transaksi;
use App\Models\ProdukModel as Produk;

class DetailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(
            TransaksiModel::class,
            'transaksi_id',
            'id'
        );
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
