<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    protected $fillable = [
        'kunjungan_id', 'metode_pembayaran', 'jumlah_dibayar', 'total_tagihan', 'kembalian', 'tanggal_bayar'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
