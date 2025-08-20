@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Detail Penjualan</h1>

    <form action="{{ route('detail-penjualan.update', $detail_penjualan->id_detail) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_penjualan" class="form-label">Penjualan</label>
            <select name="id_penjualan" class="form-control" required>
                @foreach($penjualan as $p)
                    <option value="{{ $p->id_penjualan }}" {{ $detail_penjualan->id_penjualan == $p->id_penjualan ? 'selected' : '' }}>
                        {{ $p->tgl_penjualan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_produk" class="form-label">Produk</label>
            <select name="id_produk" class="form-control" required>
                @foreach($produk as $pr)
                    <option value="{{ $pr->id_produk }}" {{ $detail_penjualan->id_produk == $pr->id_produk ? 'selected' : '' }}>
                        {{ $pr->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $detail_penjualan->jumlah }}" required>
        </div>
        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" name="subtotal" class="form-control" value="{{ $detail_penjualan->subtotal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('detail-penjualan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
