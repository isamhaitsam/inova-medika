<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'kunjungan';


    protected $fillable = [
        'pasien_id', 'jenis_kunjungan', 'keluhan', 'total_biaya', 'tanggal_kunjungan','status', 'is_dibayar'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function tindakan()
    {
        return $this->belongsToMany(Tindakan::class, 'kunjungan_tindakan')
                    ->withTimestamps()
                    ->withPivot('catatan');
    }

    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'kunjungan_obat')
                    ->withTimestamps()
                    ->withPivot('jumlah');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
