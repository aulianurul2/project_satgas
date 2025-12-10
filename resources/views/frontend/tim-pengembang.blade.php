<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Pengembang – SIPRAK Satgas PPKPT POLSUB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-light: #f9fafb;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Card Styling */
        .team-card {
            background: white;
            border: none;
            border-radius: 16px; /* Lebih bulat */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .team-card:hover {
            transform: translateY(-8px); /* Efek naik */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Image Container & Styling */
        .img-wrapper {
            width: 130px;
            height: 130px;
            margin: 0 auto 1.5rem; /* Center horizontal */
            position: relative;
            border-radius: 50%;
            padding: 4px;
            border: 2px solid #e0e7ff; /* Ring halus */
        }

        .team-img {
            width: 100%;
            height: 100%;
            object-fit: cover;      /* Memastikan gambar mengisi lingkaran tanpa gepeng */
            object-position: center; /* KUNCI: Fokus gambar selalu di tengah */
            border-radius: 50%;
            transition: transform 0.5s ease;
        }

        /* Zoom effect pada gambar saat card di-hover */
        .team-card:hover .team-img {
            transform: scale(1.1);
        }

        /* Typography */
        .member-name {
            color: #1f2937;
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
        }

        .member-role {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .member-subrole {
            color: #9ca3af;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }

        /* Links */
        .contact-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .contact-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* Divider */
        .card-divider {
            border-top: 1px solid #f3f4f6;
            margin-top: 1.5rem;
            padding-top: 1rem;
            font-size: 0.75rem;
            color: #9ca3af;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold display-6" style="color: #1f2937;">Tim Pengembang</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Halaman ini berisi informasi mengenai pengembang sistem di lingkungan SIPRAK-PPKPT POLSUB.
            </p>
        </div>

        <!-- ========================= -->
        <!-- BARIS 1 : DOSEN PEMBIMBING -->
        <!-- ========================= -->
        <!-- justify-content-center membuat elemen di tengah jika jumlahnya sedikit -->
        <div class="row g-4 justify-content-center mb-5">

            <!-- Dosen Pembimbing 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card team-card p-4 text-center">
                    <div class="img-wrapper">
                        <!-- Tambahkan onerror agar kalau gambar error, tetap rapi -->
                        <img src="{{ asset('landing/assets/img/Pa_akmal(2).jpg') }}" 
                             class="team-img" 
                             alt="Ardhi Ahmad Jadhira"
                             onerror="this.src='https://ui-avatars.com/api/?name=Ardhi+Ahmad&background=random&size=128'">
                    </div>
                    
                    <h5 class="member-name">Ardhi Ahmad Jadhira</h5>
                    <p class="member-role">Dosen Pembimbing 1</p>

                    <div class="mt-3">
                        <a href="mailto:ardhi@example.com" class="contact-link d-block">ardhi@example.com</a>
                        <a href="https://instagram.com/andi" target="_blank" class="contact-link">@Ardhi</a>
                    </div>

                    <div class="card-divider">
                        Politeknik Negeri Subang
                    </div>
                </div>
            </div>

            <!-- Dosen Pembimbing 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card team-card p-4 text-center">
                    <div class="img-wrapper">
                        <img src="{{ asset('landing/assets/img/Pa_erick (1).jpg') }}" 
                             class="team-img" 
                             alt="Erick Febrianto"
                             onerror="this.src='https://ui-avatars.com/api/?name=Erick+Febrianto&background=random&size=128'">
                    </div>

                    <h5 class="member-name">Erick Febrianto</h5>
                    <p class="member-role">Dosen Pembimbing 2</p>

                    <div class="mt-3">
                        <a href="mailto:erick@example.com" class="contact-link d-block">erick@example.com</a>
                        <a href="https://instagram.com/erick" target="_blank" class="contact-link">@Erick</a>
                    </div>

                    <div class="card-divider">
                        Politeknik Negeri Subang
                    </div>
                </div>
            </div>

        </div>

        <!-- ========================= -->
        <!-- BARIS 2 : MAHASISWA DEVELOPER -->
        <!-- ========================= -->
        <div class="row g-4">

            <!-- Developer #1 -->
            <div class="col-lg-3 col-md-6">
                <div class="card team-card p-4 text-center">
                    <div class="img-wrapper">
                        <img src="{{ asset('landing/assets/img/Andi.jpeg') }}" 
                             class="team-img" 
                             alt="Andi Hermawan"
                             onerror="this.src='https://ui-avatars.com/api/?name=Andi+Hermawan&background=random&size=128'">
                    </div>

                    <h5 class="member-name">Andi Hermawan</h5>
                    <p class="member-role">Database Administrator</p>
                    <p class="member-subrole">Backend Developer</p>

                    <div class="mt-auto">
                        <a href="mailto:andi@example.com" class="contact-link d-block">andi@example.com</a>
                        <a href="https://instagram.com/andi" target="_blank" class="contact-link">@andi</a>
                    </div>

                    <div class="card-divider">
                        Politeknik Negeri Subang
                    </div>
                </div>
            </div>

            <!-- Developer #2 -->
            <div class="col-lg-3 col-md-6">
                <div class="card team-card p-4 text-center">
                    <div class="img-wrapper">
                        <img src="{{ asset('landing/assets/img/Aulia.jpeg') }}" 
                             class="team-img" 
                             alt="Aulia Nurul Febrianti"
                             onerror="this.src='https://ui-avatars.com/api/?name=Aulia+Nurul&background=random&size=128'">
                    </div>

                    <h5 class="member-name">Aulia Nurul Febrianti</h5>
                    <p class="member-role">Backend Engineer</p>
                    <!-- Spacer kosong agar tinggi kartu sejajar jika tidak ada subrole -->
                    <p class="member-subrole">&nbsp;</p> 

                    <div class="mt-auto">
                        <a href="mailto:aulia123@gmail.com" class="contact-link d-block">aulia123@gmail.com</a>
                        <a href="https://instagram.com/aulia" target="_blank" class="contact-link">@aulia</a>
                    </div>

                    <div class="card-divider">
                        Politeknik Negeri Subang
                    </div>
                </div>
            </div>

            <!-- Developer #3 -->
            <div class="col-lg-3 col-md-6">
                <div class="card team-card p-4 text-center">
                    <div class="img-wrapper">
                        <img src="{{ asset('landing/assets/img/Diaz.jpeg') }}" 
                             class="team-img" 
                             alt="Muhammad Dhiyaul Haq"
                             onerror="this.src='https://ui-avatars.com/api/?name=M+Dhiyaul&background=random&size=128'">
                    </div>

                    <h5 class="member-name">Muhammad Dhiyaul Haq</h5>
                    <p class="member-role">UI/UX Designer</p>
                    <p class="member-subrole">&nbsp;</p>

                    <div class="mt-auto">
                        <a href="mailto:haq@example.com" class="contact-link d-block">haq@example.com</a>
                        <a href="https://instagram.com/dhiyaul" target="_blank" class="contact-link">@dhiyaul</a>
                    </div>

                    <div class="card-divider">
                        Politeknik Negeri Subang
                    </div>
                </div>
            </div>

            <!-- Developer #4 -->
            <div class="col-lg-3 col-md-6">
                <div class="card team-card p-4 text-center">
                    <div class="img-wrapper">
                        <img src="{{ asset('landing/assets/img/Zahwa.jpeg') }}" 
                             class="team-img" 
                             alt="Zahwa Meutia"
                             onerror="this.src='https://ui-avatars.com/api/?name=Zahwa+Meutia&background=random&size=128'">
                    </div>

                    <h5 class="member-name">Zahwa Meutia</h5>
                    <p class="member-role">UI/UX Designer</p>
                    <p class="member-subrole">&nbsp;</p>

                    <div class="mt-auto">
                        <a href="mailto:zahwa@example.com" class="contact-link d-block">zahwa@example.com</a>
                        <a href="https://instagram.com/zahwa" target="_blank" class="contact-link">@zahwa</a>
                    </div>

                    <div class="card-divider">
                        Politeknik Negeri Subang
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                &larr; Kembali ke Beranda
            </a>
        </div>

    </div>

</body>

</html>