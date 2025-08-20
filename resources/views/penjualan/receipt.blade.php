<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Transaksi #{{ $transaction->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Struk Transaksi</h2>
    <p><strong>ID Transaksi:</strong> {{ $transaction->id }}</p>
    <p><strong>Nama Customer:</strong> {{ $transaction->customer_name }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>

    <h4>Detail Produk:</h4>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Terima kasih!</strong></p>
</body>
</html>