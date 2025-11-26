<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

// 🔹 Controller Import
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReportController;
// use App\Http\Controllers\User\RegistrationController;
// use App\Http\Controllers\User\RegistrationController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\adminRecruitmentController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\RecruitmentController;
use App\Http\Controllers\User\formpendaftaranController;
use App\Http\Controllers\User\RiwayatPendaftaranController;
use App\Http\Controllers\Controller;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\LaporanController;




/*
|--------------------------------------------------------------------------
| 🌐 LANDING PAGE (Publik)
|--------------------------------------------------------------------------
| Halaman depan website & berita publik.
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/berita/{id}', [MediaController::class, 'show'])->name('berita.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| 🧩 DASHBOARD ADMIN
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user dengan hak akses admin.
*/
Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard utama
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen laporan
        Route::get('/laporan', [AdminReportController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [AdminReportController::class, 'show'])->name('laporan.show');
        Route::patch('/laporan/{laporan}/update-status', [AdminReportController::class, 'updateStatus'])->name('laporan.update_status');

        // Manajemen media/berita
        Route::resource('media', MediaController::class)->parameters(['media' => 'media']);
    });


/*
|--------------------------------------------------------------------------
| 👤 DASHBOARD USER
|--------------------------------------------------------------------------
| Hanya untuk pengguna yang login & terverifikasi emailnya.
*/
Route::middleware(['auth', 'verified'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard user
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Laporan pengguna
        Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/buat', [ReportController::class, 'create'])->name('laporan.create');
        Route::post('/laporan/store', [ReportController::class, 'store'])->name('laporan.store');
        Route::get('/laporan/riwayat', [ReportController::class, 'history'])->name('laporan.history');
        Route::get('/laporan/detail/{id}', [ReportController::class, 'show'])->name('laporan.show');

        // // Pendaftaran
        // Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('pendaftaran.create');
        // Route::post('/pendaftaran/store', [RegistrationController::class, 'store'])->name('pendaftaran.store');
        // // Pendaftaran
        // Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('pendaftaran.create');
        // Route::post('/pendaftaran/store', [RegistrationController::class, 'store'])->name('pendaftaran.store');

        // Profil
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    });


/*
|--------------------------------------------------------------------------
| 🔑 AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| ✉️ TES KIRIM EMAIL RESET PASSWORD
|--------------------------------------------------------------------------
*/
Route::get('/test-reset-email', fn() => view('auth.test-reset-email'));
Route::post('/test-reset-email', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Email reset password berhasil dikirim!')
        : back()->withErrors(['email' => __($status)]);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('members', \App\Http\Controllers\Admin\MemberController::class);
});


// USER RECRUITMENT
// Route::middleware(['auth'])->group(function () {
//     Route::get('/recruitment', [RecruitmentController::class, 'create'])->name('recruitment.create');
//     Route::post('/recruitment', [RecruitmentController::class, 'store'])->name('recruitment.store');
// });


// ADMIN RECRUITMENT
Route::get('/adminrecruitment', [adminRecruitmentController::class, 'index'])->name('laporan.adminrecruitment');
Route::get('/form-pendaftaran', [formpendaftaranController::class, 'create'])->name('formpendaftaran.create');
Route::post('/form-pendaftaran', [formpendaftaranController::class, 'store'])->name('formpendaftaran.store');
Route::get('/riwayatpendaftaran', [RiwayatPendaftaranController::class, 'index'])
     ->name('user.riwayatpendaftaran.index');


Route::middleware(['auth'])->group(function () {
    
    Route::get('/user/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/user/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/user/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});
Route::get('/tim-pengembang', function () {
    return view('frontend.tim-pengembang');
})->name('tim.pengembang');


Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

});
Route::prefix('admin')->group(function () {

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');

    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('admin.laporan.show');

    Route::get('/laporan/{id}/download', [LaporanController::class, 'download'])->name('admin.laporan.download');

    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');

});



