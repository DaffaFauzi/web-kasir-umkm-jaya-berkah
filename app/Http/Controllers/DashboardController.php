<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalPendapatan = Penjualan::sum('total_harga');

        // Grafik penjualan 7 hari terakhir
        $penjualanHarian = Penjualan::selectRaw('DATE(tgl) as tanggal, SUM(total_harga) as total')
            ->where('tgl', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $tanggal = $penjualanHarian->pluck('tanggal')->map(fn($tgl) => Carbon::parse($tgl)->format('d M'));
        $total = $penjualanHarian->pluck('total');

        // Riwayat transaksi terbaru
        $riwayat = Penjualan::with(['pelanggan', 'user'])
            ->orderBy('tgl', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProduk', 'totalPelanggan', 'totalPenjualan', 'totalPendapatan',
            'tanggal', 'total', 'riwayat'
        ));
    }
}
