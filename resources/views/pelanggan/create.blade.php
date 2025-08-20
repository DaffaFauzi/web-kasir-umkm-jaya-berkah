@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pelanggan</h1>

    <form action="{{ route('pelanggan.store') }}" method="POST" id="form-pelanggan">
        @csrf

        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="produk-select">Produk</label>
            <select name="id_produk" id="produk-select" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach(\App\Models\Produk::all() as $produk)
                    <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga_satuan }}" data-kategori="{{ $produk->kategori }}">
                        {{ $produk->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" class="form-control" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" required>
        </div>

        <div class="form-group mb-3">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    const produkSelect = document.getElementById('produk-select');
    const kategoriInput = document.getElementById('kategori');
    const qtyInput = document.getElementById('qty');
    const totalInput = document.getElementById('total');

    let harga = 0;

    produkSelect.addEventListener('change', function () {
        const selected = produkSelect.options[produkSelect.selectedIndex];
        harga = parseFloat(selected.dataset.harga || 0);
        kategoriInput.value = selected.dataset.kategori || '';
        hitungTotal();
    });

    qtyInput.addEventListener('input', hitungTotal);

    function hitungTotal() {
        const qty = parseInt(qtyInput.value) || 0;
        const total = harga * qty;
        totalInput.value = total.toFixed(2);
    }
</script>
@endsection