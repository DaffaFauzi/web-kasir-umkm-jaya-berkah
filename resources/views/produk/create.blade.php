@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Produk</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" required>
        </div>
        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" step="0.01" name="harga_satuan" class="form-control" value="{{ old('harga_satuan') }}" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="per ball">per ball</option>
                <option value="1 kg">1 kg</option>
                <option value="1/2 kg">1/2 kg</option>
                <option value="1/4 kg">1/4 kg</option>
                <option value="1 bungkus">1 bungkus</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="level_rasa" class="form-label">Level / Rasa</label>
            <input type="text" name="level_rasa" class="form-control" value="{{ old('level_rasa') }}">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection