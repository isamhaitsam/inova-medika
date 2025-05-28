<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KunjunganTindakan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_tindakan';
    protected $fillable = ['kunjungan_id', 'tindakan_id', 'catatan'];
}
