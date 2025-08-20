@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Data Pelanggan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">+ Tambah Pelanggan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Tanggal</th>
    <th>Alamat</th>
    <th>No. HP</th>
    <th>Produk</th>
    <th>Kategori</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

        </thead>
        <tbody>
            @foreach($pelanggan as $p)
            <tr>
    <td>{{ $p->id_pembeli }}</td>
    <td>{{ $p->nama }}</td>
    <td>{{ $p->tanggal }}</td>
    <td>{{ $p->alamat }}</td>
    <td>{{ $p->no_hp }}</td>
    <td>{{ $p->produk->nama_produk ?? '-' }}</td>
    <td>{{ $p->kategori }}</td>
    <td>{{ $p->qty }}</td>
    <td>Rp {{ number_format($p->total) }}</td>
    <td>
        <a href="{{ route('pelanggan.edit', $p->id_pembeli) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('pelanggan.destroy', $p->id_pembeli) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Hapus pelanggan ini?')" class="btn btn-sm btn-danger">Hapus</button>
        </form>
    </td>
</tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection