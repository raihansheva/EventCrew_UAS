<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranVolunteerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pendaftaran', [PendaftaranVolunteerController::class, 'create']);
Route::post('/pendaftaran', [PendaftaranVolunteerController::class, 'store']);