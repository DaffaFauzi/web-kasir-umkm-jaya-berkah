<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'nama_produk' => 'required',
    'harga_satuan' => 'required|numeric',
    'stok' => 'required|numeric',
    'kategori' => 'required',
    'level_rasa' => 'nullable|string',
]);

Produk::create($request->except('sub_total'));

        return redirect('/produk')->with('success', 'Produk ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
    'nama_produk' => 'required',
    'harga_satuan' => 'required|numeric',
    'stok' => 'required|numeric',
    'kategori' => 'required',
    'level_rasa' => 'nullable|string',
]);

$produk = Produk::findOrFail($id);
$produk->update($request->except('sub_total'));

        return redirect('/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect('/produk')->with('success', 'Produk berhasil dihapus!');
    }
}