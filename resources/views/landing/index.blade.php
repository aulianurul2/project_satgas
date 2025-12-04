<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIPRAK-PPKPT</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_satgas.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    
    <style>
        /* ======================================================= */
        /* PERBAIKAN CSS UNTUK OVERLAY CARD (HOVER EFFECT)       */
        /* ======================================================= */
        
        .service-card {
            position: relative; /* Penting: agar overlay tidak keluar dari kotak */
            overflow: hidden;   /* Mencegah isi keluar dari radius border */
            background: #fff;   /* Pastikan card punya background dasar putih */
            transition: all 0.3s ease;
        }

        .service-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Background warna Primary (Indigo) agar menutupi icon di belakangnya */
            background-color: rgba(79, 70, 229, 0.95); 
            
            /* Teks Putih agar terbaca di background gelap */
            color: #ffffff !important; 
            
            /* Default: Sembunyikan Overlay */
            opacity: 0; 
            visibility: hidden;
            
            /* Animasi transisi */
            transition: all 0.3s ease-in-out;
            z-index: 10;
            
            /* Flexbox untuk menengahkan teks */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 1rem;
        }

        /* Paksa teks di dalam overlay menjadi putih (mengalahkan class text-muted) */
        .service-overlay h5, 
        .service-overlay p {
            color: #ffffff !important;
        }

        /* SAAT DI-HOVER: Munculkan Overlay */
        .service-card:hover .service-overlay {
            opacity: 1;
            visibility: visible;
        }

        /* Opsional: Sedikit efek angkat pada card saat hover */
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }

        /* ======================================================= */
        /* STYLE BAWAAN LAINNYA                                  */
        /* ======================================================= */
        :root {
            --bs-primary: #4f46e5; 
            --bs-primary-rgb: 79, 70, 229;
            --bs-dark-rgb: 23, 23, 34; 
        }
        
        .btn-primary, .btn-primary:focus {
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }
        .btn-primary:hover {
            background-color: #4338ca !important; 
            border-color: #4338ca !important;
        }
        
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

        .divider {
            background-color: var(--bs-primary) !important;
            border: none !important;
            height: 0.2rem;
            opacity: 1;
        }

        /* === LOGIC NAVBAR SAAT SCROLL (Navbar Shrink) === */

        /* 1. Link Navigasi biasa jadi hitam */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link:not(.btn) {
            color: #212529 !important;
        }

        /* 2. FIX BUG LOGIN BUTTON (Invisible Button Fix)
           Masalah sebelumnya: Rule lama memaksa semua .nav-link.btn jadi putih (#fff).
           Solusi: Pisahkan rule untuk btn-outline (Login) dan btn-primary (Register).
        */

        /* Untuk Tombol LOGIN (Outline): Saat scroll, teks & border harus BIRU (Primary), bukan putih */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link.btn.btn-outline-primary {
            color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }
        
        /* Saat hover di mode scroll, baru jadi teks putih background biru */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link.btn.btn-outline-primary:hover {
            color: #fff !important;
            background-color: var(--bs-primary) !important;
        }

        /* Untuk Tombol REGISTER (Solid): Tetap teks PUTIH karena backgroundnya biru */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link.btn.btn-primary {
            color: #fff !important;
            background-color: var(--bs-primary) !important;
        }

        /* Efek Hover Link Navigasi */
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link:hover,
        #mainNav.navbar-shrink .navbar-nav .nav-item a.nav-link:focus {
            color: var(--bs-primary) !important;
        }

        ::selection {
            background: var(--bs-primary);
            color: #fff;
        }
        ::-moz-selection {
            background: var(--bs-primary);
            color: #fff;
        }

        #mainNav .navbar-nav .nav-link:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.15);
            border-radius: 0.25rem;
        }

        #mainNav .navbar-nav .nav-link.btn:focus,
        #mainNav .navbar-nav .nav-link.btn:active {
            color: #fff !important;
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.18);
        }

        footer .copyright {
            font-size: 0.72rem;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            color: #6c757d;
        }
        footer .small {
            font-size: 0.82rem; 
        }

        header.masthead {
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
            background: linear-gradient(to bottom right, rgba(79, 70, 229, 0.1) 0%, rgba(30, 58, 138, 0.75) 100%); 
            pointer-events: none;
            z-index: 0;
        }

        header.masthead {
            position: relative;
            z-index: 1;
        }
        header.masthead .container,
        header.masthead .container * {
            position: relative;
            z-index: 2;
        }

        #about, #alur {
            position: relative;
            z-index: 3;
        }
        a.btn {
            position: relative;
            z-index: 4;
        }

        html { scroll-behavior: smooth; }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 30px;
            }
        }
    </style>

