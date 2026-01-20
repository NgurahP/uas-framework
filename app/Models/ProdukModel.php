<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategorieModel as Kategori;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga',
        'stok',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
