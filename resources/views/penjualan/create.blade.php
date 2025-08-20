@extends('layouts.app')

@section('content')
    <h1>Buat Transaksi Baru</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Pelanggan</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>

        <h3>Produk</h3>
        @foreach ($products as $product)
            <div style="margin-bottom: 10px;">
                <input type="checkbox" name="product_ids[]" value="{{ $product->id_produk }}" id="product_{{ $product->id_produk }}">
                <label for="product_{{ $product->id_produk }}">{{ $product->nama_produk }} (Rp {{ number_format($product->harga, 0, ',', '.') }}) - Stok: {{ $product->stok }}</label>
                <input type="number" name="quantities[{{ $product->id_produk }}]" placeholder="Qty" min="1" value="1" style="width: 60px;">
            </div>
        @endforeach

        <button type="submit" class="btn btn-success mt-3">Simpan Transaksi</button>
    </form>
@endsection
