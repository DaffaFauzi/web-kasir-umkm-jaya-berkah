<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'id_produk' => 'nullable|exists:produk,id_produk',
            'kategori' => 'nullable|string|max:255',
            'qty' => 'nullable|integer|min:1',
            'total' => 'nullable|numeric',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        $produks = Produk::all();
        return view('pelanggan.edit', compact('pelanggan', 'produks'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'id_produk' => 'required|exists:produk,id_produk',
            'qty' => 'required|numeric|min:1',
        ]);

        $produk = Produk::findOrFail($request->id_produk);
        $validated['kategori'] = $produk->kategori;
        $validated['total'] = $produk->harga_satuan * $validated['qty'];

        $pelanggan->update($validated);

        return redirect('/pelanggan')->with('success', 'Pelanggan diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect('/pelanggan')->with('success', 'Pelanggan dihapus!');
    }
}