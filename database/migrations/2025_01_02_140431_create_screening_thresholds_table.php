<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('screening_thresholds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained()->onDelete('cascade');
            $table->integer('rendah_threshold')->default(5); // Ambang batas untuk status rendah
            $table->integer('sedang_threshold')->default(8); // Ambang batas untuk status sedang
            $table->integer('tinggi_threshold')->default(10); // Ambang batas untuk status tinggi
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screening_thresholds');
    }
};
