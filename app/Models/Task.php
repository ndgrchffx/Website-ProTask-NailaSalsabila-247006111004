<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Nama tabelnya (sesuaikan dengan database kamu)
    protected $table = 'tasks';

    // Kolom yang boleh diisi massal
    protected $fillable = ['nama_tugas', 'deadline', 'priority', 'is_completed'];
}
