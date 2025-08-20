@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjualan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('detail-penjualan.create') }}" class="btn btn-primary mb-3">+ Tambah Detail</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $d)
            <tr>
                <td>{{ $d->produk->nama_produk ?? '-' }}</td>
                <td>{{ $d->kategori }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('detail-penjualan.show', $d->id_detail) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('detail-penjualan.download', $d->id_detail) }}" class="btn btn-success btn-sm">PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
