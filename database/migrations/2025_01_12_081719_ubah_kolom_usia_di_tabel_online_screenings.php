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
        Schema::table('online_screenings', function (Blueprint $table) {
            $table->string('usia')->change(); // Mengubah kolom usia menjadi string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nama_tabel', function (Blueprint $table) {
            $table->integer('usia')->change(); // Mengembalikan ke tipe integer jika rollback
        });
    }
};
