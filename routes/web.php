<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

// Halaman utama untuk lihat daftar tugas
Route::get('/', [TaskController::class, 'index']);

// Alamat untuk kirim data tugas baru (simpan)
Route::post('/tambah', [TaskController::class, 'store']);

// Alamat untuk hapus tugas
Route::delete('/hapus/{id}', [TaskController::class, 'destroy']);
Route::get('/', [TaskController::class, 'index']);
Route::post('/store', [TaskController::class, 'store']);
Route::get('/delete/{id}', [TaskController::class, 'destroy']);
Route::get('/edit/{id}', [TaskController::class, 'edit']);
Route::post('/update/{id}', [TaskController::class, 'update']);
Route::get('/check/{id}', [TaskController::class, 'check']);
