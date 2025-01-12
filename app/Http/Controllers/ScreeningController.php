<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreeningThreshold;
use App\Models\Screening;

class ScreeningController extends Controller
{
    

// Fungsi untuk menyimpan data screening
public function store(Request $request)
{
    // Validasi input data
    $validated = $request->validate([
        'pasien_id' => 'required|exists:pasiens,id',
        'layanan_id' => 'required|exists:layanans,id',
        'jawaban_screening' => 'required|array',
    ]);

    // Ambil threshold untuk layanan ini
    $threshold = ScreeningThreshold::where('layanan_id', $validated['layanan_id'])->first();

    // Jika tidak ada ambang batas yang ditemukan, set nilai default
    if (!$threshold) {
        $threshold = (object) [
            'rendah_threshold' => 5,
            'sedang_threshold' => 8,
            'tinggi_threshold' => 10,
        ];
    }

    // Proses screening, bisa gunakan helper function atau langsung di sini
    $skor = 0;
    $status = 'Rendah';
    
    // Perhitungan skor berdasarkan jawaban
    foreach ($validated['jawaban_screening'] as $jawaban) {
        // Logic untuk menghitung skor
        // Asumsi jawaban benar mendapat 1 poin
        if ($jawaban['jawaban'] == true) {
            $skor++;
        }
    }

    // Menentukan status berdasarkan skor dan ambang batas yang diambil
    if ($skor >= $threshold->tinggi_threshold) {
        $status = 'Tinggi';
    } elseif ($skor >= $threshold->sedang_threshold) {
        $status = 'Sedang';
    }

    // Simpan data screening ke database
    $screening = Screening::create([
        'pasien_id' => $validated['pasien_id'],
        'layanan_id' => $validated['layanan_id'],
        'jawaban_screening' => json_encode($validated['jawaban_screening']),
        'skor' => $skor,
        'status' => $status,
    ]);

    // Mengembalikan response
    return response()->json([
        'message' => 'Screening berhasil disimpan.',
        'data' => $screening,
    ]);
}

}
