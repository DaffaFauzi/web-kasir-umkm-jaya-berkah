<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Penjualan::with('details.produk')->latest()->get();
        return view('penjualan.index', compact('transactions'));
    }

    public function create()
    {
        $products = Produk::all();
        return view('penjualan.create', compact('products'));
    }

    public function destroy(Penjualan $penjualan)
    {
        foreach ($penjualan->details as $detail) {
            $product = $detail->produk;
            if ($product) {
                $product->increment('stok', $detail->qty);
            }
        }

        $penjualan->details()->delete();
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function show($id)
    {
        $transaction = Penjualan::with('details.produk')->findOrFail($id);
        return view('penjualan.show', compact('transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:produk,id_produk',
            'quantities' => 'required|array',
        ]);

        $pelanggan = Pelanggan::firstOrCreate(
            ['nama' => $request->customer_name],
            [
                'tanggal' => now(),
                'id_produk' => $request->product_ids[0] ?? null,
                'qty' => $request->quantities[$request->product_ids[0]] ?? 1,
            ]
        );

        $penjualan = Penjualan::create([
            'tgl' => now(),
            'id_pembeli' => $pelanggan->id_pembeli,
            'total_harga' => 0,
            'id_user' => Auth::id(),
        ]);

        $total = 0;

foreach ($request->product_ids as $productId) {
    $product = Produk::findOrFail($productId);
    $quantity = $request->quantities[$productId];

    if ($quantity > $product->stok) {
        return redirect()->back()->withErrors("Stok tidak cukup untuk {$product->nama_produk}");
    }

    $subtotal = $product->harga * $quantity;

    DetailPenjualan::create([
        'id_penjualan' => $penjualan->id_penjualan,
        'id_produk' => $product->id_produk,
        'kategori' => $product->kategori, // ✅ Tambahkan ini
        'harga_satuan' => $product->harga,
        'qty' => $quantity,
        'subtotal' => $subtotal,
    ]);

    $total += $subtotal;

    $product->decrement('stok', $quantity);
}


        $penjualan->update(['total_harga' => $total]);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
