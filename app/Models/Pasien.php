<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($pasien) {
            $pasien->kode_unik = addslashes('P-' . strtoupper(uniqid()));
        });
        
    }

    protected $fillable = [
        'kode_unik',
        'nik',
        'nama',
        'usia',
        'tinggi_badan',
        'berat_badan',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    public function screening()
    {
        return $this->hasMany(Screening::class, 'pasien_id');
    }

}
