<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Pengembang – SIPRAK Satgas PPKPT POLSUB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5; /* Indigo-600 */
        }

        .team-card {
            transition: .3s;
        }
        .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }

        .team-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--primary);
        }

        .social-link {
            font-size: 0.9rem;
            text-decoration: none;
            color: var(--primary);
            font-weight: 500;
        }
        .social-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <h2 class="text-center fw-bold" style="color: var(--primary)">Tim Pengembang</h2>
        <p class="text-center text-muted mb-5">
            Halaman ini berisi informasi mengenai pengembang sistem SIPRAK-PPKPT POLSUB.
        </p>

        <div class="row g-4">

            <!-- Developer #1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card team-card border-0 shadow-sm text-center p-4">
                    <img src="{{ asset('landing/assets/img/Andi.jpeg') }}" class="team-img mb-3" alt="">
                    <h5 class="fw-semibold mb-1">Andi Hermawan</h5>
                    <p class="text-muted mb-1">Database Administrator</p>
                    <p class="text-muted mb-2">Backend Developer</p>

                    <a href="mailto:andi@example.com" class="social-link d-block mb-1"><andi@example.com</a>
                    <a href="https://instagram.com/andi" target="_blank" class="social-link">@andi</a>

                    <hr>
                    <small class="text-muted">Politeknik Negeri Subang</small>
                </div>
            </div>

            <!-- Developer #2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card team-card border-0 shadow-sm text-center p-4">
                    <img src="{{ asset('landing/assets/img/Aulia.jpeg') }}" class="team-img mb-3" alt="">
                    <h5 class="fw-semibold mb-1">Aulia Febrianti</h5>
                    <p class="text-muted mb-1">Backend Engineer</p>

                    <a href="mailto:aulia123@gmail.com" class="social-link d-block mb-1">aulia123@gmail.com</a>
                    <a href="https://instagram.com/aulia" target="_blank" class="social-link">@aulia</a>

                    <hr>
                    <small class="text-muted">Politeknik Negeri Subang</small>
                </div>
            </div>

            <!-- Developer #3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card team-card border-0 shadow-sm text-center p-4">
                    <img src="{{ asset('landing/assets/img/Diaz.jpeg') }}" class="team-img mb-3" alt="">
                    <h5 class="fw-semibold mb-1">Muhammad Dhiyaul Haq</h5>
                    <p class="text-muted mb-1">UI/UX Designer</p>

                    <a href="mailto:haq@example.com" class="social-link d-block mb-1">haq@example.com</a>
                    <a href="https://instagram.com/dhiyaul" target="_blank" class="social-link">@dhiyaul</a>

                    <hr>
                    <small class="text-muted">Politeknik Negeri Subang</small>
                </div>
            </div>

            <!-- Developer #4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card team-card border-0 shadow-sm text-center p-4">
                    <img src="{{ asset('landing/assets/img/Zahwa.jpeg') }}" class="team-img mb-3" alt="">
                    <h5 class="fw-semibold mb-1">Zahwa Meutia</h5>
                    <p class="text-muted mb-1">UI/UX Designer</p>

                    <a href="mailto:zahwa@example.com" class="social-link d-block mb-1">zahwa@example.com</a>
                    <a href="https://instagram.com/zahwa" target="_blank" class="social-link">@zahwa</a>

                    <hr>
                    <small class="text-muted">Politeknik Negeri Subang</small>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="btn btn-primary px-4">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
