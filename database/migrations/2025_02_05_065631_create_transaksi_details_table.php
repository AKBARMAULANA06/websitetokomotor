<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pertama pastikan tabel tidak ada (untuk development)
        Schema::dropIfExists('transaksi_details');
        
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            
            // Pastikan tipe data foreign key sama dengan primary key di tabel referensi
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('produk_id');
            
            $table->string('produk_name');
            $table->integer('qty')->unsigned();
            $table->decimal('harga_satuan', 12, 2); // Tambahkan kolom harga satuan
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
            
            // Tambahkan foreign key constraints secara terpisah
            $table->foreign('transaksi_id')
                  ->references('id')
                  ->on('transaksis')
                  ->onDelete('cascade');
                  
            $table->foreign('produk_id')
                  ->references('id')
                  ->on('produks')
                  ->onDelete('cascade');
            
            // Composite index
            $table->index(['transaksi_id', 'produk_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};