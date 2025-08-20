@extends('layouts.app')

@section('content')
    <h1>Daftar Order</h1>
    <a href="{{ route('orders.create') }}">Tambah Order</a>
    @foreach ($orders as $order)
        <div>
            <h4>{{ $order->customer_name }}</h4>
            <ul>
                @foreach ($order->products as $product)
                    <li>{{ $product->name }} (Rp{{ number_format($product->price) }})</li>
                @endforeach
            </ul>
            <a href="{{ route('orders.show', $order->id) }}">Lihat</a>
            <a href="{{ route('orders.edit', $order->id) }}">Edit</a>
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
    @endforeach
@endsection
