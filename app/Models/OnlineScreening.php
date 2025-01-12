<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineScreening extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_kelamin',
        'usia',
        'jawaban_responden',
        'skor',
        'status',
    ];

    protected $casts = [
        'jawaban_responden' => 'array', // Cast ke array agar otomatis diproses sebagai JSON
    ];
}
