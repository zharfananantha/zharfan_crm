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
        Schema::table('projects', function (Blueprint $table) {
            // Hapus kolom status lama
            $table->dropColumn('status');
        });

        Schema::table('projects', function (Blueprint $table) {
            // Tambahkan kolom status baru dengan tipe char(1)
            $table->char('status', 1)->default('p')->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Hapus kolom status baru
            $table->dropColumn('status');
        });

        Schema::table('projects', function (Blueprint $table) {
            // Kembalikan kolom status dengan tipe enum
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('product_id');
        });
    }
};
