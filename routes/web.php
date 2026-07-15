<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KategoriEventController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\PendaftaranVolunteerController;
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('pages.home');
});


Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/pendaftaran/{id}', [PendaftaranVolunteerController::class, 'create']);
Route::post('/pendaftaran', [PendaftaranVolunteerController::class, 'store']);


Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/register-panitia', [RegisterController::class, 'registerPanitia'])->name('register.post.panitia');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::get('/profile', [VolunteerController::class, 'profile'])->name('profile.volunteer');
Route::put('/profile/{id}', [VolunteerController::class, 'editProfile'])->name('profile.volunteer.update');
Route::post('/profile/password', [VolunteerController::class, 'updatePassword'])
    ->name('volunteer.password.update');
Route::get('/pendaftaran-saya', [VolunteerController::class, 'pendaftaranSaya'])
    ->name('volunteer.pendaftaran');
Route::get('/penugasan-saya', [VolunteerController::class, 'penugasanSaya'])
    ->name('volunteer.penugasan');

Route::middleware(['auth', 'role:admin,panitia'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    // Event
    Route::get('/data-event', [AdminEventController::class, 'index'])->name('admin.event');
    Route::post('/data-event', [AdminEventController::class, 'store'])->name('admin.event.store');
    Route::put('/data-event/{id}', [AdminEventController::class, 'update'])->name('admin.event.update');
    Route::delete('/data-event/{id}', [AdminEventController::class, 'destroy'])->name('admin.event.destroy');
    Route::put('/data-event/{id}/verifikasi', [AdminEventController::class, 'verifikasi'])->name('admin.event.verifikasi');

    // Kategori
    Route::get('/data-kategori', [KategoriEventController::class, 'index'])->name('admin.kategori');

    // Panitia
    Route::get('/data-panitia', [PanitiaController::class, 'index'])->name('admin.panitia');
    Route::put('/data-panitia/{id}', [PanitiaController::class, 'update'])->name('admin.panitia.update');
    Route::delete('/data-panitia/{id}', [PanitiaController::class, 'destroy'])->name('admin.panitia.destroy');
    Route::put('/data-panitia/{id}/verifikasi', [PanitiaController::class, 'verifikasi'])->name('admin.panitia.verifikasi');

    // Divisi
    Route::get('/data-divisi', [DivisiController::class, 'index'])->name('admin.divisi');
    Route::post('/data-divisi', [DivisiController::class, 'store'])->name('admin.divisi.post');
    Route::put('/data-divisi/{id}', [DivisiController::class, 'update'])->name('admin.divisi.update');
    Route::delete('/data-divisi/{id}', [DivisiController::class, 'destroy'])->name('admin.divisi.destroy');

    // Pendaftaran
    Route::get('/data-pendaftaran', [PendaftaranVolunteerController::class, 'dataPendaftaran'])->name('data.pendaftaran');
    Route::put('/data-pendaftaran/{id}/verifikasi', [PendaftaranVolunteerController::class, 'verifikasi'])->name('admin.pendaftaran.verifikasi');

    // Penugasan
    Route::get('/data-penugasan', [VolunteerController::class, 'dataPenugasan'])->name('data.penugasan');
    Route::post('/data-penugasan', [VolunteerController::class, 'penugasan'])->name('admin.penugasan.post');
    Route::put('/data-penugasan/{id}', [VolunteerController::class, 'editPenugasan'])->name('admin.penugasan.update');
    Route::post('/evaluasi/store', [PanitiaController::class, 'storeEvaluasi'])
    ->name('evaluasi.store');

    Route::get('/profile-admin', [PanitiaController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [PanitiaController::class, 'updateProfile'])
    ->name('admin.profile.update');
    Route::post('/admin/update-password', [PanitiaController::class, 'updatePassword'])
    ->name('admin.password.update');

});


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::post('/data-kategori', [KategoriEventController::class, 'store'])->name('admin.kategori.store');
    Route::put('/data-kategori/{id}', [KategoriEventController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/data-kategori/{id}', [KategoriEventController::class, 'destroy'])->name('admin.kategori.destroy');
    Route::get('/data-volunteer', [VolunteerController::class, 'index'])->name('admin.volunteer');
    Route::delete('/data-volunteer/{id}', [VolunteerController::class, 'destroy'])->name('admin.volunteer.destroy');
});
