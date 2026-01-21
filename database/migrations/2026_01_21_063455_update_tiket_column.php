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
        Schema::table('tikets', function (Blueprint $table) {
            // Ubah kolom dari enum menjadi teks biasa
            $table->string('tipe')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {
            // Kembalikan ke enum jika di-rollback
            $table->enum('tipe', ['reguler', 'premium'])->change();
        });
    }
};
