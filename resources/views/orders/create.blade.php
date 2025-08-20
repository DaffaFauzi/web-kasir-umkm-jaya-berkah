@extends('layouts.app')

@section('content')
    <h1>Tambah Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <label>Nama Customer</label>
        <input type="text" name="customer_name">

        <label>Produk</label>
        @foreach ($products as $product)
            <div>
                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}">
                {{ $product->name }} (Rp{{ number_format($product->price) }})
            </div>
        @endforeach

        <button type="submit">Simpan</button>
    </form>
@endsection