</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
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
                    <li class="nav-item"><a class="nav-link" href="#about">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur">Alur Pelaporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aboutus">About Us</a></li>

                    @guest
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

    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
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

    <section class="page-section bg-light" id="alur">
        <div class="container px-4 px-lg-5">
            <div class="text-center">
                <h2 class="mt-0">Alur Pelaporan</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Berikut langkah-langkah pelaporan kasus kekerasan di lingkungan kampus Politeknik Negeri Subang:</p>
            </div>
            
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-3 text-center">
                    <div class="mt-5 service-card p-4 rounded shadow-sm">
                        <div class="mb-3"><i class="bi bi-person-check fs-1 text-primary"></i></div>
                        <h4 class="h5 mb-1">Pelapor Melapor</h4>
                        <p class="text-muted short-desc mb-0">Mahasiswa atau civitas akademika melaporkan kasus melalui form atau datang langsung ke posko Satgas.</p>

                        <div class="service-overlay">
                            <h5 class="mb-2">Pelapor Melapor</h5>
                            <p class="mb-0">Mahasiswa atau civitas akademika melaporkan kasus melalui form atau datang langsung ke posko Satgas.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <div class="mt-5 service-card p-4 rounded shadow-sm">
                        <div class="mb-3"><i class="bi bi-envelope-open fs-1 text-primary"></i></div>
                        <h4 class="h5 mb-1">Verifikasi Laporan</h4>
                        <p class="text-muted short-desc mb-0">Satgas memverifikasi laporan dan memastikan identitas pelapor tetap dirahasiakan.</p>

                        <div class="service-overlay">
                            <h5 class="mb-2">Verifikasi Laporan</h5>
                            <p class="mb-0">Satgas memverifikasi laporan dan memastikan identitas pelapor tetap dirahasiakan.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <div class="mt-5 service-card p-4 rounded shadow-sm">
                        <div class="mb-3"><i class="bi bi-people fs-1 text-primary"></i></div>
                        <h4 class="h5 mb-1">Pendampingan Korban</h4>
                        <p class="text-muted short-desc mb-0">Tim memberikan pendampingan psikologis, hukum, dan administratif kepada pelapor atau korban.</p>

                        <div class="service-overlay">
                            <h5 class="mb-2">Pendampingan Korban</h5>
                            <p class="mb-0">Tim memberikan pendampingan psikologis, hukum, dan administratif kepada pelapor atau korban.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <div class="mt-5 service-card p-4 rounded shadow-sm">
                        <div class="mb-3"><i class="bi bi-card-checklist fs-1 text-primary"></i></div>
                        <h4 class="h5 mb-1">Penyelesaian Kasus</h4>
                        <p class="text-muted short-desc mb-0">Kasus diselesaikan sesuai mekanisme hukum dan peraturan yang berlaku di perguruan tinggi.</p>

                        <div class="service-overlay">
                            <h5 class="mb-2">Penyelesaian Kasus</h5>
                            <p class="mb-0">Kasus diselesaikan sesuai mekanisme hukum dan peraturan yang berlaku di perguruan tinggi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" id="video">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mt-0">Video Sosialisasi Satgas PPKPT</h2>
            <hr class="divider" />
            <p class="text-muted mb-4">Tonton video berikut untuk memahami lebih lanjut tentang upaya pencegahan dan penanganan kekerasan seksual di kampus.</p>

            <div class="ratio ratio-16x9 shadow-lg rounded-3">
                <iframe 
                    src="https://www.youtube.com/embed/OxiwR2dRA-w" 
                    title="Video Sosialisasi Satgas PPKPT" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <section class="page-section" id="services">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">Layanan Kami</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5 service-card p-3 rounded position-relative">
                        <div class="mb-2"><i class="bi-heart-fill fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Pendampingan</h3>
                        <p class="text-muted mb-0">Kami menyediakan pendampingan psikologis dan hukum bagi korban kekerasan seksual.</p>
                        
                        <div class="service-overlay">
                            <h5 class="mb-2">Pendampingan</h5>
                            <p class="mb-0">Kami menyediakan pendampingan psikologis dan hukum bagi korban kekerasan seksual.</p>
                        </div>
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
                        <div class="mb-2"><i class="bi bi bi-chat fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2">Konsultasi</h3>
                        <p class="text-muted mb-0">Konsultasikan permasalahan Anda secara aman dan rahasia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="portfolio" class="bg-light py-5">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">Berita Terbaru</h2>
        <hr class="divider" />
        <div class="row g-4">
            @forelse ($media as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                        <img class="card-img-top" 
                             src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->judul }}" 
                             style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark fw-semibold">{{ $item->judul }}</h5>
                            <p class="card-text flex-grow-1 text-muted">
                                {{ Str::limit(strip_tags($item->isi), 120) }}
                            </p>
                            <a href="{{ route('berita.show', $item->id) }}" 
                               class="btn btn-primary btn-sm mt-auto align-self-start">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada berita yang dipublikasikan.</p>
            @endforelse
        </div>
    </div>
