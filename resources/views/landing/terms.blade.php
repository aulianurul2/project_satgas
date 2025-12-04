<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Terms & Condition - SIPRAK PPKPT</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_satgas.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    <style>
        :root { --bs-primary: #4f46e5; }
        header.masthead-mini {
            padding-top: 8rem;
            padding-bottom: 4rem;
            background: linear-gradient(to bottom right, rgba(79, 70, 229, 0.9) 0%, rgba(30, 58, 138, 0.9) 100%);
            color: white;
        }
        .term-list li { margin-bottom: 10px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-shrink" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}#page-top">SATGAS PPKPT POLSUB</a>
            <a class="btn btn-outline-primary btn-sm ms-auto" href="{{ url('/') }}">Kembali ke Beranda</a>
        </div>
    </nav>

    <header class="masthead-mini text-center">
        <div class="container px-4 px-lg-5">
            <h1 class="font-weight-bold">Syarat & Ketentuan</h1>
            <p class="mb-0">Ketentuan penggunaan layanan SIPRAK PPKPT</p>
        </div>
    </header>

    <section class="page-section bg-white">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="lead text-muted mb-4">Dengan mengakses dan menggunakan sistem pelaporan SIPRAK-PPKPT Politeknik Negeri Subang, Anda dianggap telah membaca, memahami, dan menyetujui syarat dan ketentuan di bawah ini:</p>
                    
                    <h4 class="mt-4 text-primary">1. Penggunaan Layanan</h4>
                    <ol class="text-muted term-list">
                        <li>Layanan ini diperuntukkan bagi Civitas Akademika Politeknik Negeri Subang dan masyarakat umum yang terkait dengan lingkungan kampus.</li>
                        <li>Pengguna wajib memberikan informasi yang benar, akurat, dan dapat dipertanggungjawabkan saat melakukan pelaporan.</li>
                    </ol>

                    <h4 class="mt-4 text-primary">2. Integritas Laporan</h4>
                    <ol class="text-muted term-list">
                        <li>Dilarang keras membuat laporan palsu, fitnah, atau laporan yang bertujuan untuk mencemarkan nama baik seseorang tanpa bukti atau dasar yang jelas.</li>
                        <li>Segala bentuk penyalahgunaan sistem untuk menyebarkan berita bohong (hoax) akan diproses sesuai dengan peraturan akademik dan hukum yang berlaku di Indonesia.</li>
                    </ol>

                    <h4 class="mt-4 text-primary">3. Hak dan Kewajiban Satgas</h4>
                    <ol class="text-muted term-list">
                        <li>Satgas berhak memverifikasi setiap laporan yang masuk.</li>
                        <li>Satgas berkewajiban menjaga kerahasiaan data pelapor sesuai Kebijakan Privasi.</li>
                        <li>Satgas berhak menolak atau menghentikan proses laporan jika terbukti laporan tersebut fiktif atau tidak memenuhi unsur kekerasan seksual sebagaimana diatur dalam regulasi.</li>
                    </ol>

                    <h4 class="mt-4 text-primary">4. Perubahan Ketentuan</h4>
                    <p class="text-muted">Satgas PPKPT berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu sesuai dengan perkembangan regulasi dan kebutuhan sistem.</p>

                    <div class="mt-5 p-4 bg-light rounded border">
                        <p class="mb-0 small text-center text-muted">Terakhir diperbarui: {{ date('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-4 border-top">
        <div class="container text-center">
            <div class="small text-muted">Copyright &copy; {{ date('Y') }} - Satgas PPKPT Politeknik Negeri Subang</div>
        </div>
    </footer>
</body>
</html>