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
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained()->cascadeOnDelete(); // Relasi ke tabel `pasiens`
            $table->foreignId('layanan_id')->constrained()->cascadeOnDelete(); // Relasi ke tabel `layanans`
            $table->json('jawaban_screening'); // Jawaban screening dalam bentuk JSON
            $table->unsignedInteger('skor'); // Total skor hasil screening
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
