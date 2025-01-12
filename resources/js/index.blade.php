<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halodoc - Risiko Diabetes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="container">
    <h1>Cek Risiko Komplikasi Diabetes</h1>
    <p>Isi data Anda untuk memulai screening risiko diabetes.</p>

    <!-- Menampilkan notifikasi sukses -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan notifikasi error -->
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form screening -->
    <form action="{{ route('diabetes.submit') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="usia">Usia</label>
        <input type="number" name="usia" id="usia" required min="1">
    </div>

    <div class="mb-4">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select>
    </div>

    @foreach ($questions as $question)
    <div class="mb-4">
        <p>{{ $question->pertanyaan }}</p>
        <label>
            <input type="radio" name="jawaban_responden[{{ $question->id }}][jawaban_kuesioner]" value="1" required> Ya
        </label>
        <label>
            <input type="radio" name="jawaban_responden[{{ $question->id }}][jawaban_kuesioner]" value="0" required> Tidak
        </label>
        <input type="hidden" name="jawaban_responden[{{ $question->id }}][pertanyaan_id]" value="{{ $question->id }}">
    </div>
    @endforeach

    <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-full">
        Submit
    </button>
    </form>
</div>
</body>
</html>
