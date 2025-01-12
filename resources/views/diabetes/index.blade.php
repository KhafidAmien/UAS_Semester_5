<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Komplikasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Container Utama -->
        <!-- Konten Utama -->
        <div class="grid grid-rows-1 grid-flow-col gap-12 xl:px-20 lg:px-20 md:px-20 sm:px-16">
            <!-- Kolom 1 -->
            <div class="space-x-4 py-12 hidden md:block sm:block">
                <a href="/"><img src="{{ asset('images/kitasehat.png') }}" alt="logo" style="height: 3rem;"></a>
                <h1 class="text-3xl font-bold text-gray-800 mb-2 mt-3">Risiko Diabetes</h1>
                <p class="text-gray-700 leading-relaxed mb-4">
                Diabetes adalah kondisi kesehatan yang memerlukan perhatian serius 
                karena dapat menyebabkan berbagai komplikasi yang memengaruhi banyak 
                aspek kehidupan. Memahami komplikasi yang mungkin timbul akibat diabetes 
                sangat penting untuk mencegah dan mengelola kondisi ini dengan lebih baik.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div class="bg-white shadow-md rounded-lg p-6 overflow-y-auto h-screen">
                <!-- Progress Bar -->
                <h2 class="text-xl font-bold text-gray-800 mb-2 mt-5">Kuesioner Cek Komplikasi Diabetes</h2>
                <p class="text-gray-600 mb-4">Jawab pertanyaan dibawah untuk melihat hasil diagnosa</p>

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
                <!-- Form -->
                <form class="space-y-4" action="{{ route('diabetes.submit') }}" method="POST" id="diabetes-form">
                    @csrf
                    <!-- Pilih Jenis Kelamin -->
                    <div>
                        <label class="block font-bold text-gray-800 mb-2">Pilih jenis kelamin</label>
                        <div class="flex space-x-4">
                            <label class="w-full">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" class="hidden peer" required>
                                <div
                                    class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                                    Laki-laki
                                </div>
                            </label>
                            <label class="w-full">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" class="hidden peer">
                                <div
                                    class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                                    Perempuan
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Pilih Usia -->
                    <!-- Pilih Usia -->
<div>
    <label class="block font-bold text-gray-800 mb-2">Berapa usia kamu?</label>
    <div class="grid grid-rows-2 grid-flow-col gap-3">
        <label class="w-full">
            <input type="radio" name="usia" value="Di bawah 35 tahun" class="hidden peer" required>
            <div
                class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                Di bawah 35 thn
            </div>
        </label>
        <label class="w-full">
            <input type="radio" name="usia" value="35-44 tahun" class="hidden peer">
            <div
                class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                35-44 thn
            </div>
        </label>
        <label class="w-full">
            <input type="radio" name="usia" value="45-54 tahun" class="hidden peer">
            <div
                class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                45-54 thn
            </div>
        </label>
        <label class="w-full">
            <input type="radio" name="usia" value="55-65 tahun" class="hidden peer">
            <div
                class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                55-65 thn
            </div>
        </label>
        <label class="w-full">
            <input type="radio" name="usia" value="66 tahun ke atas" class="hidden peer">
            <div
                class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                66 tahun ke atas
            </div>
        </label>
    </div>
</div>


                    <!-- Screening -->
                    <div>
                        <label class="block font-bold text-gray-800 mb-2">Screening</label>
                        @foreach ($questions as $question)
                            <div class="mb-4">
                                <p>{{ $question->pertanyaan }}</p>
                                <div class="flex space-x-4">
                                    <label class="w-full mt-2">
                                        <input type="radio" name="jawaban_responden[{{ $question->id }}][jawaban_kuesioner]" value="1"
                                            class="hidden peer" required>
                                        <div
                                            class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                                            Ya
                                        </div>
                                    </label>
                                    <label class="w-full mt-2">
                                        <input type="radio" name="jawaban_responden[{{ $question->id }}][jawaban_kuesioner]" value="0"
                                            class="hidden peer">
                                        <div
                                            class="py-2 px-4 border border-gray-300 text-gray-500 rounded-md text-center cursor-pointer peer-checked:ring-1 peer-checked:ring-pink-500 peer-checked:text-pink-500 peer-checked:bg-pink-50">
                                            Tidak
                                        </div>
                                    </label>
                                </div>
                                <input type="hidden" name="jawaban_responden[{{ $question->id }}][pertanyaan_id]"
                                    value="{{ $question->id }}">
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol Kirim -->
                    <button type="submit" id="submit-button"
                    class="w-full text-gray-400 py-3 rounded-md font-bold focus:ring-1 focus:ring-pink-500 focus:bg-pink-50 focus:text-pink-500 bg-gray-300 hover hover:bg-pink-50 hover:text-pink-400 active:bg-pink-50 focus:outline-none">Kirim</button>
                </form>

            </div>
            <!-- Kolom 3 -->
                <div class="text-black small py-12 hidden sm:block md:block">
                    <div class="mb-2">&copy; Created by HambaAllah | 2024</div>
                    <a href="/">Beranda</a>
                    <span class="mx-1">&middot;</span>
                    <a href="/#tentang kami">Tentang Kami</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Cek Komplikasi</a>
                </div>
        </div>
    
        <!-- Javascript KIRIM -->



</body>

</html>
