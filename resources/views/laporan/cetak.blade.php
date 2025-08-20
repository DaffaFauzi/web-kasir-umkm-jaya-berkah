<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan {{ $tanggal ? 'Tanggal ' . \Carbon\Carbon::parse($tanggal)->format('d-m-Y') : '' }}</h2>

    @php $grandTotal = 0; @endphp
    @forelse($penjualan as $data)
        <table>
            <tr>
                <th colspan="2">Tanggal</th>
                <td colspan="3">{{ $data->tgl }}</td>
            </tr>
            <tr>
                <th colspan="2">Nama Pelanggan</th>
                <td colspan="3">{{ $data->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
            </tr>
            <tr>
                <th colspan="2">Total Transaksi</th>
                <td colspan="3">Rp {{ number_format($data->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->details as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk ?? '-' }}</td>
                        <td>{{ $detail->kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php $grandTotal += $data->total_harga; @endphp
    @empty
        <p>Tidak ada data penjualan.</p>
    @endforelse

    <h4>Total Pendapatan: Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
</body>
</html>