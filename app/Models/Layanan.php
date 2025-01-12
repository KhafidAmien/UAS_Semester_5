<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_layanan_id'
    ];

    public function kuesioners()
    {
        return $this->hasMany(Kuesioner::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kategori_layanan_id');
    }

    public function ScreeningThreshold()
    {
        return $this->hasOne(ScreeningThreshold::class);
    }
}
