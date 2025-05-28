<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'obat';

    protected $fillable = ['nama_obat', 'harga'];

    public function kunjungan()
    {
        return $this->belongsToMany(Kunjungan::class, 'kunjungan_obat');
    }
}
