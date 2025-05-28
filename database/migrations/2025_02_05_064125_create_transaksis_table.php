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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            
            // Add foreign key with constraint to users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            
            // Use decimal type for total, with a default value of 0.00
            $table->decimal('total', 12, 2)->default(0.00);
            
            $table->string('kasir_name', 100)->nullable();
            
            // Add payment status field with enum
            $table->enum('status', ['selesai', 'pending', 'dibatalkan'])
                  ->default('pending');
            
            // Timestamp for when payment is made
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
            
            // Create index for quick lookup of user_id and status
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraint before dropping the table
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('transaksis');
    }
};
