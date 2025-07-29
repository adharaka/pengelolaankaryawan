<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;



Route::resource('karyawan', KaryawanController::class);
Route::get('/', function () {
    return view('welcome');
});
