<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->date('tgl');
            $table->foreignId('id_pembeli')->constrained('pelanggan', 'id_pembeli')->onDelete('cascade');
            $table->decimal('total_harga', 15, 2);
            $table->foreignId('id_user')->constrained('users', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
