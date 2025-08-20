@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pelanggan</h1>

    <form action="{{ route('pelanggan.update', $pelanggan->id_pembeli) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
    <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
    <input type="text" class="form-control" value="{{ $pelanggan->id_pembeli }}" readonly>
</div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $pelanggan->alamat }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pelanggan->no_hp }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $pelanggan->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah (QTY)</label>
            <input type="number" name="qty" class="form-control" value="{{ $pelanggan->qty }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection