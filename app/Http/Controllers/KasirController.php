<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use PDF;
use App\Models\Pembayaran;


class KasirController extends Controller
{
    public function index()
    {
        // Ambil data kunjungan yang sudah ditangani dan belum lunas (atau sesuai kebutuhan)
    $kunjungans = Kunjungan::with('pasien', 'pembayaran')
        ->where('status', 'sudah_ditangani')
        ->where('is_dibayar', 0)
        ->get();


        return view('admin.pages.kasir.bayar.index', compact('kunjungans'));
    }

     public function bayar(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'metode_pembayaran' => 'required|string',
            'jumlah_dibayar' => 'required|numeric|min:0',
        ]);

        $kunjungan = Kunjungan::findOrFail($id);
        $totalTagihan = $kunjungan->total_biaya;

        $jumlahDibayar = $request->input('jumlah_dibayar');
        $kembalian = 0;

        if ($jumlahDibayar < $totalTagihan) {
            return back()->withErrors(['jumlah_dibayar' => 'Jumlah bayar kurang dari total tagihan!']);
        } elseif ($jumlahDibayar > $totalTagihan) {
            $kembalian = $jumlahDibayar - $totalTagihan;
        }

        // Simpan data pembayaran
        Pembayaran::updateOrCreate(
            ['kunjungan_id' => $id],
            [
                'metode_pembayaran' => $request->input('metode_pembayaran'),
                'jumlah_dibayar' => $jumlahDibayar,
                'total_tagihan' => $totalTagihan,
                'kembalian' => $kembalian,
                'tanggal_bayar' => now(),
            ]
        );

        // Update status lunas jika pembayaran sudah cukup
        if ($kembalian >= 0) {
            $kunjungan->update(['is_dibayar' => 1]);
        } else {
            $kunjungan->update(['is_dibayar' => 0]);
        }


        return redirect()->route('admin.kasir.index')->with('success', 'Pembayaran berhasil diproses!');
    }

    public function indexlunas()
    {
        // Ambil data kunjungan yang sudah ditangani dan belum lunas (atau sesuai kebutuhan)
        $kunjungans = Kunjungan::with('pasien', 'pembayaran')
            ->where('status', 'sudah_ditangani')
            ->where('is_dibayar', 1)
            ->get();

        return view('admin.pages.kasir.lunas.index', compact('kunjungans'));
    }

    public function cetakPdf($id)
{
    $kunjungan = Kunjungan::with('pasien', 'tindakan', 'obat', 'pembayaran')->findOrFail($id);

    $pdf = PDF::loadView('admin.pages.kasir.lunas.cetak', compact('kunjungan'));

    // Bisa langsung download atau stream ke browser
return $pdf->download(
    'Pembayaran-' . 
    $kunjungan->pasien->nama . '-' . 
    \Carbon\Carbon::parse($kunjungan->pembayaran->tanggal_bayar)->format('d-m-Y_H-i') . 
    '.pdf'
);
    // atau jika mau ditampilkan di browser:
    // return $pdf->stream('kunjungan-'.$kunjungan->id.'.pdf');
}
}
