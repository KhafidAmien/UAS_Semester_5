<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'layanan_id',
        'jawaban_screening',
        'skor',
        'status',
    ];

    protected $casts = [
        'jawaban_screening' => 'array', // Konversi jawaban_screening ke array
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function ScreeningThreshold()
    {
        return $this->belongsTo(ScreeningThreshold::class);
    }

    public function setJawabanScreeningAttribute($value)
{
    $this->attributes['jawaban_screening'] = json_encode($value);

    // Hitung skor berdasarkan jawaban yang sesuai dengan correct_answer
    $jawaban_benar = 0;
    foreach ($value as $item) {
        $pertanyaan = Kuesioner::find($item['pertanyaan_id']);
        if ($pertanyaan && $item['jawaban'] == $pertanyaan->jawaban_kuesioner) {
            $jawaban_benar++;
        }
    }

    // Ambil ambang batas untuk layanan yang bersangkutan
    $threshold = ScreeningThreshold::where('layanan_id', $this->layanan_id)->first();

    // Tentukan status berdasarkan ambang batas yang sudah diset
    if ($jawaban_benar >= $threshold->tinggi_threshold) {
        $this->attributes['status'] = 'Tinggi';
    } elseif ($jawaban_benar >= $threshold->sedang_threshold) {
        $this->attributes['status'] = 'Sedang';
    } else {
        $this->attributes['status'] = 'Rendah';
    }

    // Set skor
    $this->attributes['skor'] = $jawaban_benar;
}

}

