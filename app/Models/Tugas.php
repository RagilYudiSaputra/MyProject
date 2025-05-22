<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'batas_waktu',
    ];

 protected $casts = [
        'batas_waktu' => 'datetime', // Menambahkan casting agar bisa pakai ->format()
    ];
}
