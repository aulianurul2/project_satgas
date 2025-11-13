<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

// 🔹 Controller Import
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\RegistrationController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\MediaController;

use App\Http\Controllers\LandingController;

// 🌐 Landing Page — sekarang pakai controller biar bisa ambil berita dari DB
Route::get('/', [LandingController::class, 'index'])->name('landing');

// 🧩 DASHBOARD ADMIN & FITURNYA
Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard Utama Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Laporan
    Route::get('/laporan', [AdminReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [AdminReportController::class, 'show'])->name('laporan.show');
    Route::patch('/laporan/{laporan}/update-status', [AdminReportController::class, 'updateStatus'])->name('laporan.update_status');

    // Manajemen Media / Berita
    Route::resource('media', MediaController::class)->parameters(['media' => 'media']);

});

// 👤 DASHBOARD USER & FITURNYA
Route::middleware(['auth', 'verified'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

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

// 🧾 AUTH ROUTES
require __DIR__ . '/auth.php';

// ✉️ Tes Kirim Email Reset Password
Route::get('/test-reset-email', fn() => view('auth.test-reset-email'));
Route::post('/test-reset-email', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Email reset password berhasil dikirim!')
        : back()->withErrors(['email' => __($status)]);
});
