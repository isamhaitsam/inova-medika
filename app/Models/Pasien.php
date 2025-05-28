<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';


    protected $fillable = ['nama', 'nik', 'jenis_kelamin', 'golongan_darah'];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
