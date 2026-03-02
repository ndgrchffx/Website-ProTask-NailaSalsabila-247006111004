<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

// Endpoint untuk mengambil data tugas
Route::get('/tasks', [TaskController::class, 'apiIndex']);

// Endpoint untuk menambah data tugas baru
Route::post('/tasks', [TaskController::class, 'apiStore']);

Route::delete('/hapus/{id}', [TaskController::class, 'apiDestroy']);

// Rute untuk mengupdate data tugas berdasarkan ID
Route::put('/update/{id}', [TaskController::class, 'apiUpdate']);
