<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KunjunganObat extends Model
{
    use HasFactory;
    

    protected $table = 'kunjungan_obat';
    protected $fillable = ['kunjungan_id', 'obat_id', 'jumlah'];
}
