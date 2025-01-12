<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Screening - Risiko Diabetes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/feather-icons"></script>
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
            <div class="bg-white shadow-md overflow-y-auto h-screen relative">
            <img src="{{asset('images/hasil.png')}}" alt="hasil.png" class="object-cover h-80">
                <div class="absolute top-32 p-4 w-full">

                    <div class="p-4 border rounded w-full bg-white shadow-md text-center">
                        <p class="text-gray-600 font-normal mb-2">Level Risiko <span class="font-norma">{{ ucfirst($jenis_kelamin) }},</span><span class="font-normal"> {{ $usia }}</span></p>
                        <span class="font-bold text-xl {{ $colorClass }}">Risiko {{ ucfirst($status) }}</span>
                            <div class="p-4 border rounded mt-3 text-left">
                                <p class="text-gray-600 font-normal">Risiko Komplikasi anda,<span class="font-bold {{ $colorClass }}"> {{ ucfirst($status) }} </span></p>
                                    <ul class="text-gray-600 mt-3 list-disc list-outside ps-2">    
                                        <li>Selalu lakukan gula darah dan tekanan darah secara berkala.</li>
                                        <li>Aktif secara fisik tidak boleh malas bergerak.</li>
                                        <li>Mengikuti pola makan sehat yang dianjurkan.</li>
                                    </ul>
                            </div>
                        

                        <form action="{{ route('diabetes.index') }}" method="GET" class="mt-3">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-normal px-4 py-3 rounded-md flex mx-auto"><i data-feather="refresh-cw" class="pe-2"></i>
                            Cek Ulang
                        </button>
                    </form>
                    </div>
                        <div class="p-4 border rounded w-full mt-4">
                            <span class="font-bold text-danger flex"><i data-feather="alert-octagon" class="pe-2 text-dark"></i>Disclaimer</span>
                            <p class="text-gray-600 font-normal mt-2">Ini hanyalah simulasi. Untuk informasi yang akurat, disarankan untuk berkonsultasi langsung dengan tenaga kesehatan.</p>
                        </div>
                </div>

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


        <script>
      feather.replace();
    </script>
</body>

</html>
