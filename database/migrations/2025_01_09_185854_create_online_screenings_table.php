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
        Schema::create('online_screenings', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kelamin'); // Jenis kelamin
            $table->integer('usia'); // Usia
            $table->json('jawaban_responden'); // Jawaban kuesioner
            $table->integer('skor'); // Skor
            $table->string('status'); // Status (tinggi, sedang, rendah)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_screenings');
    }
};
