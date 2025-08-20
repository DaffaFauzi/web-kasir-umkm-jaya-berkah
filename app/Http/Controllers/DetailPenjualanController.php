<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use PDF;

class DetailPenjualanController extends Controller
{
    public function create()
    {
        $produk = Produk::all();
        return view('detail_penjualan.create', compact('produk'));
    }

    public function index()
    {
        $details = DetailPenjualan::with('produk', 'penjualan')->get();
        return view('detail_penjualan.index', compact('details'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penjualan' => 'required|exists:penjualan,id_penjualan',
            'id_produk' => 'required|exists:produk,id_produk',
            'qty' => 'required|integer|min:1',
        ]);

        $penjualan = Penjualan::find($request->id_penjualan);

        if (!$penjualan) {
            return back()->withErrors(['Penjualan tidak ditemukan.']);
        }

        $produk = Produk::find($request->id_produk);

        if (!$produk) {
            return back()->withErrors(['Produk tidak ditemukan.']);
        }

        $subtotal = $produk->harga * $request->qty;

        DetailPenjualan::create([
            'id_penjualan' => $request->id_penjualan,
            'id_produk'    => $request->id_produk,
            'kategori'     => $produk->kategori,
            'harga_satuan' => $produk->harga,
            'qty'          => $request->qty,
            'subtotal'     => $subtotal,
        ]);

        return redirect()->route('detail-penjualan.index')->with('success', 'Detail penjualan berhasil ditambahkan.');
    }

    // ✅ Tambah method show
    public function show($id)
    {
        $detail = DetailPenjualan::with('produk')->findOrFail($id);
        return view('detail_penjualan.show', compact('detail'));
    }

    // ✅ Tambah method downloadPdf
    public function downloadPdf($id)
    {
        $detail = DetailPenjualan::with('produk')->findOrFail($id);
        $pdf = \PDF::loadView('detail_penjualan.pdf', compact('detail'));
        return $pdf->download('detail-penjualan-' . $id . '.pdf');
    }
}
