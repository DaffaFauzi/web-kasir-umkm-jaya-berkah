@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Penjualan</h1>

    <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="tanggal_mulai" class="col-form-label">Tanggal Mulai:</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-auto">
            <label for="tanggal_selesai" class="col-form-label">Tanggal Selesai:</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control"
                value="{{ request('tanggal_selesai') }}">
        </div>
        <div class="col-auto mt-4">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>

        {{-- ✅ Tombol Cetak Struk dan PDF --}}
        @if(request('tanggal_mulai') && request('tanggal_selesai') && $penjualans->count())
            <div class="col-auto mt-4">
                <a href="{{ route('laporan.struk', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}"
                   target="_blank"
                   class="btn btn-success me-2">
                    Cetak Struk
                </a>

                <a href="{{ route('laporan.struk.download', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}"
                   class="btn btn-danger">
                    Unduh PDF
                </a>
            </div>
        @endif
    </form>

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @forelse($penjualans as $data)
                    <tr>
                        <td>{{ $data->tgl ?? '-' }}</td>
                        <td>{{ $data->pelanggan->nama ?? '-' }}</td> {{-- ✅ FIXED --}}
                        <td>Rp {{ number_format($data->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @php $grandTotal += $data->total_harga; @endphp
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data penjualan.</td>
                    </tr>
                @endforelse
            </tbody>
            @if($penjualans->count())
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-end">Total Penjualan</th>
                        <th>Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection