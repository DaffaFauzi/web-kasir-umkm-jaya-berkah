@extends('layouts.app')

@section('content')
    <h1>Edit Order</h1>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Customer</label>
        <input type="text" name="customer_name" value="{{ $order->customer_name }}">

        <label>Produk</label>
        @foreach ($products as $product)
            <div>
                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" {{ $order->products->contains($product->id) ? 'checked' : '' }}>
                {{ $product->name }} (Rp{{ number_format($product->price) }})
            </div>
        @endforeach

        <button type="submit">Update</button>
    </form>
@endsection
