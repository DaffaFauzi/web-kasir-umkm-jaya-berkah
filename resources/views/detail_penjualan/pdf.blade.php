<!DOCTYPE html>
<html>
<head>
    <title>Detail Penjualan PDF</title>
    <style>
        body { font-family: sans-serif; }
    </style>
</head>
<body>
    <h2>Detail Penjualan ID: {{ $detail->id_detail }}</h2>
    <p><strong>Produk:</strong> {{ $detail->produk->nama_produk }}</p>
    <p><strong>Kategori:</strong> {{ $detail->kategori }}</p>
    <p><strong>Harga Satuan:</strong> Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
    <p><strong>Subtotal:</strong> Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
</body>
</html>
