<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KategoriEventController;
use App\Http\Controllers\PendaftaranVolunteerController;


Route::get('/', function () {
    return view('pages.home');
});

Route::get('/admin' , function () {
    return view('admin.dashboard');
});

Route::get('/dashboard' , function () {
    return view('admin.dashboard');
});

// Register
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');

Route::get('/about', [AboutController::class, 'index'])->name('about');

// Event
Route::get('/event', [EventController::class, 'index'])->name('event');

Route::get('/pendaftaran', [PendaftaranVolunteerController::class, 'create']);
Route::post('/pendaftaran', [PendaftaranVolunteerController::class, 'store']);


// admin route

// event
Route::get('/data-event',   function () {
    return view('admin.event');
});
// isi route nya disini yakk
// -----

// kategori event
Route::get('/data-kategori',   function () {
    return view('admin.eventKategori');
});

// kategori event
Route::get('/data-kategori', [KategoriEventController::class, 'index']);
Route::post('/data-kategori', [KategoriEventController::class, 'store'])->name('admin.kategori.store');
Route::put('/data-kategori/{id}', [KategoriEventController::class, 'update'])->name('admin.kategori.update');
Route::delete('/data-kategori/{id}', [KategoriEventController::class, 'destroy'])->name('admin.kategori.destroy');
// isi route nya disini yakk
// -----