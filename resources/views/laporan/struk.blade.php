<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info div {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        table th, table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
        .buttons {
            text-align: center;
            margin-top: 30px;
        }
        .buttons a, .buttons button {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 18px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .buttons button {
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Struk Laporan Penjualan</h2>

    <div class="info">
        <div><strong>Tanggal Awal:</strong> {{ $tanggal_mulai }}</div>
        <div><strong>Tanggal Akhir:</strong> {{ $tanggal_selesai }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse ($penjualans as $data)
                @foreach ($data->details as $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->tgl }}</td>
                        <td>{{ $data->pelanggan->nama ?? '-' }}</td>
                        <td>{{ $detail->produk->nama_produk ?? '-' }}</td>
                        <td>{{ $detail->kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="8">Tidak ada data penjualan pada rentang tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">Total Pendapatan: Rp {{ number_format($total, 0, ',', '.') }}</div>

    <div class="buttons">
        <a href="{{ route('laporan.struk.download', ['tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai]) }}">Download PDF</a>
        <button onclick="window.print()">Cetak Print</button>
    </div>

</body>
</html>