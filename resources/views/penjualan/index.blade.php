@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Transaksi</h1>

    <a href="{{ route('penjualan.create') }}" class="btn btn-success mb-3">Tambah Transaksi</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $trx)
                        <tr>
                            <td>{{ $trx->id_penjualan }}</td>
                            <td>{{ $trx->tgl }}</td>
                            <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('penjualan.show', $trx->id_penjualan) }}" class="btn btn-info btn-sm">Lihat</a>
                            </td>
                            <td>
                                <form action="{{ route('penjualan.destroy', $trx->id_penjualan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection