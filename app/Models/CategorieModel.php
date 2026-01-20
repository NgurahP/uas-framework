<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProdukModel as Product;

class CategorieModel extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nama_kategori',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_kategori');
    }
}
