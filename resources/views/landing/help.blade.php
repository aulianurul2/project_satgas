<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Help Center - SIPRAK PPKPT</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_satgas.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    <style>
        :root { --bs-primary: #4f46e5; }
        .accordion-button:not(.collapsed) {
            color: var(--bs-primary);
            background-color: rgba(79, 70, 229, 0.1);
        }
        .accordion-button:focus {
            border-color: rgba(79, 70, 229, 0.5);
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }
        header.masthead-mini {
            padding-top: 8rem;
            padding-bottom: 4rem;
            background: linear-gradient(to bottom right, rgba(79, 70, 229, 0.9) 0%, rgba(30, 58, 138, 0.9) 100%);
            color: white;
        }
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
            <h1 class="font-weight-bold">Pusat Bantuan</h1>
            <p class="mb-0">Pertanyaan yang sering diajukan seputar pelaporan</p>
        </div>
    </header>

    <section class="page-section bg-white">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- FAQ Accordion -->
                    <div class="accordion" id="accordionHelp">
                        
                        <!-- Item 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <strong>Bagaimana cara melaporkan kasus kekerasan seksual?</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionHelp">
                                <div class="accordion-body text-muted">
                                    Anda dapat melapor dengan menekan tombol "Login" (jika mahasiswa/staf) dan mengisi formulir pengaduan di dashboard. Jika ingin melapor secara offline, Anda dapat mendatangi posko Satgas PPKPT di Gedung Administrasi pada jam kerja.
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <strong>Apakah identitas saya aman jika melapor?</strong>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionHelp">
                                <div class="accordion-body text-muted">
                                    Ya, Satgas menjunjung tinggi asas kerahasiaan. Identitas pelapor dan korban dilindungi dan tidak akan disebarluaskan tanpa persetujuan, kecuali untuk kepentingan hukum yang mendesak.
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <strong>Bentuk pendampingan apa yang diberikan?</strong>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionHelp">
                                <div class="accordion-body text-muted">
                                    Kami menyediakan pendampingan konseling (psikologis), pendampingan hukum, advokasi akademik, dan pendampingan medis jika diperlukan.
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <strong>Apakah saksi bisa melapor?</strong>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionHelp">
                                <div class="accordion-body text-muted">
                                    Ya, saksi yang melihat atau mengetahui adanya tindakan kekerasan seksual sangat dianjurkan untuk melapor agar kasus dapat segera ditindaklanjuti.
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Accordion -->

                    <div class="mt-5 text-center">
                        <p class="text-muted">Masih butuh bantuan lain?</p>
                        <a href="{{ url('/') }}#contact" class="btn btn-primary">Hubungi Kami</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>