<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\Obat;
use App\Models\Kunjungan;
use App\Models\KunjunganTindakan;
use App\Models\KunjunganObat;



class DokterController extends Controller
{
    // Menampilkan daftar kunjungan yang belum ditangani
    public function belum()
    {
        $kunjungan = Kunjungan::with('pasien')->where('status', 'belum_ditangani')->get();
        $semuaTindakan = Tindakan::all();
        $semuaObat = Obat::all();

        return view('admin.pages.dokter.belum.index', compact('kunjungan', 'semuaTindakan', 'semuaObat'));
    }

    // Menampilkan detail kunjungan untuk ditangani (modal/form)
    public function show($id)
    {
        $kunjungan = Kunjungan::with(['pasien', 'tindakan', 'obat'])->findOrFail($id);
        $semuaTindakan = Tindakan::all();
        $semuaObat = Obat::all();

        return view('admin.pages.dokter.belum.tindakan', compact('kunjungan', 'semuaTindakan', 'semuaObat'));
    }

    // Menyimpan tindakan dan obat yang diberikan
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $kunjungan = Kunjungan::findOrFail($id);
        $total = 0;

        // Simpan tindakan (bisa banyak)
        if ($request->has('tindakan_ids')) {
            $tindakanData = [];
            foreach ($request->tindakan_ids as $tindakanId) {
                $t = Tindakan::find($tindakanId);
                if ($t) {
                    $tindakanData[$t->id] = ['catatan' => $request->catatan ?? ''];
                    $total += $t->tarif;
                }
            }
            $kunjungan->tindakan()->sync($tindakanData);
        }



        // Simpan obat (dengan checkbox dan jumlah)
        if ($request->has('obat')) {
            $obatData = [];
            foreach ($request->obat as $id => $detail) {
                $jumlah = isset($detail['jumlah']) ? (int) $detail['jumlah'] : 0;

                if ($jumlah > 0) {
                    $obat = Obat::find($id);
                    if ($obat) {
                        $obatData[$id] = ['jumlah' => $jumlah];
                        $total += $obat->harga * $jumlah;
                    }
                }
            }
            $kunjungan->obat()->sync($obatData);
        }



        // Update status dan total biaya kunjungan
        $kunjungan->update([
            'status' => 'sudah_ditangani',
            'total_biaya' => $total,
        ]);

        return redirect()->route('admin.dokter.belum')->with('success', 'Kunjungan berhasil diperbarui!');
    }

    // Menampilkan daftar kunjungan yang sudah ditangani
    public function sudah()
    {
        $kunjungans = Kunjungan::where('status', 'sudah_ditangani')->with(['pasien'])->latest()->get();

        return view('admin.pages.dokter.sudah.index', compact('kunjungans'));
    }

}
