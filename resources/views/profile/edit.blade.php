@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

<style>
    /* ... (Semua CSS yang sudah ada tetap dipertahankan, termasuk .floating-save-bar dan .btn-modern-secondary) ... */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --danger-gradient: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --card-shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        box-sizing: border-box;
    }

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Header Section */
    .page-header {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .page-header .breadcrumb {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        margin: 1rem 0 0 0;
        position: relative;
        z-index: 1;
    }

    .page-header .breadcrumb-item a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition-smooth);
    }

    .page-header .breadcrumb-item a:hover {
        opacity: 0.8;
    }

    .page-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.9);
    }

    .page-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Card Styling */
    .modern-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        overflow: hidden;
        transition: var(--transition-smooth);
        height: 100%;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
    }

    .modern-card .card-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modern-card.danger-card .card-header {
        background: var(--danger-gradient);
    }

    /* Profile Photo Section */
    .profile-photo-section {
        padding: 2rem 1rem;
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 15px;
        margin-bottom: 1.5rem;
    }

    .profile-photo-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: var(--transition-smooth);
        border-radius: 50%;
    }

    .profile-photo:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    }

    .photo-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--primary-gradient);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        border: 3px solid white;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .photo-badge:hover {
        transform: rotate(15deg) scale(1.1);
    }

    .file-name-display {
        margin-top: 0.75rem;
        padding: 0.5rem 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #6c757d;
        display: none;
    }

    .file-name-display.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    /* Form Controls */
    .form-group-modern {
        margin-bottom: 1.5rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: var(--transition-smooth);
        font-size: 1rem;
        width: 100%;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control-modern.is-invalid {
        border-color: #ef4444;
        animation: shake 0.5s;
    }

    /* File Input Custom */
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: block;
        width: 100%;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
    }

    .file-input-label {
        background: var(--primary-gradient);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        cursor: pointer;
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .file-input-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    /* Buttons */
    .btn-modern {
        padding: 0.75rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: var(--transition-smooth);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-modern:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-modern-success {
        background: var(--success-gradient);
        color: white;
    }

    .btn-modern-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(17, 153, 142, 0.4);
        color: white;
    }

    .btn-modern-danger {
        background: var(--danger-gradient);
        color: white;
    }

    .btn-modern-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(238, 9, 121, 0.4);
        color: white;
    }

    .btn-modern-outline-danger {
        background: white;
        color: #ef4444;
        border: 2px solid #ef4444;
    }

    .btn-modern-outline-danger:hover {
        background: var(--danger-gradient);
        color: white;
        border-color: transparent;
    }

    .btn-modern-secondary { /* Tambahan style untuk tombol Batal */
        background: #6c757d;
        color: white;
    }

    .btn-modern-secondary:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
    }

    .btn-modern:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    /* Loading Spinner */
    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
    }

    /* Alerts */
    .alert-modern {
        border-radius: 15px;
        border: none;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        animation: slideDown 0.5s ease;
    }

    .alert-modern.alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-modern.alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    /* Toast Notification */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .toast-modern {
        min-width: 300px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        animation: slideInRight 0.3s ease;
    }

    /* Danger Zone */
    .danger-zone {
        background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
        border: 2px solid #fee;
        padding: 1.5rem;
        border-radius: 15px;
        margin-top: 1rem;
    }

    .danger-zone-icon {
        font-size: 3rem;
        color: #ef4444;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }

    /* Modal Styling */
    .modal-modern .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-modern .modal-header {
        background: var(--danger-gradient);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .modal-modern .modal-body {
        padding: 2rem;
    }

    .modal-modern .btn-close {
        filter: brightness(0) invert(1);
    }

    /* Floating Save Bar */
    .floating-save-bar {
        position: sticky;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.95);
        border-top: 1px solid #e2e8f0;
        z-index: 1000;
        box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: flex-end; 
        gap: 1rem;
        border-radius: 10px 10px 0 0;
        margin-top: 2rem;
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.5rem;
        }
        .profile-photo {
            width: 120px;
            height: 120px;
        }
        .btn-modern {
            width: 100%;
            justify-content: center;
        }
        .profile-container {
            padding: 1rem 0.5rem;
        }
        .floating-save-bar {
            flex-direction: column-reverse; 
        }
    }
</style>

