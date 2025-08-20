<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';

    protected $fillable = [
        'tgl', 'id_pembeli', 'total_harga', 'id_user',
    ];

    // app/Models/Penjualan.php
public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'id_pembeli');
}

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id_penjualan');
    }
}