<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pembeli';

    public $incrementing = true;
    protected $keyType = 'int'; // BIGINT tetap int

    protected $fillable = [
        'nama', 'tanggal', 'alamat', 'no_hp', 'id_produk', 'kategori', 'qty', 'total'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}