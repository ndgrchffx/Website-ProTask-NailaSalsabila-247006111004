<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

// Endpoint untuk mengambil data tugas
Route::get('/tasks', [TaskController::class, 'apiIndex']);

// Endpoint untuk menambah data tugas baru
Route::post('/tasks', [TaskController::class, 'apiStore']);
