<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tindakan extends Model
{
    use HasFactory;
    protected $table = 'tindakan';


    protected $fillable = ['nama_tindakan', 'tarif'];

    public function kunjungan()
    {
        return $this->belongsToMany(Kunjungan::class, 'kunjungan_tindakan');
    }
}
