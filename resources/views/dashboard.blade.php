@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard UMKM Jaya Berkah</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-3">{{ $totalProduk }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pelanggan</h5>
                    <p class="card-text fs-3">{{ $totalPelanggan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Penjualan</h5>
                    <p class="card-text fs-3">{{ $totalPenjualan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan</h5>
                    <p class="card-text fs-3">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h4>Grafik Penjualan 7 Hari Terakhir</h4>
    @if(count($total) > 0)
        <div style="height: 300px;">
            <canvas id="penjualanChart" class="w-100 h-100"></canvas>
        </div>
    @else
        <p class="text-muted">Belum ada data penjualan dalam 7 hari terakhir.</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = () => {
            const ctx = document.getElementById('penjualanChart')?.getContext('2d');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($tanggal) !!},
                    datasets: [{
                        label: 'Total Penjualan',
                        data: {!! json_encode($total) !!},
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }
    </script>
</div>
@endsection
