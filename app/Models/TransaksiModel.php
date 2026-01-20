<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksiModel as DetailTransaksi;
use App\Models\User;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'total_harga',
        'total_bayar',
        'kembalian',
        'metode_pembayaran',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'total_harga' => 'decimal:2',
        'total_bayar' => 'decimal:2',
        'kembalian' => 'decimal:2',
    ];

    /* ================= RELATION ================= */

    // Transaksi dilakukan oleh user (kasir / admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu transaksi punya banyak detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'id');
    }
}