<div class="container-fluid px-4 profile-container">
    
    {{-- Header Modern --}}
    <div class="page-header">
        <h1>
            <i class="fas fa-user-circle"></i>
            Edit Profil
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Profil</li>
        </ol>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session('status') === 'profile-updated')
        <div class="alert alert-modern alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Berhasil!</strong> Profil Anda telah diperbarui dengan sukses 🎉
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Notifikasi Error Penghapusan Akun --}}
    {{-- Tambahkan script ini untuk menampilkan modal error secara otomatis jika ada error userDeletion --}}
    @if ($errors->userDeletion->any())
        <div class="alert alert-modern alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Gagal!</strong> Tidak dapat menghapus akun. Silakan periksa password Anda.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- Script untuk memunculkan modal secara otomatis saat ada error --}}
        <script>
             document.addEventListener('DOMContentLoaded', function() {
                var deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
                deleteModal.show();
            });
        </script>
    @endif
    
    <div class="row">
        {{-- Card: Perbarui Informasi Profil --}}
        <div class="col-lg-12 mb-4">
            <div class="card modern-card">
                <div class="card-header">
                    <i class="fas fa-user-edit"></i>
                    Perbarui Informasi Profil
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            {{-- KOLOM KIRI: Foto Profil --}}
                            <div class="col-lg-4 d-flex flex-column align-items-center text-center">
                                <div class="profile-photo-section w-100">
                                    <h6 class="mb-3 text-start form-label-modern"><i class="fas fa-camera"></i> Foto Profil</h6>
                                    <div class="profile-photo-wrapper">
                                        @if ($user->profile_photo)
                                            <img src="{{ asset('profile/' . $user->profile_photo) }}"
                                                class="profile-photo"
                                                id="preview-photo"
                                                alt="Foto Profil">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&size=150&rounded=true&background=667eea&color=fff"
                                                class="profile-photo"
                                                id="preview-photo"
                                                alt="Default Avatar">
                                        @endif
                                        
                                        <div class="photo-badge" onclick="document.getElementById('photo').click()">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    </div>

                                    <div class="file-input-wrapper mt-3">
                                        <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)">
                                        <label for="photo" class="file-input-label w-100">
                                            <i class="fas fa-upload"></i> Pilih Foto Baru
                                        </label>
                                    </div>

                                    <div class="file-name-display" id="fileNameDisplay">
                                        <i class="fas fa-image me-2"></i>
                                        <span id="fileName"></span>
                                    </div>

                                    @error('photo')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- KOLOM KANAN: Detail Profil --}}
                            <div class="col-lg-8">
                                <h6 class="mb-3 text-start form-label-modern"><i class="fas fa-info-circle"></i> Detail Informasi</h6>
                                <div class="row">
                                    {{-- Nama --}}
                                    <div class="col-md-6">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="fas fa-user"></i> Nama Lengkap
                                            </label>
                                            <input type="text" 
                                                name="nama" 
                                                class="form-control form-control-modern @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', $user->nama) }}"
                                                required>
                                            @error('nama')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="fas fa-envelope"></i> Email
                                            </label>
                                            <input type="email" 
                                                name="email" 
                                                class="form-control form-control-modern @error('email') is-invalid @enderror"
                                                value="{{ old('email', $user->email) }}"
                                                required>
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Kontak --}}
                                    <div class="col-md-6">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="fas fa-phone"></i> Kontak
                                            </label>
                                            <input type="text" 
                                                name="kontak" 
                                                class="form-control form-control-modern @error('kontak') is-invalid @enderror"
                                                value="{{ old('kontak', $user->kontak) }}"
                                                id="kontakInput"
                                                placeholder="08xxxxxxxxxx">
                                            @error('kontak')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Alamat --}}
                                    <div class="col-md-6">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="fas fa-map-marker-alt"></i> Alamat
                                            </label>
                                            <input type="text" 
                                                name="alamat" 
                                                class="form-control form-control-modern @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat', $user->alamat) }}">
                                            @error('alamat')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- Card: Hapus Akun (Danger Zone) --}}
        {{-- <div class="col-lg-12 mb-4">
             <div class="card modern-card danger-card">
                <div class="card-header">
                    <i class="fas fa-shield-alt"></i>
                    Zona Bahaya: Manajemen Akun
                </div>

                <div class="card-body p-4">
                    <div class="danger-zone d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center">
                            <div class="danger-zone-icon me-4">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h5 class="text-danger fw-bold mb-1">Hapus Akun Permanen</h5>
                                <p class="text-muted mb-0" style="font-size: 0.95rem;">
                                    Tindakan ini tidak dapat dibatalkan. Semua data akan hilang.
                                </p>
                            </div>
                        </div>

                        {{-- Tombol Pemicu Modal --}}
                        {{-- <button class="btn btn-modern btn-modern-outline-danger mt-3 mt-sm-0" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteAccountModal">
                            <i class="fas fa-trash-alt"></i>
                            Hapus Akun Saya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
     --}}
    {{-- Floating Save Bar --}}
    <div class="floating-save-bar">
        {{-- Tombol Batal --}}
        <a href="{{ url()->previous() }}" class="btn btn-modern btn-modern-secondary">
            <i class="fas fa-times-circle"></i> Batal
        </a>
        
        {{-- Tombol Simpan Perubahan --}}
        <button type="submit" form="profileForm" class="btn btn-modern btn-modern-success" id="submitBtn">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </div>

    {{-- Form kirim ulang verifikasi (sembunyi) --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="d-none">
        @csrf
    </form>
</div>

{{-- MODAL KONFIRMASI HAPUS AKUN (TIDAK DIKOMENTARI) --}}
{{-- <div class="modal fade modal-modern" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Penghapusan Akun
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-user-times text-danger" style="font-size: 4rem;"></i>
                </div>

                <p class="text-danger fw-bold text-center mb-3">
                    ⚠️ Apakah Anda yakin ingin menghapus akun Anda secara permanen?
                </p>

                <div class="alert alert-warning mb-4">
                    <small>
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini <strong>tidak dapat dibatalkan</strong> dan semua data akan hilang selamanya.
                    </small>
                </div>

                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf
                    @method('DELETE')

                    <div class="form-group-modern">
                        <label for="password-delete" class="form-label-modern">
                            <i class="fas fa-lock"></i>
                            Masukkan Password untuk Konfirmasi
                        </label>
                        <input type="password"
                                id="password-delete"
                                name="password"
                                class="form-control form-control-modern @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="Password Anda" 
                                required>

                        @error('password', 'userDeletion')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="button" class="btn btn-secondary flex-fill" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn btn-modern btn-modern-danger flex-fill" id="deleteBtn">
                            <i class="fas fa-trash-alt me-2"></i>
                            Ya, Hapus Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@push('scripts')
<script>
// Preview Image dengan validasi
function previewImage(event) {
    const file = event.target.files[0];
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileNameSpan = document.getElementById('fileName');
    
    if (file) {
        // Validasi tipe file
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            alert('Format file tidak valid! Gunakan JPG, PNG, atau GIF.');
            event.target.value = '';
            // Reset tampilan jika validasi gagal
            document.getElementById('preview-photo').src = 
                "{{ $user->profile_photo ? asset('profile/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&size=150&rounded=true&background=667eea&color=fff' }}";
            fileNameDisplay.classList.remove('active');
            return;
        }
        
        // Validasi ukuran file (max 2MB)
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 2MB.');
            event.target.value = '';
            // Reset tampilan jika validasi gagal
            document.getElementById('preview-photo').src = 
                "{{ $user->profile_photo ? asset('profile/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&size=150&rounded=true&background=667eea&color=fff' }}";
            fileNameDisplay.classList.remove('active');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-photo').src = e.target.result;
            fileNameSpan.textContent = file.name;
            fileNameDisplay.classList.add('active');
        }
        reader.readAsDataURL(file);
    }
}

// Format nomor telepon Indonesia
document.getElementById('kontakInput')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.startsWith('62')) {
        value = '0' + value.substring(2);
    }
    if (value.length > 13) {
        value = value.substring(0, 13);
    }
    e.target.value = value;
});

// Deteksi perubahan form dan konfirmasi sebelum meninggalkan halaman
let formChanged = false;
document.getElementById('profileForm').addEventListener('input', function() {
    formChanged = true;
});

window.addEventListener('beforeunload', function (e) {
    if (formChanged) {
        // Hanya tampilkan pesan kustom jika ada perubahan form
        e.preventDefault();
        e.returnValue = 'Perubahan yang Anda buat mungkin belum tersimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
    }
});

// Tambahan: Skrip untuk menangani error validasi dari backend pada Modal Penghapusan
@if ($errors->userDeletion->any())
    // Pastikan modal terbuka jika ada error validasi penghapusan akun
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModalEl = document.getElementById('deleteAccountModal');
        // Panggil modal Bootstrap
        var deleteModal = new bootstrap.Modal(deleteModalEl);
        deleteModal.show();
        
        // Fokuskan pada input password yang error
        document.getElementById('password-delete').focus();
    });
@endif
</script>
@endpush