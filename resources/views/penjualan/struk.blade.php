@extends('layouts.app')

@section('content')
    <h2>Struk Penjualan</h2>

    <p><strong>Tanggal:</strong> {{ $transaction->tgl }}</p>
    <p><strong>Pelanggan:</strong> {{ $transaction->pelanggan->nama_pelanggan ?? '-' }}</p>
    <p><strong>Kasir:</strong> {{ $transaction->user->name ?? '-' }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>

    <h4>Rincian Produk:</h4>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('penjualan.struk-pdf', $transaction->id_penjualan) }}" class="btn btn-primary" target="_blank">Download PDF</a>
    <button onclick="window.print()" class="btn btn-success">Cetak Struk</button>
    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
@endsection