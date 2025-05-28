<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\DB;


class PendaftaranController extends Controller
{
        public function index()
    {   
        $pasiens = pasien::paginate(10);

        return view('admin.pages.pendaftaran.index',compact('pasiens'));
    }
        public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:pasien,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_darah' => 'nullable|string|max:3',
            'keluhan' => 'required|string',
        ]);

        DB::transaction(function () use ($validated) {
            $pasien = Pasien::create([
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'golongan_darah' => $validated['golongan_darah'] ?? null,
            ]);

            Kunjungan::create([
                'pasien_id' => $pasien->id,
                'jenis_kunjungan' => 'umum', // kamu bisa ganti sesuai kebutuhan
                'keluhan' => $validated['keluhan'],
                'total_biaya' => 0,
                'tanggal_kunjungan' => now(),
                'status' => 'belum_ditangani',
                'is_dibayar' => false,
            ]);
        });

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pasien berhasil didaftarkan dan kunjungan dibuat!');
    }
}
