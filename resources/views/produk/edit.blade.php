@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Produk</h1>

    <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
        </div>

        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" step="0.01" name="harga_satuan" class="form-control" value="{{ $produk->harga_satuan }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="per ball" {{ $produk->kategori == 'per ball' ? 'selected' : '' }}>per ball</option>
                <option value="1 kg" {{ $produk->kategori == '1 kg' ? 'selected' : '' }}>1 kg</option>
                <option value="1/2 kg" {{ $produk->kategori == '1/2 kg' ? 'selected' : '' }}>1/2 kg</option>
                <option value="1/4 kg" {{ $produk->kategori == '1/4 kg' ? 'selected' : '' }}>1/4 kg</option>
                <option value="1 bungkus" {{ $produk->kategori == '1 bungkus' ? 'selected' : '' }}>1 bungkus</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="level_rasa" class="form-label">Level / Rasa</label>
            <input type="text" name="level_rasa" class="form-control" value="{{ $produk->level_rasa }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection