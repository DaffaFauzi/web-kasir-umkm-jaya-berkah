<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Struk Penjualan</h2>
    <p><strong>Tanggal:</strong> {{ $transaction->tgl }}</p>
    <p><strong>Pelanggan:</strong> {{ $transaction->pelanggan->nama_pelanggan ?? '-' }}</p>
    <p><strong>Kasir:</strong> {{ $transaction->user->name ?? '-' }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>