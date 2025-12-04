<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Privacy Policy - SIPRAK PPKPT</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_satgas.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    <style>
        :root { --bs-primary: #4f46e5; }
        .bg-primary { background-color: var(--bs-primary) !important; }
        .text-primary { color: var(--bs-primary) !important; }
        header.masthead-mini {
            padding-top: 8rem;
            padding-bottom: 4rem;
            background: linear-gradient(to bottom right, rgba(79, 70, 229, 0.9) 0%, rgba(30, 58, 138, 0.9) 100%);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar (Sama seperti landing page, disederhanakan) -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-shrink" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}#page-top">SATGAS PPKPT POLSUB</a>
            <a class="btn btn-outline-primary btn-sm ms-auto" href="{{ url('/') }}">Kembali ke Beranda</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead-mini text-center">
        <div class="container px-4 px-lg-5">
            <h1 class="font-weight-bold">Kebijakan Privasi</h1>
            <p class="mb-0">Komitmen kami menjaga keamanan data Anda</p>
        </div>
    </header>

    <!-- Content -->
    <section class="page-section bg-white">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h3 class="mt-4">1. Pendahuluan</h3>
                    <p class="text-muted">Satgas PPKPT Politeknik Negeri Subang berkomitmen untuk melindungi privasi dan data pribadi seluruh civitas akademika, terutama pelapor dan korban kekerasan seksual. Kebijakan ini dibuat berdasarkan peraturan perundang-undangan yang berlaku, termasuk Permendikbud Ristek No. 30 Tahun 2021.</p>

                    <h3 class="mt-4">2. Data yang Kami Kumpulkan</h3>
                    <p class="text-muted">Untuk memproses laporan dan memberikan pendampingan, kami mungkin mengumpulkan data berikut:</p>
                    <ul class="text-muted">
                        <li>Identitas pribadi (Nama, NIM/NIP, Prodi/Unit Kerja).</li>
                        <li>Kontak yang dapat dihubungi (Email, No. Telepon).</li>
                        <li>Kronologi kejadian dan bukti pendukung yang diserahkan secara sukarela.</li>
                    </ul>

                    <h3 class="mt-4">3. Penggunaan Data</h3>
                    <p class="text-muted">Data yang dikumpulkan hanya digunakan untuk:</p>
                    <ul class="text-muted">
                        <li>Memverifikasi validitas laporan.</li>
                        <li>Keperluan investigasi internal Satgas.</li>
                        <li>Memberikan layanan pendampingan (psikologis/hukum) jika diminta.</li>
                    </ul>

                    <h3 class="mt-4">4. Jaminan Kerahasiaan</h3>
                    <p class="text-muted">Identitas pelapor, korban, dan saksi dijaga kerahasiaannya. Data tidak akan dipublikasikan atau diberikan kepada pihak ketiga tanpa persetujuan tertulis dari pemilik data, kecuali jika diwajibkan oleh proses hukum yang berlaku.</p>

                    <div class="alert alert-info mt-5">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Jika Anda memiliki pertanyaan mengenai kebijakan privasi ini, silakan hubungi kami melalui email: <strong>satgas@polsub.ac.id</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4 border-top">
        <div class="container text-center">
            <div class="small text-muted">Copyright &copy; {{ date('Y') }} - Satgas PPKPT Politeknik Negeri Subang</div>
        </div>
    </footer>
</body>
</html>