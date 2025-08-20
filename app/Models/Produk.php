<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'harga_satuan',
        'stok',
        'kategori',
        'level_rasa',
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_produk', 'id_produk');
    }

    public function getHargaAttribute()
    {
        return $this->harga_satuan;
    }
}