@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjualan ID: {{ $detail->id_detail }}</h1>

    <p><strong>Produk:</strong> {{ $detail->produk->nama_produk }}</p>
    <p><strong>Kategori:</strong> {{ $detail->kategori }}</p>
    <p><strong>Harga Satuan:</strong> Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
    <p><strong>Subtotal:</strong> Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
    <a href="{{ route('detail-penjualan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
