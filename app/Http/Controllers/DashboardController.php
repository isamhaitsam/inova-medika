<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use DateTime;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalPegawai = Pegawai::count();


        // Jumlah kunjungan yang belum ditangani (misal status == 'menunggu')
        $belumDitangani = Kunjungan::where('status', 'belum_ditangani')->count();

        // Jumlah kunjungan yang belum dibayar (tidak ada relasi pembayaran)
        $belumBayar = Kunjungan::where('is_dibayar',0)->count();

        $pasienPerBulan = Pasien::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('count(*) as total'))
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

        // Data untuk grafik (label dan jumlah)
        $bulanLabels = [];
        $jumlahPasien = [];

        foreach ($pasienPerBulan as $item) {
            $bulanLabels[] = DateTime::createFromFormat('!m', $item->bulan)->format('F');
            $jumlahPasien[] = $item->total;
        }


        return view('admin.pages.Dashboard.index', compact('bulanLabels',
            'jumlahPasien','totalPasien', 'belumDitangani', 'belumBayar', 'totalPegawai'));
    }
}
