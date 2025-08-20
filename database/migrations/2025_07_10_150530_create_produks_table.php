<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->decimal('harga_satuan', 15, 2);
            $table->integer('stok');
            $table->enum('kategori', ['per ball', '1 kg', '1/2 kg', '1/4 kg', '1 bungkus']);
            $table->string('level_rasa')->nullable();
            $table->decimal('sub_total', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