</div>

    <section class="page-section bg-white" id="aboutus">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-lg-7">
                    <h2 class="mt-0">Tentang Satgas</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-4">
                        "Satgas PPKPT adalah satuan tugas di perguruan tinggi yang dibentuk untuk mencegah dan menangani kekerasan seksual. Pembentukan satgas ini diamanatkan oleh Permendikbud Ristek Nomor 30 Tahun 2021 sebagai respon atas tingginya kasus kekerasan seksual di kampus dan rendahnya keberanian korban untuk melapor. Satgas bertugas memastikan kampus menjadi lingkungan aman, menangani laporan secara profesional, serta mendukung upaya edukasi dan pencegahan di lingkungan civitas akademika."
                    </p>
                    <p class="text-muted mb-0">Untuk informasi lebih lanjut atau pelaporan, silakan hubungi kami melalui kontak resmi Satgas PPKPT Polsub.</p>
                </div>

                <div class="col-lg-5 text-center">
                    <figure class="m-0 d-flex align-items-center justify-content-center" style="min-height:160px;">
                        <img src="{{ asset('landing/assets/img/logo.png') }}" alt="Logo Satgas" 
                             class="img-fluid" 
                             style="max-width:320px; width:100%; height:auto; object-fit:contain;">
                    </figure>
                    <figcaption class="mt-2 small text-muted">Logo Satgas PPKPT</figcaption>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section bg-light" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
               <div class="col-lg-7 mb-4">
                    <h2 class="mt-0">Hubungi Kami</h2>
                    <hr class="divider" />

                   @if(session('success'))
                       <div class="alert alert-success">{{ session('success') }}</div>
                   @endif

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input name="name" type="text" class="form-control" placeholder="Nama" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input name="subject" type="text" class="form-control" placeholder="Subjek" value="{{ old('subject') }}" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" rows="6" class="form-control" placeholder="Pesan" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('landing/assets/img/logo.png') }}" alt="Logo" style="height:48px;margin-right:12px;">
                                <div>
                                    <h6 class="mb-0">Satgas PPKPT POLSUB</h6>
                                    <small class="text-muted">Politeknik Negeri Subang</small>
                                </div>
                            </div>
                            <p class="mb-1"><strong>Email</strong></p>
                            <p class="small text-muted mb-2">satgas@polsub.ac.id</p>
                            <p class="mb-1"><strong>Telepon</strong></p>
                            <p class="small text-muted mb-2">(+62) 123-4567</p>
                            <p class="mb-1"><strong>Alamat</strong></p>
                            <p class="small text-muted">Jalan Contoh No.1, Subang, Jawa Barat</p>
                        </div>
                    </div>

                    <div class="ratio ratio-16x9 rounded shadow-sm">
                        <iframe src="https://www.google.com/maps?q=Politeknik%20Negeri%20Subang&output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-5" style="border-top:4px solid var(--bs-primary);">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-start">
               <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-2">
                        <a href="{{ route('tim.pengembang') }}" class="text-decoration-none text-dark">
                            Satgas PPKPT
                        </a>
                    </h5>
                    <p class="small copyright mb-1">© {{ date('Y') }}. All rights reserved.</p>
                    <p class="small mb-0">Politeknik Negeri<br>Subang</p>
                </div>

<!-- Cari bagian footer di file index Anda dan ubah list-nya menjadi seperti ini -->
<div class="col-md-4 mb-4 mb-md-0">
    <h6 class="fw-semibold mb-2">About</h6>
    <ul class="list-unstyled small mb-0">
        <li>
            <a href="{{ route('privacy') }}" class="text-decoration-none text-muted hover-primary">
                Privacy Policy
            </a>
        </li>
        <li>
            <a href="{{ route('help') }}" class="text-decoration-none text-muted hover-primary">
                Help Center
            </a>
        </li>
        <li>
            <a href="{{ route('terms') }}" class="text-decoration-none text-muted hover-primary">
                Terms & Condition
            </a>
        </li>
    </ul>
</div>

                <div class="col-md-4 text-md-end">
                    <h6 class="fw-semibold mb-2">Follow Us on</h6>
                    <a href="#" class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light border" 
                       style="width:40px;height:40px;text-decoration:none;color:var(--bs-dark-rgb);">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light border" 
                       style="width:40px;height:40px;text-decoration:none;color:var(--bs-dark-rgb);">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="{{ asset('landing/js/scripts.js') }}"></script>
</body>
</html>