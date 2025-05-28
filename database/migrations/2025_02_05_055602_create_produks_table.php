<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id sebagai primary key
            $table->string('name'); // Nama produk
            $table->foreignId('kategori_id') // Menambahkan kategori_id sebagai foreign key
                  ->constrained('kategoris') // Foreign key mengacu pada tabel kategoris
                  ->onDelete('cascade'); // Menghapus produk jika kategori dihapus
            $table->bigInteger('harga')->default(0); // Menyimpan harga produk
            $table->unsignedInteger('stok'); // Stok produk (hanya nilai positif)
            $table->string('gambar')->nullable(); // Gambar produk (nullable jika tidak ada gambar)
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks'); // Menghapus tabel produk
    }
};
