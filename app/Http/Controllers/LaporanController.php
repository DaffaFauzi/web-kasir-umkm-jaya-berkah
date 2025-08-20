<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    // Ambil data penjualan dan relasi pelanggan, user
    $query = Penjualan::with('pelanggan', 'user');

    // Cek apakah user mengisi tanggal filter
    if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
        $query->whereBetween('tgl', [
            $request->tanggal_mulai,
            $request->tanggal_selesai
        ]);
    }

    // Ambil hasil query
    $penjualans = $query->get();

    // Kirim ke view
    return view('laporan.index', compact('penjualans'));
}

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'details.produk', 'user')->findOrFail($id);
        return view('laporan.show', compact('penjualan'));
    }

    public function struk(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        $penjualans = Penjualan::with('pelanggan', 'details.produk', 'user')
            ->whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])
            ->get();

        $total = $penjualans->sum('total_harga');

        return view('laporan.struk', compact('penjualans', 'tanggal_mulai', 'tanggal_selesai', 'total'));
    }

    public function downloadPdf(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        $penjualans = Penjualan::with('pelanggan', 'details.produk', 'user')
            ->whereBetween('tgl', [$tanggal_mulai, $tanggal_selesai])
            ->get();

        $total = $penjualans->sum('total_harga');

        $pdf = Pdf::loadView('laporan.struk', compact('penjualans', 'tanggal_mulai', 'tanggal_selesai', 'total'));
        return $pdf->download('laporan-struk-'.$tanggal_mulai.'-sd-'.$tanggal_selesai.'.pdf');
    }
}