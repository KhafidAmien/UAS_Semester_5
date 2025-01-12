<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScreeningThreshold extends Model
{
    use HasFactory;

    protected $fillable = ['layanan_id', 'rendah_threshold', 'sedang_threshold', 'tinggi_threshold'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
