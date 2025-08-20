@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Produk</h1>

    <a href="{{ route('produk.create') }}" class="btn btn-success mb-3">Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Level & Rasa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $key => $produk)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>Rp {{ number_format($produk->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->kategori }}</td>
                    <td>{{ $produk->level_rasa }}</td>
                    <td>
    <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-primary">Edit</a>
    <form action="{{ route('produk.destroy', $produk) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
    </form>
</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection