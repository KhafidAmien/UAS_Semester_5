<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OnlineScreening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnlineScreeningController extends Controller
{
    // Fungsi untuk mengambil pertanyaan dari database
    public function getQuestions()
    {
        $questions = DB::table('kuesioners')->where('layanan_id', 1)->get();

        return response()->json([
            'status' => 'success',
            'data' => $questions,
        ]);
    }

    // Fungsi untuk menyimpan data screening
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $data = $request->validate([
            'jenis_kelamin' => 'required|string',
            'usia' => 'required|string|min:1',
            'jawaban_responden' => 'required|array',
            'jawaban_responden.*.jawaban_kuesioner' => 'required|boolean',
            'jawaban_responden.*.pertanyaan_id' => 'required|integer',
        ]);

        // Debugging untuk memastikan data diterima dengan benar
        // dd('Data diterima:', $data);

        // Hitung skor
        $score = $this->calculateScore($data['jawaban_responden']);

        // Tentukan status
        $status = $this->determineStatus($score);

        // Simpan data ke database
        try {
            $onlineScreening = OnlineScreening::create([
                'jenis_kelamin' => $data['jenis_kelamin'],
                'usia' => $data['usia'],
                'jawaban_responden' => json_encode($data['jawaban_responden']),
                'skor' => $score,
                'status' => $status,
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $onlineScreening,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi untuk menentukan status berdasarkan skor
    private function determineStatus($score)
    {
        if ($score >= 8) {
            return 'Tinggi';
        } elseif ($score >= 5) {
            return 'Sedang';
        }
        return 'Rendah';
    }

    // Fungsi untuk menghitung skor berdasarkan jawaban responden
    private function calculateScore($jawabanResponden)
    {
        $score = 0;

        // Ambil semua pertanyaan dari database
        $questions = DB::table('kuesioners')->where('layanan_id', 1)->get();

        // Loop untuk setiap pertanyaan
        foreach ($questions as $pertanyaan) {
            // Cari jawaban responden untuk pertanyaan ini
            $jawabanRespondenItem = collect($jawabanResponden)->firstWhere('pertanyaan_id', $pertanyaan->id);

            // Jika jawaban responden ada dan cocok dengan jawaban yang benar
            if ($jawabanRespondenItem && $pertanyaan->jawaban_kuesioner == $jawabanRespondenItem['jawaban_kuesioner']) {
                $score++;
            }
        }

        return $score;
    }

    // Fungsi untuk menampilkan halaman dengan data pertanyaan
    public function index()
    {
        $questions = DB::table('kuesioners')->where('layanan_id', 1)->get();

        return view('diabetes.index', compact('questions'));
    }

    // Fungsi untuk submit data screening melalui form
    public function submitScreening(Request $request)
{
    $validated = $request->validate([
        'jenis_kelamin' => 'required|string',
        'usia' => 'required|string|min:1',
        'jawaban_responden' => 'required|array',
        'jawaban_responden.*.jawaban_kuesioner' => 'required|boolean',
        'jawaban_responden.*.pertanyaan_id' => 'required|integer',
    ]);

    // Hitung skor
    $score = $this->calculateScore($validated['jawaban_responden']);

    // Tentukan status
    $status = $this->determineStatus($score);

    // Simpan data ke database
    try {
        $screening = OnlineScreening::create([
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'usia' => $validated['usia'],
            'jawaban_responden' => json_encode($validated['jawaban_responden']),
            'skor' => $score,
            'status' => $status,
        ]);

        // Redirect ke halaman hasil screening
        return redirect()->route('diabetes.result', [
            'status' => $status,
            'skor' => $score
        ]);

    } catch (\Exception $e) {
        return back()->withErrors('Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
    }
}
public function result(Request $request)
{
    $status = $request->query('status');
    $skor = $request->query('skor');

    $screening = OnlineScreening::latest()->first();


    $colorClasses = [
        'Tinggi' => 'text-red-500',
        'Sedang' => 'text-yellow-500',
        'Rendah' => 'text-green-500',
    ];

    $colorClass = $colorClasses[$status] ?? 'text-gray-500';

    return view('diabetes.result', [
        'status' => $status,
        'skor' => $skor,
        'usia' => $screening->usia ?? 'Tidak diketahui',
        'jenis_kelamin' => $screening->jenis_kelamin ?? 'Tidak diketahui',
        'colorClass' => $colorClass,
    ]);
}




}
