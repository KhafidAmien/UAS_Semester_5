<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>kitasehat</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset(asset('assets/css/styles.css'))}}" rel="stylesheet" />
        

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5 py-0">
                <a class="navbar-brand" href="#beranda"><img src="{{ asset('images/kitasehat.png') }}" alt="logo" style="height: 3rem;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <li class="nav-item"><a class="nav-link me-lg-3" href="#beranda">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="#tentang kami">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="{{ route('diabetes.index') }}">Cek Komplikasi</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Mashead header-->
        <header class="masthead" style="background-color: #F2F9F7;" id="beranda">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-1 fs-1 mb-3">Kurangi gula demi hidup yang lebih sehat.</h1>
                            <a href="{{ route('diabetes.index') }}" class="btn btn-success">Cek Komplikasi Diabetes</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Masthead device mockup feature-->
                        <div class="d-flex justify-content-center align-items-center">

                         <!-- Gambar -->
                        <img src="{{ asset('images/dokter.png') }}" 
                            alt="Gambar Dokter" 
                            class="img-fluid" 
                            style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-gradient-primary-to-secondary">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-8">
                        <div class="h2 fs-1 text-white mb-4">Kesehatan adalah hubungan antara anda dan tubuh anda. - Terri Guillemets</div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- App features section-->
        <section id="tentang kami">
                <div class="text-center">
                    <h1 class="fs-1">Tentang Kami</h1>
                </div>
            <div class="container">
                <div class="row my-4">
                    <div class="col-md-7 mb-5 mb-lg-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                <img src="{{ asset('images/tentang-kami.jpg') }}" alt="Tentang Kami" style="object-fit: cover;" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mb-5 mb-lg-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                <h4>Layanan Kesehatan</h4>
                                    <p>Selamat datang di Kitasehat, platform kesehatan yang berkomitmen menyediakan informasi dan solusi kesehatan terbaik untuk Anda dan keluarga.</p>
                                    <p>Kami juga menawarkan layanan konsultasi online, memungkinkan Anda berkonsultasi dengan dokter dari rumah. Dengan teknologi telemedicine, Anda bisa mendapatkan saran medis, diagnosis awal, dan rekomendasi perawatan dengan mudah. </p>
                                    <p>Selain itu, kami menyediakan program kebugaran dan tips nutrisi yang dapat disesuaikan dengan kebutuhan Anda. Kitasehat berkomitmen menjadi mitra kesehatan terpercaya bagi Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- Basic features section-->
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-12">
                        <div class="col-md-6 offset-md-3">
                            <h1 class="mb-5">Tinggalkan pesan atau pertanyaan</h1>
                                <form action="{{ route('feedback.store') }}" method="POST" class="" >
                                @csrf
                                    <!-- Email address input-->
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="Email Address" required />
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <input class="form-control form-control-lg" id="komentar" type="text" name="pesan" placeholder="Pesan atau komentar"/>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-success">
                                            Kirim
                                        </button>
                                    </div>
                                    
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="text-center py-5" style="background-color: #00a86b;">
            <div class="container px-5">
                <div class="text-white small">
                    <div class="mb-2">&copy; Created by HambaAllah | 2024</div>
                    <a href="#beranda">Beranda</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#tentang kami">Tentang Kami</a>
                    <span class="mx-1">&middot;</span>
                    <a href="{{ route('diabetes.index') }}">Cek Komplikasi</a>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('assets/js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
