@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Detail Penjualan</h1>

    <form action="{{ route('detail-penjualan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_penjualan" value="{{ $id_penjualan ?? 1 }}">

        <div>
            <label for="id_produk">Produk</label>
            <select name="id_produk" id="id_produk" required>
                @foreach($produk as $p)
                    <option value="{{ $p->id_produk }}" data-kategori="{{ $p->kategori }}">
                        {{ $p->nama_produk }} (Kategori: {{ $p->kategori }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" required>
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>

<script>
    // Opsional: Jika kamu mau menampilkan kategori terpilih secara dinamis, bisa tambahkan JS ini
    const selectProduk = document.getElementById('id_produk');
    selectProduk.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const kategori = selectedOption.getAttribute('data-kategori');
        console.log('Kategori terpilih:', kategori);
    });
</script>
@endsection
