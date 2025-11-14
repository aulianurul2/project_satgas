@extends('layouts.app')

@section('content')
<div class="article-page">
    <!-- Breadcrumb -->
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb modern-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">
                        <i class="bi bi-house-door-fill"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ Str::limit($media->judul, 50) }}</li>
            </ol>
        </nav>
    </div>

    <!-- Hero Section dengan Parallax Effect -->
    <div class="hero-section">
        <div class="hero-image-wrapper">
            <img src="{{ asset('storage/' . $media->gambar) }}" 
                 class="hero-img" 
                 alt="{{ $media->judul }}">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="hero-badge mb-3">
                            <i class="bi bi-newspaper"></i>
                            <span>Artikel</span>
                        </div>
                        <h1 class="hero-title" data-aos="fade-up">
                            {{ $media->judul }}
                        </h1>
                        <div class="hero-meta" data-aos="fade-up" data-aos-delay="100">
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $media->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="meta-divider"></div>
                            <div class="meta-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $media->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Main Article Card -->
                    <article class="article-card" data-aos="fade-up">
                        <div class="article-body">
                            <div class="article-content">
                                {!! nl2br(e($media->isi)) !!}
                            </div>

                            <!-- Tags Section (Optional) -->
                            <div class="article-tags mt-5">
                                <i class="bi bi-tags-fill text-primary me-2"></i>
                                <span class="tag-badge">Informasi</span>
                                <span class="tag-badge">Berita</span>
                            </div>

                            <!-- Divider -->
                            <div class="elegant-divider"></div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{ url('/') }}" class="btn-custom btn-primary">
                                    <i class="bi bi-arrow-left"></i>
                                    <span>Kembali</span>
                                </a>
                                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
                                        class="btn-custom btn-light">
                                    <i class="bi bi-arrow-up"></i>
                                    <span>Ke Atas</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Share Section -->
                    <div class="share-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="share-header">
                            <i class="bi bi-share-fill"></i>
                            <h5>Bagikan Artikel Ini</h5>
                        </div>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" 
                               class="share-btn facebook"
                               data-tooltip="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($media->judul) }}" 
                               target="_blank" 
                               class="share-btn twitter"
                               data-tooltip="Twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($media->judul . ' ' . url()->current()) }}" 
                               target="_blank" 
                               class="share-btn whatsapp"
                               data-tooltip="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                               target="_blank" 
                               class="share-btn linkedin"
                               data-tooltip="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <button onclick="copyToClipboard(event)" 
                                    class="share-btn copy"
                                    data-tooltip="Salin Link">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS Modern --}}
<style>
:root {
    --primary-color: #0d6efd;
    --secondary-color: #6c757d;
    --success-color: #198754;
    --danger-color: #dc3545;
    --dark-color: #212529;
    --light-color: #f8f9fa;
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-dark: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 20px rgba(0,0,0,0.12);
    --shadow-lg: 0 8px 30px rgba(0,0,0,0.15);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.article-page {
    background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
    min-height: 100vh;
}

/* Modern Breadcrumb */
.modern-breadcrumb {
    background: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: var(--shadow-sm);
    margin-bottom: 0;
}

.modern-breadcrumb li {
    font-size: 0.95rem;
    font-weight: 500;
}

.modern-breadcrumb a {
    color: var(--secondary-color);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.modern-breadcrumb a:hover {
    color: var(--primary-color);
    transform: translateX(2px);
}

.modern-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    font-size: 1.3rem;
    color: var(--secondary-color);
    opacity: 0.5;
}

.modern-breadcrumb .active {
    color: var(--dark-color);
    font-weight: 600;
}

/* Hero Section */
.hero-section {
    position: relative;
    height: 600px;
    margin-bottom: 3rem;
    overflow: hidden;
}

.hero-image-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transform: scale(1.1);
    transition: transform 8s ease-out;
}

.hero-section:hover .hero-img {
    transform: scale(1);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
}

.hero-content {
    position: relative;
    z-index: 10;
    height: 100%;
    display: flex;
    align-items: flex-end;
    padding-bottom: 4rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.3);
}

.hero-title {
    color: white;
    font-size: 3rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
    letter-spacing: -0.5px;
}

.hero-meta {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-size: 1rem;
    font-weight: 500;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 0.6rem 1.2rem;
    border-radius: 50px;
    border: 1px solid rgba(255,255,255,0.2);
}

