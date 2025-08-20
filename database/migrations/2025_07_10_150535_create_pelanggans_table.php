<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pembeli');
            $table->string('nama');
            $table->date('tanggal')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->unsignedBigInteger('id_produk')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('total', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};