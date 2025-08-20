@extends('layouts.app')

@section('content')
    <h1>Detail Transaksi</h1>

    <p><strong>Tanggal Transaksi:</strong> {{ $transaction->tgl_penjualan }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>

    <h3>Detail Produk:</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('penjualan.index') }}">Kembali ke daftar transaksi</a>
@endsection