.meta-item i {
    font-size: 1.1rem;
}

.meta-divider {
    width: 1px;
    height: 20px;
    background: rgba(255,255,255,0.3);
}

/* Content Section */
.content-section {
    padding: 2rem 0 5rem;
}

.article-card {
    background: white;
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    margin-bottom: 2rem;
}

.article-body {
    padding: 3rem;
}

.article-content {
    font-size: 1.15rem;
    line-height: 1.9;
    color: #333;
    text-align: justify;
}

.article-content p {
    margin-bottom: 1.5rem;
}

/* Tags */
.article-tags {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
    padding: 1.5rem 0;
}

.tag-badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.tag-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

/* Elegant Divider */
.elegant-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, var(--primary-color), transparent);
    margin: 2rem 0;
    opacity: 0.3;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.btn-custom {
    display: inline-flex;
    align-items: center;
    gap: 0.7rem;
    padding: 1rem 2rem;
    border: none;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-custom.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-custom.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
}

.btn-custom.btn-light {
    background: var(--light-color);
    color: var(--dark-color);
    border: 2px solid #e9ecef;
}

.btn-custom.btn-light:hover {
    background: white;
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* Share Card */
.share-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--shadow-md);
}

.share-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.share-header i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.share-header h5 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--dark-color);
}

.share-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.share-btn {
    position: relative;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.share-btn::before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 120%;
    left: 50%;
    transform: translateX(-50%) scale(0);
    background: var(--dark-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    white-space: nowrap;
    opacity: 0;
    transition: all 0.3s ease;
    pointer-events: none;
}

.share-btn:hover::before {
    transform: translateX(-50%) scale(1);
    opacity: 1;
}

.share-btn.facebook {
    background: linear-gradient(135deg, #1877f2, #0d5dbb);
}

.share-btn.twitter {
    background: linear-gradient(135deg, #1da1f2, #0d8bd9);
}

.share-btn.whatsapp {
    background: linear-gradient(135deg, #25d366, #1da851);
}

.share-btn.linkedin {
    background: linear-gradient(135deg, #0077b5, #005885);
}

.share-btn.copy {
    background: linear-gradient(135deg, #6c757d, #495057);
}

.share-btn:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.share-btn:active {
    transform: translateY(-2px) scale(0.98);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.article-card,
.share-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 992px) {
    .hero-section {
        height: 500px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        height: 400px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-content {
        padding-bottom: 2rem;
    }
    
    .article-body {
        padding: 2rem 1.5rem;
    }
    
    .article-content {
        font-size: 1.05rem;
        line-height: 1.7;
    }
    
    .share-card {
        padding: 1.5rem;
    }
    
    .meta-divider {
        display: none;
    }
}

@media (max-width: 576px) {
    .hero-section {
        height: 350px;
    }
    
    .hero-title {
        font-size: 1.5rem;
    }
    
    .meta-item {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
    }
    
    .article-body {
        padding: 1.5rem 1rem;
    }
    
    .btn-custom {
        width: 100%;
        justify-content: center;
    }
    
    .share-btn {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}

/* Print Styles */
@media print {
    .modern-breadcrumb,
    .hero-badge,
    .hero-meta,
    .article-tags,
    .action-buttons,
    .share-card {
        display: none;
    }
    
    .hero-section {
        height: 300px;
    }
}
</style>

{{-- JavaScript --}}
<script>
// Copy to Clipboard
function copyToClipboard(event) {
    const url = window.location.href;
    const btn = event.target.closest('button');
    const icon = btn.querySelector('i');
    
    navigator.clipboard.writeText(url).then(() => {
        // Success feedback
        icon.classList.replace('bi-link-45deg', 'bi-check-lg');
        btn.style.background = 'linear-gradient(135deg, #198754, #146c43)';
        
        // Reset after 2 seconds
        setTimeout(() => {
            icon.classList.replace('bi-check-lg', 'bi-link-45deg');
            btn.style.background = '';
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
        alert('Gagal menyalin link. Silakan coba lagi.');
    });
}

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Reading progress indicator (optional)
window.addEventListener('scroll', () => {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    
    // You can add a progress bar element and update it here
    // document.getElementById('progressBar').style.width = scrolled + '%';
});
</script>
@endsection