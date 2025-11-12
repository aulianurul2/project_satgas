<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIPRAK-PPKPT POLSUB</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('landing/assets/favicon.ico') }}" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    
    <style>
        /* ======================================================= */
        /* INJECTED CUSTOM STYLE TO MATCH LOGIN (INDIGO/BLUE-600) */
        /* ======================================================= */
        :root {
            /* Warna Primer Baru: Indigo-600 */
            --bs-primary: #4f46e5; 
            --bs-primary-rgb: 79, 70, 229;
            /* Warna Sekunder/Aksen yang lebih gelap untuk hover */
            --bs-dark-rgb: 23, 23, 34; /* Hampir hitam */
        }
        
        /* Mengaplikasikan warna primer baru pada kelas Bootstrap */
        .btn-primary, .btn-primary:focus {
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }
        .btn-primary:hover {
            background-color: #4338ca !important; /* Indigo-700 */
            border-color: #4338ca !important;
        }
        
        /* FIX: Memastikan tombol outline menggunakan warna Indigo yang benar */
        .btn-outline-primary {
            color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }
        .btn-outline-primary:hover {
             color: #fff !important;
             background-color: var(--bs-primary) !important;
        }
        
        .text-primary, .text-primary i {
            color: var(--bs-primary) !important;
        }
        .bg-primary {
            background-color: var(--bs-primary) !important;
        }

        /* FIX: Menghilangkan efek warna orange pada garis pembagi (divider) */
        .divider {
            background-color: var(--bs-primary) !important;
            border: none !important; /* Menghapus border default */
            height: 0.2rem; /* Menentukan tinggi garis */
            opacity: 1;
        }

        /* FIX: Memastikan teks navigasi (seperti "Berita") tidak berwarna orange pada kondisi navbar-shrink */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link {
            /* Menggunakan warna gelap standar Bootstrap */
            color: #212529 !important; 
        }

        /* ======================================================= */
        /* PENYESUAIAN BARU UNTUK HOVER NAVIGASI */
        /* ======================================================= */

        /* Aturan hover untuk tautan Navigasi pada keadaan normal (di atas Masthead/Hero) */
        #mainNav:not(.navbar-shrink) .navbar-nav .nav-item a.nav-link:hover,
        #mainNav:not(.navbar-shrink) .navbar-nav .nav-item a.nav-link:focus {
            color: var(--bs-primary) !important; /* Teks menjadi Indigo saat hover */
        }

        /* Aturan hover untuk tautan Navigasi pada keadaan 'shrink' (ketika scroll) */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link:hover,
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link:focus {
            color: var(--bs-primary) !important; /* Teks menjadi Indigo saat hover */
        }


        /* Styling Khusus Masthead (Hero Section) agar memiliki Gradien Kaya */
        header.masthead {
            /* Ganti dengan gambar latar belakang Anda */
            background-image: url('{{ asset("landing/assets/img/ppkpt.jpeg") }}'); 
            background-size: cover;
            background-position: center;
        }
        header.masthead:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* Gradien gelap yang mirip dengan latar belakang login yang kaya */
            /* OPACITY DIKURANGI DARI 0.9 MENJADI 0.75 AGAR TEKS LEBIH TERLIHAT */
            /* Menggunakan gradien yang lebih ringan (0.1) di awal untuk kontras yang lebih baik pada teks putih */
            background: linear-gradient(to bottom right, rgba(79, 70, 229, 0.1) 0%, rgba(30, 58, 138, 0.75) 100%); 
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 30px;
            }
        }
    </style>

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
                <!-- NOTE: logo.png must exist in the assets path -->
                <img src="{{ asset('landing/assets/img/logo.png') }}" alt="Logo Satgas" 
                    style="height: 40px; width: auto; margin-right: 10px;">
                <span class="fw-bold">SATGAS PPKPT POLSUB</span>
            </a>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur">Alur Pelaporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>

                    @guest
                        <!-- Menggunakan btn-outline-primary dan btn-primary yang sudah di-override warnanya -->
                        <li class="nav-item"><a class="nav-link btn btn-outline-primary mx-2" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-primary text-white px-3" href="{{ route('register') }}">Register</a></li>
                        @else
                        @if (Auth::user()->jenisUser === 'admin')
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white" href="{{ route('admin.dashboard') }}">
                                    Dashboard Admin
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white" href="{{ route('user.dashboard') }}">
                                    Dashboard User
                                </a>
                            </li>
                        @endif
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead (Hero Section) - Sekarang dengan overlay gradien Indigo -->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <!-- PENYESUAIAN DISINI: Menambahkan position:relative dan z-index: 10 untuk mengangkat konten teks di atas overlay :before -->
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center" 
                style="position: relative; z-index: 10;"> 
                
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">Satuan Tugas Pencegahan dan Penanganan Kekerasan <br> Di Perguruan Tinggi<br> Politeknik Negeri Subang</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Satgas PPKPT berkomitmen untuk mewujudkan lingkungan kampus yang aman, nyaman, dan bebas dari segala jenis kekerasan.</p>
                    <a class="btn btn-primary btn-xl" href="#about">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About - Background sudah berubah warna menjadi Indigo-600 -->
    <section class="page-section bg-primary" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Kami Siap Membantu Anda!</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4">SATGAS PPKPT POLSUB menyediakan layanan pencegahan, pendampingan, serta edukasi terkait kekerasan seksual di lingkungan kampus.</p>
                    <a class="btn btn-light btn-xl" href="#alur">Lihat Alur Pelaporan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pelaporan Section -->
    <section class="page-section bg-light" id="alur">
        <div class="container px-4 px-lg-5">
            <div class="text-center">
                <h2 class="mt-0">Alur Pelaporan</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Berikut langkah-langkah pelaporan kasus kekerasan di lingkungan kampus Politeknik Negeri Subang:</p>
            </div>
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-3 text-center">
                    <div class="mt-5">
                        <!-- Ikon menggunakan text-primary (Indigo-600) -->
                        <div class="mb-3"><i class="bi bi-person-check fs-1 text-primary"></i></div>
                        <h4 class="h5">1. Pelapor Melapor</h4>
                        <p class="text-muted">Mahasiswa atau civitas akademika melaporkan kasus melalui form atau datang langsung ke posko Satgas.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="mt-5">
                        <div class="mb-3"><i class="bi bi-envelope-open fs-1 text-primary"></i></div>
                        <h4 class="h5">2. Verifikasi Laporan</h4>
                        <p class="text-muted">Satgas memverifikasi laporan dan memastikan identitas pelapor tetap dirahasiakan.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="mt-5">
                        <div class="mb-3"><i class="bi bi-people fs-1 text-primary"></i></div>
                        <h4 class="h5">3. Pendampingan Korban</h4>
                        <p class="text-muted">Tim memberikan pendampingan psikologis, hukum, dan administratif kepada pelapor atau korban.</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="mt-5">
                        <div class="mb-3"><i class="bi bi-balance-scale fs-1 text-primary"></i></div>
                        <h4 class="h5">4. Penyelesaian Kasus</h4>
                        <p class="text-muted">Kasus diselesaikan sesuai mekanisme hukum dan peraturan yang berlaku di perguruan tinggi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="page-section" id="video">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mt-0">Video Sosialisasi Satgas PPKPT</h2>
            <hr class="divider" />
            <p class="text-muted mb-4">Tonton video berikut untuk memahami lebih lanjut tentang upaya pencegahan dan penanganan kekerasan seksual di kampus.</p>

            <!-- Responsive Video Embed -->
            <div class="ratio ratio-16x9 shadow-lg rounded-3">
                <iframe 
                    src="https://www.youtube.com/embed/OxiwR2dRA-w" 
                    title="Video Sosialisasi Satgas PPKPT" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="page-section" id="services">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Layanan Kami</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-person-heart fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Pendampingan</h3>
                        <p class="text-muted mb-0">Kami menyediakan pendampingan psikologis dan hukum bagi korban kekerasan seksual.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-shield-lock fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Perlindungan</h3>
                        <p class="text-muted mb-0">Menjaga kerahasiaan dan keamanan setiap pelapor serta pihak terkait.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-book fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Edukasi</h3>
                        <p class="text-muted mb-0">Memberikan edukasi dan sosialisasi pencegahan kekerasan seksual di lingkungan kampus.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="bi-chat-left-heart fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Konsultasi</h3>
                        <p class="text-muted mb-0">Konsultasikan permasalahan Anda secara aman dan rahasia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita -->
    <div id="portfolio" class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Berita Terbaru</h2>
            <hr class="divider" />
            <div class="row g-4">
                {{-- Bagian berita akan otomatis terisi dari database --}}
                <div class="col-lg-4 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <!-- NOTE: thumbnial image must exist -->
                        <img class="card-img-top" src="{{ asset('landing/assets/img/portfolio/thumbnails/1.jpg') }}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Judul Berita</h5>
                            <p class="card-text">Contoh isi berita singkat atau deskripsi kegiatan PPKPT POLSUB.</p>
                            <!-- Tombol menggunakan btn-primary (Indigo-600) -->
                            <a href="#" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="text-center">
                <h2 class="mt-0">Hubungi Kami</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Apabila Anda membutuhkan bantuan atau ingin melapor, hubungi kami melalui form di bawah ini.</p>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-6">
                    <form id="contactForm">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="Masukkan nama..." />
                            <label for="name">Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="nama@example.com" />
                            <label for="email">Alamat Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" placeholder="Tulis pesan Anda..." style="height: 10rem"></textarea>
                            <label for="message">Pesan</label>
                        </div>
                        <div class="d-grid">
                            <!-- Tombol menggunakan btn-primary (Indigo-600) -->
                            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; {{ date('Y') }} - Satgas PPKPT Politeknik Negeri Subang</div>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="{{ asset('landing/js/scripts.js') }}"></script>
</body>
</html>