<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kuesioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'layanan_id',
        'pertanyaan',
        'jawaban_kuesioner'
    ];

    protected $casts = [
        'jawaban_kuesioner' => 'boolean', // Mengonversi nilai menjadi boolean
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
    
}
