@extends('layouts.app')

@section('content')
    <h1>Detail Order</h1>
    <p>Customer: {{ $order->customer_name }}</p>
    <h4>Produk:</h4>
    <ul>
        @foreach ($order->products as $product)
            <li>{{ $product->name }} (Rp{{ number_format($product->price) }})</li>
        @endforeach
    </ul>
    <a href="{{ route('orders.index') }}">Kembali</a>
@endsection
