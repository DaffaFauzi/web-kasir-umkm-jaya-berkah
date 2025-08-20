<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        $transactions = Penjualan::with(['pelanggan', 'user'])->get();
        return view('penjualan.index', compact('transactions'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $user = User::all();
        return view('penjualan.create', compact('pelanggan', 'user'));
    }

    public function store(Request $request)
    {
        Penjualan::create($request->all());
        return redirect('/penjualan')->with('success', 'Penjualan ditambahkan!');
    }

    public function edit(Penjualan $penjualan)
    {
        $pelanggan = Pelanggan::all();
        $user = User::all();
        return view('penjualan.edit', compact('penjualan', 'pelanggan', 'user'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $penjualan->update($request->all());
        return redirect('/penjualan')->with('success', 'Penjualan diperbarui!');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect('/penjualan')->with('success', 'Penjualan dihapus!');
    }

    public function show($id)
    {
        $transaction = Penjualan::with('details.produk', 'pelanggan', 'user')->findOrFail($id);
        return view('penjualan.show', compact('transaction'));
    }

    public function struk($id)
    {
        $transaction = Penjualan::with('details.produk', 'pelanggan', 'user')->findOrFail($id);
        return view('penjualan.struk', compact('transaction'));
    }

    public function strukPdf($id)
    {
        $transaction = Penjualan::with('details.produk', 'pelanggan', 'user')->findOrFail($id);
        $pdf = Pdf::loadView('penjualan.struk_pdf', compact('transaction'));
        return $pdf->download('struk-penjualan-' . $id . '.pdf');
    }
}