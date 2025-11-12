<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// ... (Controller User yang sudah ada)
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\RegistrationController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

// 🆕 Tambahkan Controller Admin (Asumsi Anda membuat AdminReportController)
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController; 

// 🌐 Landing Page
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

// 🧩 DASHBOARD ADMIN & FITURNYA
// Gunakan prefix 'admin' dan middleware khusus (misalnya 'can:access-admin')
Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Utama Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 🆕 Data Laporan Admin (Sesuai mockup)
    Route::get('/laporan', [AdminReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [AdminReportController::class, 'show'])->name('laporan.show');
    // Tambahkan rute untuk aksi admin (verifikasi, proses, dll)
    Route::patch('/laporan/{laporan}/update-status', [AdminReportController::class, 'updateStatus'])->name('laporan.update_status');

    // Route::patch('/laporan/{laporan}/update-status', [AdminReportController::class, 'updateStatus'])->name('laporan.update_status'); 

    // Route Tambahan Admin lainnya (Anggota, Settings, dll)
    // ...
});

// 👤 DASHBOARD USER + FITURNYA (Tidak Berubah)
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    // ... (Rute User yang sudah ada)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/buat', [ReportController::class, 'create'])->name('laporan.create');
    Route::post('/laporan/store', [ReportController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/riwayat', [ReportController::class, 'history'])->name('laporan.history');
    Route::get('/laporan/detail/{id}', [ReportController::class, 'show'])->name('laporan.show');
    Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran/store', [RegistrationController::class, 'store'])->name('pendaftaran.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

});

// 🧾 PROFIL USER (Tidak Berubah)
// ...
require __DIR__ . '/auth.php';

// Route untuk tes kirim email reset password
Route::get('/test-reset-email', function () {
    return view('auth.test-reset-email');
});

Route::post('/test-reset-email', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Email reset password berhasil dikirim!')
        : back()->withErrors(['email' => __($status)]);
});
